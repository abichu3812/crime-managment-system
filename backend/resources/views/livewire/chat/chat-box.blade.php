<div style="background-color:rgb(60, 87, 145)"
    x-data="{
        height:0,
        conversationElement:document.getElementById('conversation'),
        markAsRead:null
    }"
    x-init="
        height = conversationElement.scrollHeight;
        $nextTick(() => conversationElement.scrollTop = height);

        Echo.private('users.{{Auth()->User()->id}}')
            .notification((notification) => {
                if(notification['type'] === 'App\\Notifications\\MessageRead' && 
                   notification['conversation_id'] === {{$this->selectedConversation->id ?? 0}}) {
                    markAsRead = true;
                }
            });
    "
    @scroll-bottom.window="
        $nextTick(() => conversationElement.scrollTop = conversationElement.scrollHeight);
    "
    class="w-full overflow-hidden">

    <div class="border-b flex flex-col overflow-y-scroll grow h-full">
        {{-- Header --}}
        <header style="background-color: rgb(191, 200, 218)" class="w-full sticky inset-x-0 flex pb-[5px] pt-[5px] top-0 z-10 bg-white border-b">
            <div class="flex w-full items-center px-2 lg:px-4 gap-2 md:gap-5">
                <a class="shrink-0 lg:hidden" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>
                </a>

                {{-- Receiver's Avatar --}}
 
                <div class="shrink-0">
    <a href="#" style="position: relative; display: block;">
        <x-avatar src="{{ !empty($selectedConversation->getReceiver()->photo) ? url('upload/admin_image/'.$selectedConversation->getReceiver()->photo) : url('upload/no_image.jpg') }}" />
        
        @if(empty($selectedConversation->getReceiver()->photo))
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; text-transform: uppercase; pointer-events: none;">
                {{ substr(optional($selectedConversation->getReceiver())->name, 0, 1) }}
            </div>
        @endif
    </a>
</div>

                <h6 class="font-bold truncate">
                    {{ $selectedConversation->getReceiver()?->name ?? 'Unknown User' }}
                </h6>
            </div>
        </header>

        {{-- Chat Messages --}}
        <main 
            @scroll="
                scropTop = $el.scrollTop;
                if(scropTop <= 0) {
                    window.livewire.emit('loadMore');
                }
            "
            @update-chat-height.window="
                newHeight = $el.scrollHeight;
                oldHeight = height;
                $el.scrollTop = newHeight - oldHeight;
                height = newHeight;
            "
            id="conversation" 
            class="flex flex-col gap-3 p-2.5 overflow-y-auto flex-grow overscroll-contain overflow-x-hidden w-full my-auto">

            @if ($loadedMessages)
                @php $previousMessage = null; @endphp

                @foreach ($loadedMessages as $key => $message)
                    @php
                        // Skip messages not from current user or selected receiver
                        if($message->sender_id !== auth()->id() && 
                        $message->sender_id !== $selectedConversation->getReceiver()?->id) {
                            continue; // <-- Remove @ symbol
                        }
                        
                        if($key > 0) $previousMessage = $loadedMessages->get($key-1);
                    @endphp

                    <div wire:key="{{ time().$key }}" 
                        @class([
                            'max-w-[85%] md:max-w-[78%] flex w-auto gap-2 relative mt-2',
                            'ml-auto' => $message->sender_id === auth()->id()
                        ])>
                        
                        {{-- Show receiver's avatar for their messages --}}
                        <div @class([
                            'shrink-0',
                            'invisible' => $previousMessage?->sender_id === $message->sender_id,
                            'hidden' => $message->sender_id === auth()->id()
                        ])>
                         
                                        <x-avatar src="{{ !empty($selectedConversation->getReceiver()->photo) ? url('upload/admin_image/'.$selectedConversation->getReceiver()->photo) : url('upload/no_image.jpg') }}" />
        
        @if(empty($selectedConversation->getReceiver()->photo))
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; text-transform: uppercase; pointer-events: none;">
                {{ substr(optional($selectedConversation->getReceiver())->name, 0, 1) }}
            </div>
        @endif
                        </div>

                        {{-- Message Body --}}
                        <div @class([
                            'flex flex-wrap text-[15px] rounded-xl p-2.5 flex-col text-black bg-[#f6f6f8fb]',
                            'rounded-bl-none border border-gray-200/40' => $message->sender_id !== auth()->id(),
                            'rounded-br-none bg-blue-500/80 text-white' => $message->sender_id === auth()->id()
                        ])>
                            <p class="whitespace-normal truncate text-sm md:text-base tracking-wide lg:tracking-normal">
                                {{ $message->body }}
                            </p>

                            <div class="ml-auto flex gap-2">
                                <p @class([
                                    'text-xs',
                                    'text-gray-500' => $message->sender_id !== auth()->id(),
                                    'text-white' => $message->sender_id === auth()->id()
                                ])>
                                    {{ $message->created_at->format('g:i a') }}
                                </p>

                                @if($message->sender_id === auth()->id())
                                    <div x-data="{ markAsRead: @json($message->isRead() ?? false) }">
                                        <span x-cloak x-show="markAsRead" class="text-gray-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                            </svg>
                                        </span>
                                        <span x-show="!markAsRead" class="text-gray-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                            </svg>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </main>

        {{-- Message Input --}}
        <footer style="background-color: rgb(201, 213, 238)" class="shrink-0 z-10 bg-white inset-x-0">
            <div class="p-2 border-t">
                <form x-data="{ body: @entangle('body').defer }" 
                    @submit.prevent="$wire.sendMessage"
                    class="p-4 bg-white rounded-lg shadow-md border border-gray-200">
                    
                    <input type="hidden" autocomplete="false" style="display: none">
                    
                    <div class="flex items-center gap-2">
                        <input x-model="body" 
                            type="text" 
                            placeholder="Write your message here..."
                            class="flex-grow px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 hover:bg-gray-200 transition">
                        
                        <button x-bind:disabled="!body.trim()" 
                            type="submit"
                            class="px-8 py-3 text-white bg-blue-500 rounded-lg text-sm font-medium hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed transition">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </footer>
    </div>
</div>