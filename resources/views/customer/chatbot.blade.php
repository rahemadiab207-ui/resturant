@extends('layout.app')

@section('content')

<div class="container py-5">

```
<div class="mb-4">
    <h1>Customer AI Assistant</h1>
    <p>Ask about meals, categories, beverages, and prices.</p>
</div>

<div class="card shadow-sm">

    <div
        id="chatMessages"
        class="card-body"
        style="height:450px; overflow-y:auto;"
    >
        <div class="alert alert-light">
            Hello! Ask me about our menu.
        </div>
    </div>

    <div class="card-footer">

        <form id="chatForm">

            @csrf

            <div class="input-group">

                <input
                    type="text"
                    id="message"
                    name="message"
                    class="form-control"
                    placeholder="Ask about the menu..."
                    autocomplete="off"
                    required
                >

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Send
                </button>

            </div>

        </form>

    </div>

</div>
```

</div>

<script>
document.getElementById('chatForm').addEventListener('submit', async function (event) {

    event.preventDefault();

    const input = document.getElementById('message');
    const messages = document.getElementById('chatMessages');

    const message = input.value.trim();

    if (!message) {
        return;
    }

    messages.innerHTML += `
        <div class="text-end mb-3">
            <span class="badge bg-primary p-2">
                ${escapeHtml(message)}
            </span>
        </div>
    `;

    input.value = '';

    try {

        const response = await fetch(
            "{{ route('customer.chatbot.respond') }}",
            {
                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },

                body: JSON.stringify({
                    message: message
                })
            }
        );

        const data = await response.json();

        messages.innerHTML += `
            <div class="text-start mb-3">
                <span class="badge bg-light text-dark p-2">
                    ${escapeHtml(data.reply ?? 'No response.')}
                </span>
            </div>
        `;

        messages.scrollTop = messages.scrollHeight;

    } catch (error) {

        messages.innerHTML += `
            <div class="alert alert-danger">
                Something went wrong. Please try again.
            </div>
        `;
    }
});

function escapeHtml(text) {

    const div = document.createElement('div');

    div.textContent = text;

    return div.innerHTML;
}
</script>

@endsection
