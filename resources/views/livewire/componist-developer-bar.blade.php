<div x-data="{ open: false }"
    class="fixed left-0 right-0 top-0 z-50 w-full border-b-4 border-b-teal-500 bg-white px-5 py-2 text-sm text-slate-900 dark:bg-slate-900 dark:text-slate-100">
    <div class="flex items-center justify-between">
        <div>
            <strong id="name">Componist Developer Bar</strong> | ENV: {{ app()->environment() }} | Locale: {{ app()->getLocale() }}
        </div>

        <button type="button" class="text-slate-600 hover:text-teal-500 dark:text-slate-300 dark:hover:text-teal-400" @click.prevent="open = ! open">
            open
        </button>
    </div>

    <div x-show="open">
        <div>
            <button wire:click="clearCache"
                class="rounded bg-teal-500 px-2.5 py-1.5 text-white hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500">
                Cache leeren
            </button>
        </div>

        @if ($message)
            <div class="ml-5 text-teal-600 dark:text-teal-400">
                {{ $message }}
            </div>
        @endif
    </div>

</div>
