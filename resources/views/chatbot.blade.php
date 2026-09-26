@extends('layout.app')

@section('title', 'AI Assistant')

@section('content')

<div class="container py-4">

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">AI Assistant</h1>
            <p class="page-subtitle">
                مساعدك لإدارة المطعم ومتابعة البيانات
            </p>
        </div>
    </div>

    <div class="card-modern">

        <div class="chat-header">
            <div>
                <div class="chat-title">Restaurant Assistant</div>
                <div class="chat-status">
                    <span class="status-dot"></span>
                    Online
                </div>
            </div>
        </div>

        <div
            id="chatMessages"
            class="chat-messages"
        >
            <div class="message-row assistant">
                <div class="message-bubble">
                    أهلاً بك 👋<br>
                    اسألني عن العملاء أو الطلبات أو المبيعات أو الوجبات أو التصنيفات.
                </div>
            </div>
        </div>

        <form
            id="chatForm"
            class="chat-form"
        >
            @csrf

            <input
                type="text"
                id="message"
                name="message"
                class="form-control-modern"
                placeholder="اكتب سؤالك هنا..."
                autocomplete="off"
                required
            >

            <button
                type="submit"
                class="btn-modern btn-primary-modern"
                id="sendButton"
            >
                إرسال
            </button>
        </form>

    </div>

</div>

@endsection

@push('styles')

<style>

.chat-header {
    padding: 22px 24px;
    border-bottom: 1px solid #e5e7eb;
}

.chat-title {
    font-size: 20px;
    font-weight: 800;
    color: #111827;
}

.chat-status {
    margin-top: 5px;
    color: #6b7280;
    font-size: 13px;
}

.status-dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #16a34a;
    margin-right: 5px;
}

.chat-messages {
    height: 460px;
    overflow-y: auto;
    padding: 24px;
    background: #f8fafc;
}

.message-row {
    display: flex;
    margin-bottom: 16px;
}

.message-row.assistant {
    justify-content: flex-start;
}

.message-row.user {
    justify-content: flex-end;
}

.message-bubble {
    max-width: 75%;
    padding: 12px 16px;
    border-radius: 14px;
    background: white;
    border: 1px solid #e5e7eb;
    color: #1f2937;
    line-height: 1.7;
    white-space: pre-line;
}

.message-row.user .message-bubble {
    background: #2563eb;
    color: white;
    border-color: #2563eb;
}

.chat-form {
    display: flex;
    gap: 12px;
    padding: 20px;
    border-top: 1px solid #e5e7eb;
}

</style>

@endpush

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('chatForm');
    const input = document.getElementById('message');
    const messages = document.getElementById('chatMessages');
    const sendButton = document.getElementById('sendButton');

    form.addEventListener('submit', async function (event) {

        event.preventDefault();

        const message = input.value.trim();

        if (!message) {
            return;
        }

        messages.innerHTML += `
            <div class="message-row user">
                <div class="message-bubble">
                    ${escapeHtml(message)}
                </div>
            </div>
        `;

        input.value = '';

        sendButton.disabled = true;
        sendButton.innerText = '...';

        scrollToBottom();

        try {

            const response = await fetch(
                "{{ route('chatbot.respond') }}",
                {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN':
                            document
                                .querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content')
                    },

                    body: JSON.stringify({
                        message: message
                    })
                }
            );

            const data = await response.json();

            if (data.success) {

                messages.innerHTML += `
                    <div class="message-row assistant">
                        <div class="message-bubble">
                            ${escapeHtml(data.message)}
                        </div>
                    </div>
                `;

            } else {

                messages.innerHTML += `
                    <div class="message-row assistant">
                        <div class="message-bubble">
                            حدث خطأ أثناء معالجة الطلب.
                        </div>
                    </div>
                `;
            }

        } catch (error) {

            messages.innerHTML += `
                <div class="message-row assistant">
                    <div class="message-bubble">
                        حدث خطأ في الاتصال بالخادم.
                    </div>
                </div>
            `;

        } finally {

            sendButton.disabled = false;
            sendButton.innerText = 'إرسال';

            scrollToBottom();
        }
    });

    function scrollToBottom() {
        messages.scrollTop = messages.scrollHeight;
    }

    function escapeHtml(text) {

        const div = document.createElement('div');

        div.textContent = text;

        return div.innerHTML;
    }

});

</script>

@endpush