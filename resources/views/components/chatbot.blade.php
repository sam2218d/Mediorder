{{-- ===== MEDIORDER AI CHATBOT WIDGET ===== --}}
<div x-data="chatbot()" x-cloak class="fixed bottom-0 right-0 z-[9999]" id="mediorder-chatbot">

    {{-- ===== FLOATING ACTION BUTTON ===== --}}
    <button
        @click="toggle()"
        x-show="!isOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="scale-0 opacity-0"
        x-transition:enter-end="scale-100 opacity-100"
        class="fixed bottom-6 right-6 group flex items-center gap-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white pl-4 pr-5 py-3.5 rounded-full shadow-2xl shadow-emerald-500/30 transition-all duration-300 hover:shadow-emerald-500/50 hover:scale-105"
        id="chatbot-fab"
    >
        {{-- Pulse ring --}}
        <span class="absolute inset-0 rounded-full animate-ping bg-emerald-400 opacity-20"></span>

        {{-- Pharmacy icon --}}
        <span class="relative flex items-center justify-center w-7 h-7 bg-white/20 rounded-full backdrop-blur-sm">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
            </svg>
        </span>
        <span class="relative font-semibold text-sm tracking-wide">Ask Pharmacist</span>
    </button>

    {{-- ===== CHAT PANEL ===== --}}
    <div
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 translate-y-6 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-6 scale-95"
        class="fixed bottom-6 right-6 w-[400px] h-[580px] bg-white rounded-2xl shadow-2xl shadow-black/20 border border-gray-200/80 flex flex-col overflow-hidden"
        style="max-height: calc(100vh - 48px); max-width: calc(100vw - 32px);"
        id="chatbot-panel"
    >
        {{-- ── Header ── --}}
        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-600 px-5 py-4 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-bold text-sm tracking-wide">MediOrder Assistant</h3>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-300 animate-pulse"></span>
                        <span class="text-emerald-100 text-[11px] font-medium">Online • AI Pharmacist</span>
                    </div>
                </div>
            </div>
            <button @click="toggle()" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors" aria-label="Close chat">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- ── Messages Area ── --}}
        <div
            x-ref="messagesContainer"
            class="flex-1 overflow-y-auto px-4 py-4 space-y-4 scroll-smooth"
            style="background: linear-gradient(180deg, #f8faf9 0%, #ffffff 100%);"
        >
            {{-- Messages loop --}}
            <template x-for="(msg, index) in messages" :key="index">
                <div>
                    {{-- Bot message --}}
                    <div x-show="msg.role === 'assistant'" class="flex items-start gap-2.5 max-w-[92%]">
                        <div class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-emerald-700" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                            </svg>
                        </div>
                        <div class="bg-white border border-gray-100 rounded-2xl rounded-tl-md px-4 py-3 shadow-sm">
                            <div class="text-sm text-gray-700 leading-relaxed chatbot-markdown" x-html="renderMarkdown(msg.content)"></div>
                        </div>
                    </div>

                    {{-- User message --}}
                    <div x-show="msg.role === 'user'" class="flex justify-end">
                        <div class="max-w-[80%] bg-gradient-to-br from-emerald-600 to-teal-600 text-white rounded-2xl rounded-tr-md px-4 py-3 shadow-sm">
                            <p class="text-sm leading-relaxed" x-text="msg.content"></p>
                        </div>
                    </div>

                    {{-- Product cards --}}
                    <div x-show="msg.products && msg.products.length > 0" class="mt-3 ml-9">
                        <div class="flex gap-2.5 overflow-x-auto pb-2 scrollbar-thin">
                            <template x-for="(product, pIndex) in (msg.products || [])" :key="'p-' + index + '-' + pIndex">
                                <div class="min-w-[160px] max-w-[160px] bg-white border border-gray-150 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow shrink-0">
                                    {{-- Product Image --}}
                                    <div class="h-24 bg-gradient-to-br from-gray-50 to-emerald-50/30 flex items-center justify-center p-2 relative">
                                        <template x-if="product.requires_prescription">
                                            <span class="absolute top-1.5 left-1.5 bg-orange-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded uppercase">Rx</span>
                                        </template>
                                        <template x-if="product.image">
                                            <img :src="product.image" :alt="product.name" class="max-h-16 max-w-full object-contain">
                                        </template>
                                        <template x-if="!product.image">
                                            <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                                                </svg>
                                            </div>
                                        </template>
                                    </div>
                                    {{-- Product Info --}}
                                    <div class="p-2.5">
                                        <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider" x-text="product.category || 'Medicine'"></p>
                                        <h4 class="text-xs font-bold text-gray-900 leading-tight mt-0.5 line-clamp-2" x-text="product.name"></h4>
                                        <p class="text-sm font-extrabold text-emerald-700 mt-1.5">₹<span x-text="product.price"></span></p>
                                        <button
                                            @click="addProductToCart(product.id)"
                                            class="mt-2 w-full bg-emerald-600 hover:bg-emerald-700 text-white text-[11px] font-bold py-1.5 rounded-lg flex items-center justify-center gap-1 transition-colors"
                                        >
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                            </svg>
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Typing indicator --}}
            <div x-show="isTyping" class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5 text-emerald-700" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                    </svg>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl rounded-tl-md px-5 py-3 shadow-sm">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-bounce" style="animation-delay: 0ms;"></span>
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-bounce" style="animation-delay: 150ms;"></span>
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-bounce" style="animation-delay: 300ms;"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Input Area ── --}}
        <div class="shrink-0 border-t border-gray-100 bg-white px-4 py-3">
            <form @submit.prevent="send()" class="flex items-center gap-2">
                <input
                    x-ref="chatInput"
                    x-model="userInput"
                    type="text"
                    placeholder="Describe your symptoms..."
                    class="flex-1 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-400 transition-all"
                    :disabled="isTyping"
                    maxlength="1000"
                    id="chatbot-input"
                >
                <button
                    type="submit"
                    :disabled="isTyping || !userInput.trim()"
                    class="w-10 h-10 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 disabled:from-gray-300 disabled:to-gray-300 text-white rounded-xl flex items-center justify-center transition-all shadow-sm disabled:shadow-none"
                    id="chatbot-send-btn"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                    </svg>
                </button>
            </form>
            <p class="text-[10px] text-gray-400 text-center mt-2">AI pharmacist • Not a substitute for professional medical advice</p>
        </div>
    </div>
