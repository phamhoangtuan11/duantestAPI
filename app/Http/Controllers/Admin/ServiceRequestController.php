<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\ServiceMessage;

class ServiceRequestController extends Controller
{
    /** Hiển thị danh sách ticket kèm người gửi và tổng số tin nhắn. */
    // DANH SÁCH TICKET
    public function adminIndex()
    {
        $requests = ServiceRequest::with('user')
            ->withCount('messages')
            ->latest()
            ->get();

        return view('admin.serviceRequests.index', compact('requests'));
    }

    // ADMIN HOÀN THÀNH
    public function markDone($id)
    {
        $request = ServiceRequest::findOrFail($id);

        $request->status = 'done';

        $request->save();

        return back()->with('success', 'Đã hoàn thành yêu cầu');
    }
    /** Chỉ xóa ticket đã hoàn thành; tin nhắn liên quan được xóa theo cascade. */
    public function destroy($id)
    {
        $ticket = ServiceRequest::findOrFail($id);

        if ($ticket->status !== 'done') {
            return back()->with('error', 'Chỉ có thể xóa ticket đã hoàn thành.');
        }

        $ticket->delete();

        return back()->with('success', 'Đã xóa ticket và toàn bộ tin nhắn liên quan.');
    }

    /** Mở chi tiết ticket cùng toàn bộ hội thoại và thông tin người dùng. */
    public function show($id)
{
    $request = \App\Models\ServiceRequest::with(['user', 'messages.user'])->findOrFail($id);

    return view('admin.serviceRequests.show', compact('request'));
}

/** Lưu phản hồi của admin và chuyển ticket đang chờ sang trạng thái xử lý. */
public function reply(Request $requestData, $id)
{
    $requestData->validate([
        'message' => 'required|string',
    ]);

    $ticket = \App\Models\ServiceRequest::findOrFail($id);

    ServiceMessage::create([
        'service_request_id' => $ticket->id,
        'user_id' => auth()->id(),
        'message' => $requestData->message,
        'sender' => 'admin',
    ]);

    if ($ticket->status === 'pending') {
        $ticket->status = 'processing';
        $ticket->save();
    }

    return back()->with('success', 'Đã gửi tin nhắn');
}
}
