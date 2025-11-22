<div class="fixed inset-0 flex h-full bg-white border lg:shadow-sm overflow-hidden lg:top-16 lg:inset-x-2 lg:m-auto lg:h-[90%] rounded-t-lg" style="background-color:rgb(60, 87, 145)">

    <!-- Sidebar -->
    <div class="hidden lg:flex relative w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border">
        <livewire:chat.chat-list :selectedConversation="$selectedConversation" :query="$query">
    </div>

    <!-- Chat Box -->
    <div class="grid w-full h-full border-l relative overflow-y-auto p-4" style="contain:content">
        <livewire:chat.chat-box :selectedConversation="$selectedConversation">
    </div>
</div>
