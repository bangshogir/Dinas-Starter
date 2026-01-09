<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<form wire:submit="updatePassword">
    <div class="mb-4">
        <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" />
        <div class="relative">
            <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password"
                type="password" class="mt-1 block w-full" autocomplete="current-password" />
        </div>
        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
    </div>

    <div class="mb-4 grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7">
        <div>
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" />
            <x-text-input wire:model="password" id="update_password_password" name="password" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
            <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation"
                name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
    </div>

    <div class="flex items-center justify-end gap-4 mt-6">
        <x-action-message class="me-3" on="password-updated">
            {{ __('Tersimpan.') }}
        </x-action-message>

        <x-primary-button>{{ __('Simpan') }}</x-primary-button>
    </div>
</form>