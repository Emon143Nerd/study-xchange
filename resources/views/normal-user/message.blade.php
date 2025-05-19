<style>
    .notification-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    }

    .success-message {
        background: linear-gradient(to right, #28a745, #218838);
        color: white;
        padding: 16px 24px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 300px;
        max-width: 450px;
        animation: slideIn 0.3s ease-out, fadeOut 0.3s ease-out 2.7s;
        position: relative;
        overflow: hidden;
    }

    .success-message.hidden {
        display: none;
    }

    .success-message::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: rgba(255, 255, 255, 0.3);
        animation: timer 3s linear;
    }

    .success-icon {
        width: 24px;
        height: 24px;
    }

    .message-content {
        flex-grow: 1;
    }

    .close-button {
        background: transparent;
        border: none;
        color: white;
        cursor: pointer;
        padding: 4px;
        opacity: 0.8;
        transition: opacity 0.2s;
    }

    .close-button:hover {
        opacity: 1;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    @keyframes timer {
        from {
            width: 100%;
        }
        to {
            width: 0%;
        }
    }
</style>
<div class="notification-container">
    <div id="successMessage" class="success-message hidden">
        <svg class="success-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M22 4L12 14.01l-3-3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="message-content">
            <span id="messageText">{{ session('message') }}</span>
        </div>
        <button class="close-button" onclick="closeSuccessMessage()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = "{{ session('message') }}";
        if (successMessage) {
            const messageDiv = document.getElementById('successMessage');
            const messageText = document.getElementById('messageText');
            messageText.textContent = successMessage;
            messageDiv.classList.remove('hidden');

            setTimeout(() => {
                closeSuccessMessage();
            }, 3000);
        }
    });

    function closeSuccessMessage() {
        const messageDiv = document.getElementById('successMessage');
        messageDiv.classList.add('hidden');
    }
</script>
