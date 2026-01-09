<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600']) }}>
    {{ $slot }}
</button>