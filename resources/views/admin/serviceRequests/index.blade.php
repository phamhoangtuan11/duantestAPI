@extends('admin.layout')

@section('content')
    @php
        $statusLabels = [
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'done' => 'Hoàn thành',
        ];
    @endphp

    <style>
        .support-page {
            display: grid;
            gap: 22px;
        }

        .support-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 16px;
            border-radius: 14px;
            font-size: 13px;
        }

        .support-alert.success {
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, .25);
            background: rgba(34, 197, 94, .1);
        }

        .support-alert.error {
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, .25);
            background: rgba(239, 68, 68, .1);
        }

        .support-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .support-title {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .support-title-icon {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            border-radius: 17px;
            color: white;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            box-shadow: 0 0 28px rgba(59, 130, 246, .32);
        }

        .support-title h2 {
            margin: 0;
            color: #fff;
            font-size: 24px;
            font-weight: 700;
        }

        .support-title p {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 13px;
        }

        .back-dashboard {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 11px 16px;
            border: 1px solid rgba(148, 163, 184, .2);
            border-radius: 13px;
            color: #cbd5e1;
            text-decoration: none;
            background: rgba(15, 23, 42, .7);
            transition: .2s;
        }

        .back-dashboard:hover {
            color: #fff;
            border-color: rgba(96, 165, 250, .5);
            background: rgba(37, 99, 235, .12);
            transform: translateX(-3px);
        }

        .support-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .support-stat {
            padding: 17px 18px;
            border-radius: 17px;
            border: 1px solid rgba(148, 163, 184, .13);
            background: rgba(15, 23, 42, .68);
        }

        .support-stat span {
            display: block;
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .support-stat strong {
            color: #fff;
            font-size: 23px;
        }

        .ticket-list {
            display: grid;
            gap: 15px;
        }

        .support-ticket {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 22px;
            padding: 21px;
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, .14);
            border-radius: 19px;
            background: linear-gradient(145deg, rgba(15, 23, 42, .94), rgba(10, 18, 35, .92));
            transition: .22s;
        }

        .support-ticket::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 3px;
            background: #64748b;
        }

        .support-ticket.pending::before {
            background: #f59e0b;
        }

        .support-ticket.processing::before {
            background: #3b82f6;
        }

        .support-ticket.done::before {
            background: #22c55e;
        }

        .support-ticket:hover {
            border-color: rgba(96, 165, 250, .35);
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, .2);
        }

        .ticket-heading {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 13px;
        }

        .ticket-id {
            color: #fff;
            font-weight: 700;
        }

        .ticket-service {
            padding: 6px 10px;
            border-radius: 9px;
            color: #bfdbfe;
            background: rgba(59, 130, 246, .12);
            font-size: 12px;
        }

        .ticket-status {
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .ticket-status.pending {
            color: #fbbf24;
            background: rgba(245, 158, 11, .12);
        }

        .ticket-status.processing {
            color: #60a5fa;
            background: rgba(59, 130, 246, .13);
        }

        .ticket-status.done {
            color: #4ade80;
            background: rgba(34, 197, 94, .12);
        }

        .ticket-description {
            max-width: 850px;
            margin: 0 0 14px;
            overflow: hidden;
            color: #cbd5e1;
            line-height: 1.65;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .ticket-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            color: #94a3b8;
            font-size: 12px;
        }

        .ticket-meta span {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .ticket-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .ticket-actions form {
            margin: 0;
        }

        .ticket-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 41px;
            padding: 10px 14px;
            border: 1px solid transparent;
            border-radius: 12px;
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .ticket-action.view {
            background: #2563eb;
        }

        .ticket-action.done {
            background: rgba(34, 197, 94, .12);
            border-color: rgba(34, 197, 94, .25);
            color: #86efac;
        }

        .ticket-action.delete {
            background: rgba(239, 68, 68, .1);
            border-color: rgba(239, 68, 68, .24);
            color: #fca5a5;
        }

        .ticket-action:hover {
            color: #fff;
            transform: translateY(-2px);
            filter: brightness(1.08);
        }

        .empty-support {
            padding: 55px 20px;
            border: 1px dashed rgba(148, 163, 184, .2);
            border-radius: 20px;
            color: #94a3b8;
            text-align: center;
            background: rgba(15, 23, 42, .5);
        }

        .empty-support i {
            display: block;
            margin-bottom: 13px;
            color: #60a5fa;
            font-size: 30px;
        }

        @media(max-width: 1100px) {
            .support-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .support-ticket {
                grid-template-columns: 1fr;
            }

            .ticket-actions {
                justify-content: flex-start;
            }
        }

        @media(max-width: 640px) {
            .support-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .support-stats {
                grid-template-columns: 1fr;
            }

            .ticket-actions {
                align-items: stretch;
                flex-direction: column;
            }
        }
    </style>

    <div class="support-page">
        <div class="support-header">
            <div class="support-title">
                <div class="support-title-icon">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div>
                    <h2>Trung tâm hỗ trợ MMO</h2>
                    <p>Ticket hoàn thành được tự động dọn sau 90 ngày.</p>
                </div>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="back-dashboard">
                <i class="fa-solid fa-arrow-left"></i>
                Quay lại Dashboard
            </a>
        </div>

        <div class="support-stats">
            <div class="support-stat">
                <span>Tổng yêu cầu</span>
                <strong>{{ $requests->count() }}</strong>
            </div>
            <div class="support-stat">
                <span>Chờ xử lý</span>
                <strong>{{ $requests->where('status', 'pending')->count() }}</strong>
            </div>
            <div class="support-stat">
                <span>Đang xử lý</span>
                <strong>{{ $requests->where('status', 'processing')->count() }}</strong>
            </div>
            <div class="support-stat">
                <span>Hoàn thành</span>
                <strong>{{ $requests->where('status', 'done')->count() }}</strong>
            </div>
        </div>

        <div class="ticket-list">
            @forelse ($requests as $request)
                <article class="support-ticket {{ $request->status }}">
                    <div>
                        <div class="ticket-heading">
                            <span class="ticket-id">Ticket #{{ $request->id }}</span>
                            <span class="ticket-service">
                                {{ $request->platform }} / {{ $request->service }}
                            </span>
                            <span class="ticket-status {{ $request->status }}">
                                {{ $statusLabels[$request->status] ?? $request->status }}
                            </span>
                        </div>

                        <p class="ticket-description">
                            {{ $request->description ?: 'Chưa có nội dung mô tả.' }}
                        </p>

                        <div class="ticket-meta">
                            <span>
                                <i class="fa-regular fa-user"></i>
                                {{ $request->user->name ?? 'Khách' }}
                            </span>
                            <span>
                                <i class="fa-regular fa-message"></i>
                                {{ $request->messages_count ?? 0 }} tin nhắn
                            </span>
                            <span>
                                <i class="fa-regular fa-clock"></i>
                                {{ $request->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>

                    <div class="ticket-actions">
                        <a href="{{ route('admin.services.show', $request->id) }}" class="ticket-action view">
                            <i class="fa-regular fa-comments"></i>
                            Mở hội thoại
                        </a>

                        @if ($request->status !== 'done')
                            <form method="POST" action="{{ route('admin.services.done', $request->id) }}">
                                @csrf
                                <button type="submit" class="ticket-action done">
                                    <i class="fa-solid fa-check"></i>
                                    Hoàn thành
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.services.destroy', $request->id) }}"
                                data-confirm="Xóa ticket #{{ $request->id }} và toàn bộ tin nhắn liên quan? Hành động này không thể hoàn tác."
                                data-confirm-title="Xóa ticket" data-confirm-button="Xóa ticket">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ticket-action delete">
                                    <i class="fa-regular fa-trash-can"></i>
                                    Xóa ticket
                                </button>
                            </form>
                        @endif
                    </div>
                </article>
            @empty
                <div class="empty-support">
                    <i class="fa-regular fa-folder-open"></i>
                    Chưa có yêu cầu hỗ trợ nào.
                </div>
            @endforelse
        </div>
    </div>
@endsection
