<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\ServiceMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceRequestController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'platform' => 'required|string',
            'service' => 'required|string',
            'contact' => 'nullable|string',
            'account_info' => 'nullable|string',
            'description' => 'nullable|string',
            'messages' => 'required|array|min:1',
            'messages.*.sender' => 'required|in:user,ai',
            'messages.*.message' => 'required|string',
        ]);

        [$ticket, $latestMessageId] = DB::transaction(function () use ($data) {
            $ticket = ServiceRequest::create([
                'user_id' => auth()->id(),
                'platform' => $data['platform'],
                'service' => $data['service'],
                'contact' => $data['contact'] ?? null,
                'account_info' => $data['account_info'] ?? null,
                'description' => $data['description'] ?? null,
                'status' => 'pending',
            ]);

            $latestMessageId = 0;

            foreach ($data['messages'] as $message) {
                $serviceMessage = ServiceMessage::create([
                    'service_request_id' => $ticket->id,
                    'user_id' => $message['sender'] === 'user' ? auth()->id() : null,
                    'message' => $message['message'],
                    'sender' => $message['sender'],
                ]);

                $latestMessageId = $serviceMessage->id;
            }

            return [$ticket, $latestMessageId];
        });

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo yêu cầu',
            'ticket_id' => $ticket->id,
            'latest_message_id' => $latestMessageId,
        ]);
    }
    public function adminIndex()
    {
        $requests = ServiceRequest::latest()->get();

        return view('admin.serviceRequests.index', compact('requests'));
    }

    public function markDone($id)
    {
        $request = ServiceRequest::findOrFail($id);

        $request->status = 'done';
        $request->save();

        return back()->with('success', 'Đã hoàn thành yêu cầu');
    }
}
