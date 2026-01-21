@if ($shouldShow)
<a href="{{ route('subscription.checkout') }}" class="block w-full mb-3">
    <div class="w-full bg-primary rounded-lg px-6 py-4 flex items-center justify-between gap-4 hover:shadow-lg transition-shadow group">
        <div class="flex items-center gap-3">
            <!-- Crown Icon -->
            <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 5a1 1 0 011-1h14a1 1 0 011 1v10a1 1 0 01-1 1H3a1 1 0 01-1-1V5zm4-3a1 1 0 10-2 0v1H2a3 3 0 00-3 3v10a3 3 0 003 3h14a3 3 0 003-3V6a3 3 0 00-3-3h-1V2a1 1 0 10-2 0v1H6V2zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
            </svg>
            
            <div class="flex flex-col">
                <span class="text-white font-semibold text-sm">Unlock Pro Features</span>
                <span class="text-purple-100 text-xs">Subscribe to pro for unlimited access</span>
            </div>
        </div>
        
        <!-- Arrow indicator -->
        <svg class="w-5 h-5 text-white group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </div>
</a>
@endif
