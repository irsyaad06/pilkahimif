{{-- resources/views/filament/admin/pages/auth/login.blade.php --}}

<x-filament-panels::page.simple>
    <div class="space-y-4 w-full">
        <a 
            href="{{ route('auth.google.redirect') }}" 
            class="w-full px-4 py-3 bg-primary-600 text-white rounded-lg font-semibold flex items-center justify-center gap-2"
        >
            <x-filament::icon icon="heroicon-o-arrow-right-on-rectangle" class="w-5 h-5" />
            Login with Google
        </a>
    </div>
</x-filament-panels::page.simple>
