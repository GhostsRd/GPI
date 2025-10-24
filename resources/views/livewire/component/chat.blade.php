<div>
    <aside wire:ignore.self class="chat-popup" id="chatPopup" role="dialog" tabindex="-1" style="z-index: 4000"
        aria-modal="false" aria-label="Fenêtre de chat">
        <header class="chat-header">
            <div> <img width="50" style="cursor: pointer" class="mt-2 shadow-sm   rounded-pill"
                    src="{{ asset('/images/avtar_1.png') }}" alt="Photo de profil">
            </div>
            <div class="chat-title">
                <h4>{{ $utilisateurs->nom }}</h4>
                <p>{{ $utilisateurs->poste }}</p>
            </div>
            <button class="chat-close" id="chatClose" aria-label="Fermer">✕</button>
        </header>

        <div class="chat-messages" id="messages" aria-live="polite">
            @foreach ($Chats as $chat)
                <!-- sample messages -->

                <div class="msg {{ $chat->type == 'user' ? 'user' : 'agent' }}">{{ $chat->message }}<small>Vous ·
                        {{ \Carbon\Carbon::parse($chat->created_at)->translatedFormat('d M Y H:i') }} </small></div>

                {{-- <div class="msg user">Salut, j'ai un problème avec mon compte<small>Vous · 08:56</small></div>
      
      <div class="msg agent">D'accord, peux-tu préciser ?<small>Support · 08:57</small></div>
      <div class="msg agent">{{$chat->message}}<small>Vous · {{$chat->created_at}}</small></div> --}}
            @endforeach
        </div>

        <form wire:submit.prevent="EnvoyerMessage" class="p-2">
            <textarea id="input" wire:model="message" class="chat-input" rows="1" placeholder="Écris un message..."></textarea>
            <button id="sendBtn" type="submit" class="btn border-0 btn-primary btn-sm">Envoyer</button>
        </form>
    </aside>
</div>
<style>
    /* Reset minimal */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0
    }

    html,
    body {
        height: 100%
    }

    body {
        font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
        background: #f3f4f6
    }

    /* Floating button */
    .chat-toggle {
        position: fixed;
        right: 24px;
        bottom: 24px;
        z-index: 1000;
        width: 56px;
        height: 56px;
        border-radius: 28px;
        background: #0b84ff;
        color: #fff;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 18px rgba(11, 132, 255, .24);
        font-weight: 700;
        font-size: 18px
    }

    /* Popup container */
    .chat-popup {
        position: fixed;
        right: 24px;
        bottom: 92px;
        z-index: 1000;
        width: 360px;
        max-width: 92vw;
        height: 520px;
        max-height: 80vh;
        display: flex;
        flex-direction: column;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 18px 50px rgba(15, 23, 42, .2);
        overflow: hidden;
        transform: translateY(20px);
        opacity: 0;
        pointer-events: none;
        transition: all .26s cubic-bezier(.2, .9, .3, 1);
    }

    .chat-popup.open {
        transform: translateY(0);
        opacity: 1;
        pointer-events: auto
    }

    /* Header */
    .chat-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-bottom: 1px solid #eef2f7;
        background: linear-gradient(90deg, #f8fafc, #fff)
    }

    .chat-avatar {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: linear-gradient(135deg, #0b84ff, #0047b3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700
    }

    .chat-title {
        flex: 1
    }

    .chat-title h4 {
        font-size: 15px;
        margin-bottom: 2px
    }

    .chat-title p {
        font-size: 12px;
        color: #64748b
    }

    .chat-close {
        background: transparent;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #64748b
    }

    /* Messages area */
    .chat-messages {
        flex: 1;
        padding: 12px;
        overflow: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%)
    }

    .msg {
        max-width: 78%;
        padding: 10px 14px;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.35
    }

    .msg.agent {
        align-self: flex-start;
        background: #f1f5f9;
        color: #0f172a;
        border-bottom-left-radius: 4px
    }

    .msg.user {
        align-self: flex-end;
        background: #0b84ff;
        color: #fff;
        border-bottom-right-radius: 4px
    }

    .msg small {
        display: block;
        margin-top: 6px;
        font-size: 11px;
        opacity: .75
    }

    /* Composer */
    .chat-composer {
        padding: 10px;
        border-top: 1px solid #eef2f7;
        display: flex;
        gap: 8px;
        align-items: center
    }

    .chat-input {
        flex: 1;
        background: #f8fafc;
        border: 1px solid #e6eef9;
        padding: 10px 12px;
        border-radius: 10px;
        min-height: 40px;
        resize: none
    }

    .btn-send {
        background: #0b84ff;
        color: #fff;
        border: none;
        padding: 10px 12px;
        border-radius: 10px;
        cursor: pointer
    }

    /* Tiny responsive tweak */
    @media (max-width:420px) {
        .chat-popup {
            right: 12px;
            left: 12px;
            width: calc(100% - 24px);
            bottom: 80px
        }

        .chat-toggle {
            right: 12px;
            bottom: 12px
        }
    }
</style>



<script>
    const toggle = document.getElementById('chatToggle');
    const popup = document.getElementById('chatPopup');
    const closeBtn = document.getElementById('chatClose');
    const messages = document.getElementById('messages');
    const input = document.getElementById('input');
    const sendBtn = document.getElementById('sendBtn');

    function openChat() {
        popup.classList.add('open');
        toggle.style.display = 'none';
        input.focus();
        scrollToBottom()
    }

    function closeChat() {
        popup.classList.remove('open');
        toggle.style.display = 'flex'
    }

    toggle.addEventListener('click', openChat);
    closeBtn.addEventListener('click', closeChat);

    // send message
    function appendMessage(text, who) {
        const el = document.createElement('div');
        el.className = 'msg ' + (who === 'user' ? 'user' : 'agent');
        const now = new Date();
        const hh = now.getHours().toString().padStart(2, '0');
        const mm = now.getMinutes().toString().padStart(2, '0');
        el.innerHTML = text + '<small>' + (who === 'user' ? 'Vous' : 'Support') + ' · ' + hh + ':' + mm + '</small>';
        messages.appendChild(el);
        scrollToBottom();
    }

    function scrollToBottom() {
        messages.scrollTop = messages.scrollHeight
    }



    // simple escape to avoid injection when inserting HTML
    function escapeHtml(s) {
        return s.replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;').replaceAll('"', '&quot;')
            .replaceAll("'", "&#39;")
    }

    // allow enter to send (shift+enter for newline)
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendBtn.click();
        }
    });

    // accessibility: close with escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && popup.classList.contains('open')) closeChat();
    });
</script>