</div>

{{-- ===== CHATBOT STYLES ===== --}}
<style>
    [x-cloak] { display: none !important; }

    /* Custom scrollbar for messages */
    .scrollbar-thin::-webkit-scrollbar { height: 4px; }
    .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
    .scrollbar-thin::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 999px; }

    #chatbot-panel::-webkit-scrollbar { width: 4px; }
    #chatbot-panel *::-webkit-scrollbar { width: 4px; }
    #chatbot-panel *::-webkit-scrollbar-track { background: transparent; }
    #chatbot-panel *::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 999px; }

    /* Markdown rendering inside bot messages */
    .chatbot-markdown p { margin-bottom: 0.5rem; }
    .chatbot-markdown p:last-child { margin-bottom: 0; }
    .chatbot-markdown ul { list-style: disc; padding-left: 1.25rem; margin: 0.4rem 0; }
    .chatbot-markdown ol { list-style: decimal; padding-left: 1.25rem; margin: 0.4rem 0; }
    .chatbot-markdown li { margin-bottom: 0.2rem; font-size: 0.875rem; }
    .chatbot-markdown strong { font-weight: 700; color: #111827; }
    .chatbot-markdown em { font-style: italic; }
    .chatbot-markdown code { background: #f3f4f6; padding: 0.1rem 0.3rem; border-radius: 4px; font-size: 0.8rem; }

    /* Line clamp utility */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
        #chatbot-panel {
            width: calc(100vw - 16px) !important;
            height: calc(100vh - 80px) !important;
            bottom: 8px !important;
            right: 8px !important;
        }
    }
</style>

