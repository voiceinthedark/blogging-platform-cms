<x-form-section submit="update">
    <x-slot name="title">
        {{ __('Social Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s Social information.') }}
    </x-slot>

    <x-slot name="form">

        <!-- Username -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="username" value="{{ __('Username') }}" />
            <x-input id="username" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="username"
                autocomplete="off" />
            {{-- <x-input-error for="username" class="mt-2" /> --}}
            @error('username')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Twitter handle -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="twitter" value="{{ __('twitter') }}" />
            <x-input id="twitter" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="twitter"
                autocomplete="twitter" />
            <x-input-error for="twitter" class="mt-2" />
        </div>

        <!-- facebook handle -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="facebook" value="{{ __('facebook') }}" />
            <x-input id="facebook" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="facebook"
                autocomplete="facebook" />
            <x-input-error for="facebook" class="mt-2" />
        </div>

        <!-- instagram handle -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="instagram" value="{{ __('instagram') }}" />
            <x-input id="instagram" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="instagram"
                autocomplete="instagram" />
            <x-input-error for="instagram" class="mt-2" />
        </div>

        <!-- github handle -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="github" value="{{ __('github') }}" />
            <x-input id="github" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="github"
                autocomplete="github" />
            <x-input-error for="github" class="mt-2" />
        </div>

        <!-- Bio -->
        <!-- TODO: Fix the flashing invisible textarea's textContent -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea-wireui wire:model.debounce.500ms="bio" label="Bio"
                ></x-textarea-wireui>
            <x-input-error for="bio" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="bio">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
