{{-- المساعد المعرفي الذكي العائم — مدعوم بـ n8n --}}
<div class="ai-chatbot-widget" id="ofuqChatbot">
    <!-- Popover Panel -->
    <div class="ai-chatbot-panel" id="chatbotPanel">
        <div class="ai-chat-header">
            <h4>
                <i class="fas fa-sparkles text-purple"></i>
                المساعد المعرفي — أُفُق وَرَق
            </h4>
            <button type="button" class="ai-chat-close" id="chatbotClose" aria-label="إغلاق">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="ai-chat-messages" id="chatMessages">
            <div class="ai-msg ai-msg--bot">
                مرحباً بك في <strong>أُفُق وَرَق</strong>! 📖✨
                <br>
                أنا مساعدك الذكي، يمكنك سؤالي عن أي كتاب، أو البحث عن موضوع معين، أو الاستفسار عن المراجع والسلايدات الجامعية. كيف أساعدك اليوم؟
            </div>
        </div>

        <form class="ai-chat-input-area" id="chatbotForm" onsubmit="handleChatSubmit(event)">
            <input type="text" id="chatInput" placeholder="اسأل عن أي كتاب أو موضوع..." autocomplete="off" required>
            <button type="submit" aria-label="إرسال">
                <i class="fas fa-paper-plane" style="transform: scaleX(-1);"></i>
            </button>
        </form>
    </div>

    <!-- Floating Trigger Button -->
    <button type="button" class="ai-chatbot-btn" id="chatbotToggle" aria-label="المساعد المعرفي الذكي (AI)" title="المساعد المعرفي الذكي (AI)">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">
            <path d="M12 2L14.4 8.3L20.7 10.7L14.4 13.1L12 19.4L9.6 13.1L3.3 10.7L9.6 8.3L12 2Z" fill="#ffffff"/>
            <path d="M19 15L20.2 18.2L23.4 19.4L20.2 20.6L19 23.8L17.8 20.6L14.6 19.4L17.8 18.2L19 15Z" fill="#c9bcff"/>
        </svg>
        <span class="ping-dot" title="المساعد الذكي متصل"></span>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('chatbotToggle');
        const closeBtn = document.getElementById('chatbotClose');
        const panel = document.getElementById('chatbotPanel');
        const form = document.getElementById('chatbotForm');
        const input = document.getElementById('chatInput');
        const messages = document.getElementById('chatMessages');

        if (toggleBtn && panel) {
            toggleBtn.addEventListener('click', function () {
                panel.classList.toggle('is-open');
                if (panel.classList.contains('is-open')) {
                    input.focus();
                }
            });
        }

        if (closeBtn && panel) {
            closeBtn.addEventListener('click', function () {
                panel.classList.remove('is-open');
            });
        }

        window.handleChatSubmit = function (e) {
            e.preventDefault();
            const text = input.value.trim();
            if (!text) return;

            // User Message
            const userMsg = document.createElement('div');
            userMsg.className = 'ai-msg ai-msg--user';
            userMsg.textContent = text;
            messages.appendChild(userMsg);
            input.value = '';
            messages.scrollTop = messages.scrollHeight;

            // Bot Typing Indicator
            const botMsg = document.createElement('div');
            botMsg.className = 'ai-msg ai-msg--bot';
            botMsg.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> جارٍ البحث في مكتبة أُفُق ورقة...';
            messages.appendChild(botMsg);
            messages.scrollTop = messages.scrollHeight;

            // Simulated response or call to n8n webhook endpoint
            setTimeout(() => {
                botMsg.innerHTML = 'تم استلام استفسارك حول: <strong>"' + escapeHtml(text) + '"</strong>.<br>يجري ربط الشات بوت بمحرك الذكاء الاصطناعي (n8n Webhook) لعرض الكتب والمراجع المقترحة فوراً!';
                messages.scrollTop = messages.scrollHeight;
            }, 700);
        };

        function escapeHtml(str) {
            return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }
    });
</script>