{{-- ===== CHATBOT ALPINE.JS COMPONENT ===== --}}
<script>
function chatbot() {
    return {
        isOpen: false,
        isTyping: false,
        userInput: '',
        messages: [],
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',

        init() {
            // Greeting message is added on first open
        },

        toggle() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                // Add welcome message on first open
                if (this.messages.length === 0) {
                    this.messages.push({
                        role: 'assistant',
                        content: "Hi! 👋 I'm your **MediOrder pharmacist assistant**.\n\nTell me your symptoms and I'll help you find the right medicine from our catalog.\n\nFor example, you can say:\n- *\"I have a mild fever\"*\n- *\"Something for headache and body pain\"*\n- *\"I need a cough syrup\"*",
                        products: []
                    });
                }
                this.$nextTick(() => {
                    this.$refs.chatInput?.focus();
                    this.scrollToBottom();
                });
            }
        },

        async send() {
            const message = this.userInput.trim();
            if (!message || this.isTyping) return;

            // Add user message
            this.messages.push({ role: 'user', content: message, products: [] });
            this.userInput = '';
            this.isTyping = true;
            this.scrollToBottom();

            // Build conversation history (exclude products for the API)
            const history = this.messages
                .filter(m => m.role === 'user' || m.role === 'assistant')
                .slice(0, -1) // exclude the message we just added
                .map(m => ({ role: m.role, content: m.content }));

            try {
                const response = await fetch('{{ route("chatbot.ask") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ message, history }),
                });

                const data = await response.json();

                this.messages.push({
                    role: 'assistant',
                    content: data.reply || 'I wasn\'t able to generate a response. Please try again.',
                    products: data.products || [],
                });
            } catch (error) {
                console.error('Chatbot error:', error);
                this.messages.push({
                    role: 'assistant',
                    content: 'I\'m sorry, I\'m having trouble connecting right now. Please try again in a moment.',
                    products: [],
                });
            }

            this.isTyping = false;
            this.scrollToBottom();
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const container = this.$refs.messagesContainer;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        },

        renderMarkdown(text) {
            if (!text) return '';
            let html = text
                // Escape HTML entities first
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                // Bold
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                // Italic
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                // Inline code
                .replace(/`(.*?)`/g, '<code>$1</code>')
                // Unordered lists (lines starting with - )
                .replace(/^[\s]*[-•]\s+(.+)$/gm, '<li>$1</li>')
                // Wrap consecutive <li> in <ul>
                .replace(/((?:<li>.*<\/li>\n?)+)/g, '<ul>$1</ul>')
                // Line breaks (double newline = paragraph, single = br)
                .replace(/\n\n/g, '</p><p>')
                .replace(/\n/g, '<br>');

            // Wrap in paragraph if not already
            if (!html.startsWith('<')) {
                html = '<p>' + html + '</p>';
            }

            return html;
        },

        addProductToCart(productId) {
            const cartUrl = `/cart/add/${productId}`;

            fetch(cartUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(response => {
                if (response.ok) {
                    // Update the cart badge
                    const cartBadge = document.getElementById('cart-count');
                    if (cartBadge) {
                        const current = parseInt(cartBadge.innerText) || 0;
                        cartBadge.innerText = current + 1;
                        cartBadge.classList.add('scale-150', 'transition-transform');
                        setTimeout(() => cartBadge.classList.remove('scale-150'), 200);
                    }

                    // Show a quick confirmation in the chat
                    this.messages.push({
                        role: 'assistant',
                        content: '✅ Added to your cart! You can continue browsing or head to checkout when ready.',
                        products: [],
                    });
                    this.scrollToBottom();
                } else if (response.status === 401) {
                    this.messages.push({
                        role: 'assistant',
                        content: '🔒 Please **log in** first to add items to your cart. You can [log in here](/login).',
                        products: [],
                    });
                    this.scrollToBottom();
                } else {
                    this.messages.push({
                        role: 'assistant',
                        content: 'Sorry, I couldn\'t add that to your cart. Please try again.',
                        products: [],
                    });
                    this.scrollToBottom();
                }
            })
            .catch(err => {
                console.error('Add to cart error:', err);
            });
        },
    };
}
</script>
