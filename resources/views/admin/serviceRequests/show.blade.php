@extends('admin.layout')

@section('content')
    <style>
        .ticket-detail {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 22px;
        }

        .ticket-card,
        .chat-panel {
            background: rgba(15, 23, 42, .9);
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 22px;
            padding: 22px;
            color: #e2e8f0;
            box-shadow: 0 18px 40px rgba(0, 0, 0, .22);
        }

        .ticket-card h4,
        .chat-panel h4 {
            color: white;
            margin-bottom: 18px;
        }

        .ticket-info {
            margin-bottom: 14px;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .ticket-info span {
            display: block;
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        .ticket-info strong {
            color: #fff;
            word-break: break-word;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .status-pending {
            background: rgba(250, 204, 21, .15);
            color: #facc15;
        }

        .status-processing {
            background: rgba(59, 130, 246, .15);
            color: #60a5fa;
        }

        .status-done {
            background: rgba(34, 197, 94, .15);
            color: #22c55e;
        }

        .chat-box-admin {
            height: 520px;
            overflow-y: auto;
            background: #070b1d;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 18px;
        }

        .chat-msg {
            display: flex;
            margin-bottom: 16px;
        }

        .chat-msg.admin {
            justify-content: flex-end;
        }

        .chat-message-content {
            display: flex;
            flex-direction: column;
            max-width: 75%;
        }

        .chat-msg.admin .chat-message-content {
            align-items: flex-end;
        }

        .chat-sender-label {
            margin: 0 0 6px;
            color: #c4b5fd;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .chat-bubble {
            padding: 14px 16px;
            border-radius: 16px;
            line-height: 1.6;
            background: #1e293b;
            border: 1px solid rgba(148, 163, 184, .16);
        }

        .chat-msg.admin .chat-bubble {
            background: linear-gradient(135deg, #2563eb, #9333ea);
            color: white;
        }

        .chat-msg.user .chat-bubble {
            background: rgba(30, 41, 59, .95);
            color: #e2e8f0;
        }

        .chat-msg.ai .chat-bubble {
            background: rgba(124, 58, 237, .18);
            border-color: rgba(168, 85, 247, .25);
            color: #e9d5ff;
        }

        .chat-meta {
            display: block;
            font-size: 11px;
            color: #94a3b8;
            margin-top: 8px;
        }

        .reply-form textarea {
            min-height: 110px;
            resize: vertical;
        }

        @media(max-width: 900px) {
            .ticket-detail {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="mb-3">
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            ← Quay lại danh sách
        </a>
    </div>

    <div class="ticket-detail">

        <div class="ticket-card">
            <h4>🎫 Ticket #{{ $request->id }}</h4>

            <div class="ticket-info">
                <span>Nền tảng</span>
                <strong>{{ $request->platform }}</strong>
            </div>

            <div class="ticket-info">
                <span>Dịch vụ</span>
                <strong>{{ $request->service }}</strong>
            </div>

            <div class="ticket-info">
                <span>Liên hệ</span>
                <strong>{{ $request->contact }}</strong>
            </div>

            <div class="ticket-info">
                <span>Thông tin tài khoản</span>
                <strong>{{ $request->account_info }}</strong>
            </div>

            <div class="ticket-info">
                <span>Trạng thái</span>
                <strong class="status-badge status-{{ $request->status }}">
                    {{ strtoupper($request->status) }}
                </strong>
            </div>

            <div class="ticket-info">
                <span>Ngày tạo</span>
                <strong>{{ $request->created_at }}</strong>
            </div>

            @if ($request->status !== 'done')
                <form method="POST" action="{{ route('admin.services.done', $request->id) }}">
                    @csrf
                    <button class="btn btn-success w-100">
                        ✅ Đánh dấu hoàn thành
                    </button>
                </form>
            @endif
        </div>

        <div class="chat-panel">
            <h4>💬 Hội thoại hỗ trợ</h4>

            <div class="chat-box-admin" id="adminChatBox">

                @foreach ($request->messages as $message)
                    <div class="chat-msg {{ $message->sender }}">
                        <div class="chat-message-content">
                            @if ($message->sender === 'admin')
                                <div class="chat-sender-label">Nhân viên hỗ trợ</div>
                            @elseif ($message->sender === 'ai')
                                <div class="chat-sender-label">AI hỗ trợ</div>
                            @endif

                            <div class="chat-bubble">
                            {!! nl2br(e($message->message)) !!}
                            <span class="chat-meta">
                                {{ $message->sender === 'user' ? ($request->user->name ?? 'Khách') : strtoupper($message->sender) }} • {{ $message->created_at }}
                            </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            @if ($request->status !== 'done')
                <form method="POST" action="{{ route('admin.services.reply', $request->id) }}" class="reply-form">
                    @csrf

                    <textarea name="message" class="form-control mb-3" placeholder="Nhập tin nhắn gửi cho khách..."></textarea>

                    <button class="btn btn-primary">
                        Gửi
                    </button>
                </form>
            @else
                <div class="alert alert-success">
                    Ticket này đã hoàn tất.
                </div>
            @endif
        </div>

    </div>

   <script>
    const adminChatBox = document.getElementById('adminChatBox');
    let lastMessageId = 0;
    let lastTicketStatus = @json($request->status);
    let adminPollingTimer = null;
    let adminPollInFlight = false;
    const ticketUserName = @json($request->user->name ?? 'Khách');

    // auto scroll xuống cuối
    // Cuộn hội thoại admin xuống tin nhắn mới nhất.
    function scrollBottom() {
        adminChatBox.scrollTop = adminChatBox.scrollHeight;
    }

    // Kiểm tra admin có đang đọc gần cuối hội thoại hay không.
    function isNearBottom() {
        return adminChatBox.scrollHeight - adminChatBox.scrollTop - adminChatBox.clientHeight < 80;
    }

    // Mã hóa nội dung trước khi chèn vào DOM để hạn chế XSS.
    function escapeHtml(value) {
        const element = document.createElement('div');
        element.textContent = value;
        return element.innerHTML;
    }

    // Chuyển dữ liệu tin nhắn cũ thành định dạng hiển thị tương thích.
    function expandLegacyMessage(message) {
        if (message.sender !== 'user' || !/\b(?:AI|YOU)\s+/.test(message.message)) {
            return [message];
        }

        const parts = message.message.split(/\b(AI|YOU)\s+/).filter(Boolean);
        const expanded = [];

        for (let index = 0; index < parts.length; index += 2) {
            const label = parts[index];
            const text = parts[index + 1];

            if (text) {
                expanded.push({
                    ...message,
                    sender: label === 'AI' ? 'ai' : 'user',
                    message: text.trim()
                });
            }
        }

        return expanded.length ? expanded : [message];
    }

    // render message
    // Nối các tin nhắn mới vào hội thoại mà không render lại toàn bộ danh sách.
    function appendMessages(messages, forceScroll = false) {
        const shouldScroll = forceScroll || isNearBottom();

        messages.forEach(msg => {
            if (adminChatBox.querySelector(`[data-message-id="${msg.id}"]`)) {
                return;
            }

            const senderName = msg.sender === 'user'
                ? ticketUserName
                : (msg.sender === 'admin' ? 'Nhân viên hỗ trợ' : 'AI hỗ trợ');
            const senderLabel = msg.sender === 'admin'
                ? '<div class="chat-sender-label">Nhân viên hỗ trợ</div>'
                : (msg.sender === 'ai' ? '<div class="chat-sender-label">AI hỗ trợ</div>' : '');
            const row = document.createElement('div');

            row.className = `chat-msg ${msg.sender}`;
            row.dataset.messageId = msg.id;
            row.innerHTML = `
                <div class="chat-message-content">
                    ${senderLabel}
                    <div class="chat-bubble">

                        ${escapeHtml(msg.message).replace(/\n/g, '<br>')}

                        <span class="chat-meta">
                            ${escapeHtml(senderName)}
                            •
                            ${new Date(msg.created_at).toLocaleString()}
                        </span>

                    </div>
                </div>
            `;

            adminChatBox.appendChild(row);
            lastMessageId = Math.max(lastMessageId, Number(msg.id));
        });

        if (shouldScroll) {
            scrollBottom();
        }
    }

    // load tin nhắn realtime
    // Polling API để admin nhận các tin nhắn mới từ người dùng.
    async function loadAdminMessages() {
        if (adminPollInFlight) {
            return;
        }

        adminPollInFlight = true;
        try {

            const res = await fetch(
                `/service-ticket/{{ $request->id }}/messages?after_id=${lastMessageId}`
            );

            const data = await res.json();

            if (!data.status) return;

            appendMessages(data.messages);
            lastMessageId = Math.max(lastMessageId, Number(data.latest_message_id || 0));

            // nếu ticket done
            if (data.ticket.status === 'done' && lastTicketStatus !== 'done') {

                const form = document.querySelector('.reply-form');

                if (form) {

                    form.innerHTML = `
                        <div class="alert alert-success">
                            ✅ Ticket đã hoàn thành
                        </div>
                    `;
                }
            }

            lastTicketStatus = data.ticket.status;
        } catch (err) {

            console.error(err);
        } finally {
            adminPollInFlight = false;

            if (lastTicketStatus !== 'done') {
                adminPollingTimer = setTimeout(loadAdminMessages, 2000);
            }
        }
    }

    // realtime polling
    const initialMessageIds = @json($request->messages->pluck('id')->values());

    document.querySelectorAll('#adminChatBox .chat-msg').forEach((row, index) => {
        const messageId = initialMessageIds[index];

        if (messageId) {
            row.dataset.messageId = messageId;
            lastMessageId = Math.max(lastMessageId, Number(messageId));
        }
    });

    scrollBottom();

    // load lần đầu
    loadAdminMessages();
</script>
@endsection
