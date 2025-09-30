<div x-data="{ open: false }"
    class="fixed top-0 left-0 right-0 z-50 w-full px-5 py-2 bg-white border-b-4 border-b-teal-500 text-sm">
    <div class="flex items-center justify-between">
        <div>
            <strong id="name">Componist Developer Bar</strong> | ENV: {{ app()->environment() }} | Locale: {{ app()->getLocale() }}
        </div>

        <button type="button" @click.prevent="open = ! open">
            open
        </button>
    </div>

    <div x-show="open">
        <div>
            <button wire:click="clearCache"
                style="background: #3182ce; color: white; padding: 5px 10px; border: none; border-radius: 3px;">
                Cache leeren
            </button>
        </div>

        @if ($message)
            <div style="margin-left: 20px; color: #68d391;">
                {{ $message }}
            </div>
        @endif
    </div>

</div>
