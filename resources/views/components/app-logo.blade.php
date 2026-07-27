@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="ILECO III" {{ $attributes }}>
        <x-slot name="logo" class="flex size-10 items-center justify-center ">
            <flux:avatar src="{{ asset('images/logo.png') }}" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="ILECO III" {{ $attributes }}>
        <x-slot name="logo" class="flex size-10 items-center justify-center ">
            <flux:avatar src="{{ asset('images/logo.png') }}" />
        </x-slot>
    </flux:brand>
@endif
