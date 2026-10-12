@extends('layouts.guest')

@section('content')

<div class="container mx-auto max-w-5xl py-10">

    <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-2xl shadow-xl text-white text-center p-10">

        <img src="{{ asset('logo.png') }}"
             class="w-24 mx-auto mb-5">

        <h1 class="text-4xl font-bold">
            AGMA 2026
        </h1>

        <p class="text-blue-100 mt-2 text-lg">
            Annual General Membership Assembly
        </p>

        <p class="text-blue-200">
            Online Registration Portal
        </p>

    </div>

    <div class="-mt-10">

        <x-bladewind.card class="rounded-2xl shadow-2xl">

            <div class="text-center py-4">

                <h2 class="text-3xl font-bold text-slate-800">
                    Select Registration Type
                </h2>

                <p class="text-gray-500 mt-2">
                    Choose the registration category that applies to you.
                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">

                <div class="border rounded-xl p-8 hover:border-blue-700 hover:shadow-xl transition cursor-pointer">

                    <div class="text-center">

                        <div class="text-6xl mb-4">
                            🏠
                        </div>

                        <h3 class="text-2xl font-bold">
                            Residential
                        </h3>

                        <p class="text-gray-500 mt-3 mb-6">
                            Register as a residential consumer.
                        </p>

                        <x-bladewind.button
                            color="blue"
                            size="big"
                            class="w-full">
                            Continue
                        </x-bladewind.button>

                    </div>

                </div>

                <div class="border rounded-xl p-8 hover:border-green-600 hover:shadow-xl transition cursor-pointer">

                    <div class="text-center">

                        <div class="text-6xl mb-4">
                            🏢
                        </div>

                        <h3 class="text-2xl font-bold">
                            Public Building / Juridical
                        </h3>

                        <p class="text-gray-500 mt-3 mb-6">
                            Register a government office, institution, cooperative, business establishment, or other juridical entity.
                        </p>

                        <x-bladewind.button
                            color="green"
                            size="big"
                            class="w-full">
                            Continue
                        </x-bladewind.button>

                    </div>

                </div>

            </div>

            <div class="mt-10">

                <x-bladewind.alert
                    type="info"
                    title="Before You Begin">

                    Please select the registration type that matches your electric service account. The next page will ask for the required information based on your selection.

                </x-bladewind.alert>

            </div>

        </x-bladewind.card>

    </div>

</div>

@endsection