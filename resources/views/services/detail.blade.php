<!DOCTYPE html>
<html>

<head>
    <title>Dịch vụ</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background: #050816;
            color: white;
            font-family: Arial;
            padding: 40px;
        }

        .box {
            max-width: 700px;
            margin: auto;
            background: #0b1023;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid #5b3df5;
        }

        h1 {
            color: #c084fc;
        }

        input,
        textarea {
            width: 100%;
            padding: 14px;
            margin-top: 12px;
            background: #11182f;
            border: 1px solid #2c3a66;
            border-radius: 10px;
            color: white;
        }

        button {
            margin-top: 20px;
            padding: 15px 25px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #5b3df5, #a855f7);
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .ai-box {
            margin-top: 25px;
            padding: 20px;
            background: #11182f;
            border-radius: 15px;
            border: 1px solid #3b4d88;
        }

        /* ai chat */
        .chat-box {
            height: 500px;
            overflow-y: auto;
            padding: 20px;
            background: #0f172a;
            border-radius: 20px;
            margin-top: 30px;
            border: 1px solid #334155;
        }

        .ai-message,
        .user-message {
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 16px;
            max-width: 80%;
            line-height: 1.6;
        }

        .ai-message {
            background: #1e293b;
            color: #fff;
            border: 1px solid #475569;
        }

        .user-message {
            background: linear-gradient(135deg, #5b3df5, #9333ea);
            margin-left: auto;
            color: white;
        }

        #chatForm {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        #chatForm input {
            flex: 1;
            padding: 16px;
            border: none;
            border-radius: 14px;
            background: #111827;
            color: white;
        }

        #chatForm button {
            padding: 16px 24px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #5b3df5, #9333ea);
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        /* NÂNG CẤP GIAO DIỆN VÀ AI */
        .pro-support {
            position: relative;
            max-width: 1180px;
            margin: 50px auto;
            display: grid;
            grid-template-columns: 0.9fr 1.35fr;
            gap: 28px;
            padding: 28px;
            border-radius: 34px;
            background:
                radial-gradient(circle at 25% 20%, rgba(125, 92, 255, .22), transparent 30%),
                radial-gradient(circle at 80% 70%, rgba(204, 80, 255, .18), transparent 35%),
                rgba(5, 8, 24, .72);
            border: 1px solid rgba(174, 130, 255, .24);
            box-shadow: 0 0 80px rgba(110, 80, 255, .22);
            overflow: hidden;
        }

        .pro-bg-glow {
            position: absolute;
            inset: -40%;
            background:
                conic-gradient(from 180deg, transparent, rgba(123, 92, 255, .18), transparent, rgba(236, 72, 153, .12), transparent);
            animation: rotateGlow 18s linear infinite;
            pointer-events: none;
        }

        .pro-left,
        .pro-chat {
            position: relative;
            z-index: 2;
        }

        .pro-left {
            padding: 34px;
            border-radius: 28px;
            background: rgba(255, 255, 255, .045);
            border: 1px solid rgba(255, 255, 255, .08);
            backdrop-filter: blur(18px);
        }

        .service-badge {
            display: inline-block;
            padding: 9px 14px;
            border-radius: 999px;
            background: rgba(168, 85, 247, .14);
            border: 1px solid rgba(168, 85, 247, .35);
            color: #d8b4fe;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .pro-left h1 {
            margin: 24px 0 14px;
            font-size: 44px;
            line-height: 1.08;
            text-transform: capitalize;
            background: linear-gradient(90deg, #fff, #b9c2ff, #e879f9);
            -webkit-background-clip: text;
            color: transparent;
        }

        .pro-left p {
            color: #bec4e6;
            line-height: 1.8;
        }

        .process-list {
            margin-top: 34px;
            display: grid;
            gap: 14px;
        }

        .process {
            padding: 15px;
            border-radius: 18px;
            color: #aeb6d8;
            background: rgba(15, 23, 42, .72);
            border: 1px solid rgba(255, 255, 255, .07);
        }

        .process span {
            display: inline-grid;
            place-items: center;
            width: 28px;
            height: 28px;
            margin-right: 10px;
            border-radius: 10px;
            background: rgba(99, 102, 241, .18);
            color: #c4b5fd;
        }

        .process.active {
            color: white;
            border-color: rgba(168, 85, 247, .45);
            box-shadow: 0 0 28px rgba(168, 85, 247, .18);
        }

        .pro-chat {
            border-radius: 28px;
            background: rgba(6, 10, 28, .86);
            border: 1px solid rgba(160, 130, 255, .28);
            overflow: hidden;
            backdrop-filter: blur(20px);
            box-shadow: inset 0 0 40px rgba(255, 255, 255, .03);
        }

        .chat-top {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 22px 24px;
            background: linear-gradient(90deg, rgba(91, 61, 245, .28), rgba(168, 85, 247, .12));
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .bot-core {
            position: relative;
            width: 64px;
            height: 64px;
        }

        .bot-ring {
            position: absolute;
            inset: 0;
            border-radius: 22px;
            background: conic-gradient(#7c3aed, #22d3ee, #ec4899, #7c3aed);
            animation: spin 3s linear infinite;
            filter: drop-shadow(0 0 18px rgba(168, 85, 247, .75));
        }

        .bot-face {
            position: absolute;
            inset: 5px;
            display: grid;
            place-items: center;
            border-radius: 18px;
            background: #0b1026;
            color: white;
            font-weight: 900;
        }

        .chat-top h3 {
            margin: 0;
            font-size: 22px;
        }

        .chat-top p {
            margin: 5px 0 0;
            color: #aeb6d8;
            font-size: 13px;
        }

        .chat-top p span {
            display: inline-block;
            width: 9px;
            height: 9px;
            margin-right: 6px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 14px #22c55e;
        }

        .quick-actions {
            display: flex;
            gap: 10px;
            padding: 16px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
            background: rgba(255, 255, 255, .025);
        }

        .quick-actions button {
            border: 1px solid rgba(168, 85, 247, .28);
            background: rgba(168, 85, 247, .09);
            color: #ddd6fe;
            padding: 10px 14px;
            border-radius: 999px;
            cursor: pointer;
            transition: .25s;
        }

        .quick-actions button:hover {
            background: rgba(168, 85, 247, .22);
            transform: translateY(-2px);
        }

        .chat-body {
            height: 530px;
            overflow-y: auto;
            padding: 26px;
            background:
                radial-gradient(circle at 10% 15%, rgba(34, 211, 238, .08), transparent 25%),
                radial-gradient(circle at 90% 70%, rgba(168, 85, 247, .1), transparent 30%),
                #070b1d;
        }

        .msg {
            display: flex;
            gap: 12px;
            margin-bottom: 18px;
            animation: msgPop .35s ease both;
        }

        .msg.user {
            justify-content: flex-end;
        }

        .avatar {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: linear-gradient(135deg, #334155, #6366f1);
            color: white;
            font-size: 12px;
            font-weight: 900;
            flex-shrink: 0;
            box-shadow: 0 0 20px rgba(99, 102, 241, .38);
        }

        .bubble {
            max-width: 70%;
            padding: 15px 18px;
            border-radius: 20px;
            background: rgba(30, 41, 59, .88);
            border: 1px solid rgba(148, 163, 184, .18);
            color: #e5e7eb;
            line-height: 1.65;
            box-shadow: 0 12px 28px rgba(0, 0, 0, .25);
        }

        .bubble p {
            margin: 0;
        }

        .msg.user .avatar {
            order: 2;
            background: linear-gradient(135deg, #f59e0b, #ef4444);
        }

        .msg.user .bubble {
            background: linear-gradient(135deg, #5b3df5, #a855f7);
            color: white;
            box-shadow: 0 0 28px rgba(168, 85, 247, .34);
        }

        .chat-send {
            display: flex;
            gap: 12px;
            padding: 20px 24px;
            background: rgba(4, 7, 22, .96);
            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        .chat-send input {
            flex: 1;
            border: 1px solid rgba(130, 120, 255, .32);
            background: rgba(15, 23, 42, .95);
            color: white;
            padding: 16px 18px;
            border-radius: 18px;
            outline: none;
        }

        .chat-send input:focus {
            border-color: #a855f7;
            box-shadow: 0 0 26px rgba(168, 85, 247, .35);
        }

        .chat-send button {
            border: none;
            border-radius: 18px;
            padding: 0 30px;
            color: white;
            font-weight: 900;
            cursor: pointer;
            background: linear-gradient(135deg, #5b3df5, #ec4899);
            box-shadow: 0 0 30px rgba(168, 85, 247, .45);
            transition: .3s;
        }

        .chat-send button:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 45px rgba(236, 72, 153, .6);
        }

        @keyframes rotateGlow {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes msgPop {
            from {
                opacity: 0;
                transform: translateY(12px) scale(.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (max-width: 900px) {
            .pro-support {
                grid-template-columns: 1fr;
                padding: 16px;
            }

            .quick-actions {
                flex-wrap: wrap;
            }

            .bubble {
                max-width: 82%;
            }
        }

        /* quay về */
        .back-home-btn {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 20px;
            border-radius: 14px;
            color: #fff;
            text-decoration: none;
            font-weight: 800;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(168, 85, 247, 0.35);
            box-shadow: 0 0 24px rgba(168, 85, 247, 0.25);
            transition: .3s;
        }

        .back-home-btn:hover {
            transform: translateY(-3px);
            background: rgba(168, 85, 247, 0.18);
        }

        /* wuy trình sử lí */
        .process.done {
            border-color: #22c55e;
            background: rgba(34, 197, 94, .12);
            color: white;
            box-shadow: 0 0 25px rgba(34, 197, 94, .25);
        }

        .process.processing {
            border-color: #facc15;
            background: rgba(250, 204, 21, .12);
            color: white;
            box-shadow: 0 0 25px rgba(250, 204, 21, .22);
        }

        .process.done span {
            background: #22c55e;
            color: white;
        }

        .process.processing span {
            background: #facc15;
            color: black;
        }
    </style>
</head>

<body>
    <a href="/" class="back-home-btn">
        ← Quay về trang chủ
    </a>
    <div class="pro-support">
        <div class="pro-bg-glow"></div>

        <div class="pro-left">
            <div class="service-badge">AI SERVICE DESK</div>
            <h1>{{ str_replace('-', ' ', $slug) }}</h1>
            <p>
                AI sẽ thu thập thông tin ban đầu, sau đó chuyển yêu cầu cho nhân viên xử lý.
            </p>

            <div class="process-list">

                <div class="process active" id="step1">
                    <span>1</span>
                    Tiếp nhận thông tin
                </div>

                <div class="process" id="step2">
                    <span>2</span>
                    AI phân loại yêu cầu
                </div>

                <div class="process" id="step3">
                    <span>3</span>
                    Nhân viên xử lý
                </div>

                <div class="process" id="step4">
                    <span>4</span>
                    Hoàn tất dịch vụ
                </div>

            </div>
        </div>

        <div class="pro-chat">
            <div class="chat-top">
                <div class="bot-core">
                    <div class="bot-ring"></div>
                    <div class="bot-face">AI</div>
                </div>

                <div>
                    <h3>Cosmic AI Assistant</h3>
                    <p><span></span> Online • phản hồi tự động</p>
                </div>
            </div>

            <div class="quick-actions">
                <button onclick="quickSend('Tôi bị checkpoint')">Checkpoint</button>
                <button onclick="quickSend('Tài khoản bị hack')">Bị hack</button>
                <button onclick="quickSend('Tôi quên email hoặc số điện thoại')">Quên thông tin</button>
            </div>

            <div class="chat-body" id="chatBox">
                <div class="msg ai">
                    <div class="avatar">AI</div>
                    <div class="bubble">
                        <strong>Xin chào 👋</strong>
                        <p>Tôi là trợ lý AI. Tôi sẽ hỏi vài thông tin để nhân viên xử lý nhanh hơn.</p>
                    </div>
                </div>

                <div class="msg ai">
                    <div class="avatar">AI</div>
                    <div class="bubble">
                        <p>Bạn đang gặp vấn đề gì với tài khoản?</p>
                    </div>
                </div>
            </div>

            <form id="chatForm" class="chat-send">
                <input id="userInput" placeholder="Nhập câu trả lời của bạn..." autocomplete="off">
                <button type="submit">Gửi →</button>
            </form>
        </div>
    </div>
    <script>
        const form = document.getElementById('chatForm');
        const input = document.getElementById('userInput');
        const chatBox = document.getElementById('chatBox');
        const userName = @json(auth()->user()->name ?? 'Bạn');
        const conversationMessages = [
            {
                sender: 'ai',
                message: 'Xin chào. Tôi là trợ lý AI. Tôi sẽ hỏi vài thông tin để nhân viên xử lý nhanh hơn.'
            },
            {
                sender: 'ai',
                message: 'Bạn đang gặp vấn đề gì với tài khoản?'
            }
        ];

        let step = 0;
        let ticketActive = false;
        let pollingTimer = null;
        let pollInFlight = false;
        let lastMessageId = 0;
        let lastTicketStatus = null;

        const aiQuestions = [
            "Bạn còn đăng nhập được tài khoản Facebook không?",
            "Bạn còn giữ email hoặc số điện thoại liên kết tài khoản không?",
            "Tài khoản bị lỗi trong trường hợp nào? Ví dụ: checkpoint, bị hack, bị khóa 282...",
            "Bạn vui lòng gửi link Facebook hoặc UID để nhân viên kiểm tra.",
            "Tôi đã ghi nhận thông tin. Nhân viên sẽ tiếp nhận và liên hệ xử lý sớm nhất."
        ];

        // HIỂN THỊ CHAT
        function appendMessage(type, text, messageId = null, forceScroll = false) {
            if (messageId && chatBox.querySelector(`[data-message-id="${messageId}"]`)) {
                return null;
            }

            const shouldScroll = forceScroll ||
                chatBox.scrollHeight - chatBox.scrollTop - chatBox.clientHeight < 80;
            const row = document.createElement('div');

            row.className = `msg ${type}`;

            if (messageId) {
                row.dataset.messageId = messageId;
                lastMessageId = Math.max(lastMessageId, Number(messageId));
            }

            const displayName = type === 'ai' ? 'AI' : (type === 'admin' ? 'ADMIN' : userName);

            row.innerHTML = `
            <div class="avatar">${displayName}</div>

            <div class="bubble">
                <p>${text}</p>
            </div>
        `;

            chatBox.appendChild(row);

            if (shouldScroll) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            if (!ticketActive && (type === 'ai' || type === 'user')) {
                conversationMessages.push({
                    sender: type,
                    message: text
                });
            }

            return row;
        }

        const oldTicketId = localStorage.getItem('current_service_ticket');

        if (oldTicketId) {
            loadOldTicket(oldTicketId);
        }

        // NÚT NHANH
        function quickSend(text) {

            input.value = text;

            form.dispatchEvent(new Event('submit'));
        }

        // HIỆU ỨNG AI
        function showTyping(text) {

            const typing = document.createElement('div');

            typing.className = 'msg ai';

            typing.innerHTML = `
            <div class="avatar">AI</div>

            <div class="bubble">
                <p>Đang phân tích...</p>
            </div>
        `;

            chatBox.appendChild(typing);

            chatBox.scrollTop = chatBox.scrollHeight;

            setTimeout(() => {

                typing.remove();

                appendMessage('ai', text);

            }, 900);
        }

        // TẠO TICKET
        async function createServiceRequest() {

            try {

                const res = await fetch('/service-request', {

                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',

                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },

                    body: JSON.stringify({

                        platform: "{{ $platform }}",

                        service: "{{ $slug }}",

                        contact: "Khách từ AI Chat",

                        account_info: "Thông tin trong chat",

                        description: conversationMessages
                            .filter(message => message.sender === 'user')
                            .map(message => message.message)
                            .join("\n"),

                        messages: conversationMessages

                    })
                });

                const data = await res.json();

                console.log("Ticket:", data);

                if (data.status) {

                    localStorage.setItem(
                        'current_service_ticket',
                        data.ticket_id
                    );
                    ticketActive = true;
                    lastMessageId = Number(data.latest_message_id || 0);
                    lastTicketStatus = 'pending';
                    startPolling(data.ticket_id);
                    appendMessage(
                        'ai',
                        '✅ Yêu cầu đã được tạo. Mã ticket: #' + data.ticket_id
                    );
                }

            } catch (err) {

                console.error(err);

                appendMessage(
                    'ai',
                    '❌ Không thể tạo ticket.'
                );
            }
        }
        async function loadOldTicket(ticketId) {

            try {
                const res = await fetch(`/service-ticket/${ticketId}/messages`);

                const data = await res.json();

                if (!data.status) return;

                ticketActive = true;
                lastTicketStatus = data.ticket.status;
                lastMessageId = 0;

                chatBox.innerHTML = '';

                appendMessage(
                    'ai',
                    '🔄 Đã khôi phục ticket #' + ticketId + '. Bạn có thể tiếp tục trao đổi tại đây.'
                );

                data.messages.forEach(msg => {
                    appendMessage(msg.sender, msg.message, msg.id);
                });

                if (data.ticket.status === 'done') {

                    appendMessage('ai', '✅ Ticket này đã được nhân viên hoàn thành. Cảm ơn bạn đã sử dụng dịch vụ.');

                    localStorage.removeItem('current_service_ticket');

                    ticketActive = false;

                    if (pollingTimer) {
                        clearTimeout(pollingTimer);
                        pollingTimer = null;
                    }

                    input.disabled = true;
                    input.placeholder = 'Ticket đã hoàn thành';

                    document.querySelector('#chatForm button').disabled = true;
                    document.querySelector('#chatForm button').innerText = 'Đã hoàn thành';

                    document.getElementById('step1').classList.add('done');
                    document.getElementById('step2').classList.add('done');
                    document.getElementById('step3').classList.add('done');
                    document.getElementById('step4').classList.add('done');

                } else {

                    appendMessage('ai', '🟡 Ticket đang được nhân viên xử lý.');
                }

                if (data.ticket.status !== 'done') {
                    startPolling(ticketId);
                }

                document.getElementById('step1').classList.add('done');
                document.getElementById('step2').classList.add('done');

                if (data.ticket.status === 'done') {
                    document.getElementById('step3').classList.add('done');
                    document.getElementById('step4').classList.add('done');
                } else {
                    document.getElementById('step3').classList.add('processing');
                }

            } catch (err) {
                console.error(err);
                appendMessage('ai', '❌ Không thể khôi phục hội thoại cũ.');
            }
        }
        // hàm lắng nghe tin nhắn mới từ sẻver
        async function reloadTicketMessages(ticketId) {
            if (pollInFlight) {
                return;
            }

            pollInFlight = true;
            try {
                const res = await fetch(`/service-ticket/${ticketId}/messages?after_id=${lastMessageId}`);
                const data = await res.json();

                if (!data.status) return;

                data.messages.forEach(msg => {
                    appendMessage(msg.sender, msg.message, msg.id);
                });

                lastMessageId = Math.max(lastMessageId, Number(data.latest_message_id || 0));

                if (data.ticket.status === 'done' && lastTicketStatus !== 'done') {

                    appendMessage('ai', '✅ Ticket này đã được nhân viên hoàn thành. Cảm ơn bạn đã sử dụng dịch vụ.');

                    localStorage.removeItem('current_service_ticket');

                    ticketActive = false;

                    if (pollingTimer) {
                        clearTimeout(pollingTimer);
                        pollingTimer = null;
                    }

                    input.disabled = true;
                    input.placeholder = 'Ticket đã hoàn thành';

                    document.querySelector('#chatForm button').disabled = true;
                    document.querySelector('#chatForm button').innerText = 'Đã hoàn thành';

                    document.getElementById('step1').classList.add('done');
                    document.getElementById('step2').classList.add('done');
                    document.getElementById('step3').classList.add('done');
                    document.getElementById('step4').classList.add('done');

                } else if (data.ticket.status !== lastTicketStatus) {

                    appendMessage('ai', '🟡 Ticket đang được nhân viên xử lý.');
                }

                lastTicketStatus = data.ticket.status;

            } catch (err) {
                console.error(err);
            } finally {
                pollInFlight = false;

                if (ticketActive) {
                    pollingTimer = setTimeout(() => {
                        reloadTicketMessages(ticketId);
                    }, 2000);
                }
            }
        }

        function startPolling(ticketId) {
            if (pollingTimer) clearTimeout(pollingTimer);

            pollingTimer = setTimeout(() => {
                reloadTicketMessages(ticketId);
            }, 2000);
        }
        //  hàm lưu tin nhắn của user vào ticket
        async function saveUserMessage(message, pendingRow = null) {
            const ticketId = localStorage.getItem('current_service_ticket');

            if (!ticketId) {
                return;
            }

            try {
                const res = await fetch(`/service-ticket/${ticketId}/message`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        message: message
                    })
                });

                const data = await res.json();

                if (data.status && data.message?.id) {
                    if (pendingRow) {
                        const serverRow = chatBox.querySelector(
                            `[data-message-id="${data.message.id}"]`
                        );

                        if (serverRow && serverRow !== pendingRow) {
                            pendingRow.remove();
                        } else {
                            pendingRow.dataset.messageId = data.message.id;
                        }
                    }
                }
            } catch (err) {
                console.error('Không lưu được tin nhắn:', err);
            }
        }
        // SUBMIT CHAT
        form.addEventListener('submit', function(e) {

            e.preventDefault();

            const value = input.value.trim();

            if (!value) return;

            const pendingRow = appendMessage('user', value, null, true);

            saveUserMessage(value, pendingRow);

            input.value = '';

            // Nếu đã có ticket thì dừng AI tự hỏi
            if (ticketActive) {
                return;
            }

            if (step < aiQuestions.length) {

                showTyping(aiQuestions[step]);

                // CÂU CUỐI → TẠO TICKET
                if (step === aiQuestions.length - 1) {

                    setTimeout(() => {

                        createServiceRequest();

                    }, 1800);
                }

                updateWorkflow(step);

                step++;
            }
        });

        // UPDATE QUY TRÌNH
        function updateWorkflow(step) {

            // STEP 1
            if (step >= 1) {

                document.getElementById('step1')
                    .classList.add('done');
            }

            // STEP 2
            if (step >= 2) {

                document.getElementById('step2')
                    .classList.add('processing');
            }

            // STEP 3
            if (step >= 3) {

                document.getElementById('step2')
                    .classList.remove('processing');

                document.getElementById('step2')
                    .classList.add('done');

                document.getElementById('step3')
                    .classList.add('processing');
            }

            // KHÔNG AUTO DONE
            if (step >= 4) {

                document.getElementById('step3')
                    .classList.add('processing');
            }
        }
    </script>
</body>

</html>
