<button wire:click="changeTheme"
        class="cursor-pointer transition-colors p-2 w-10 rounded-xl h-auto dark:hover:bg-gray-700 hover:bg-gray-200 text-gray-500 dark:text-gray-400 {{ $class }}">
    @svg('mdi-theme-light-dark')
</button>
