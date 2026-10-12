<?php

use Livewire\Component;

new class extends Component
{
    public function residential()
    {
        // TODO
    }

    public function publicBuilding()
    {
        // TODO
    }
};

?>

<div class="min-h-screen bg-zinc-100">

    <div class="container mx-auto max-w-5xl px-6 py-10">

        <!-- Hero -->
        <div class="rounded-3xl bg-gradient-to-r from-blue-900 to-blue-700 p-10 text-center text-white shadow-xl">

            <img
                src="{{ asset('logo.png') }}"
                alt="AGMA 2026"
                class="mx-auto mb-5 w-24 rounded-full bg-white p-2">

            <h1 class="text-4xl font-bold">
                AGMA 2026
            </h1>

            <p class="mt-2 text-lg text-blue-100">
                Annual General Membership Assembly
            </p>

            <p class="text-blue-200">
                Online Registration Portal
            </p>

        </div>

        <!-- Card -->
        <div class="-mt-10">

            <div class="rounded-2xl bg-white p-10 shadow-2xl">

                <div class="text-center">

                    <h2 class="text-3xl font-bold text-slate-800">
                        Select Registration Type
                    </h2>

                    <p class="mt-2 text-gray-500">
                        Choose the registration category that applies to you.
                    </p>

                </div>

                <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2">

                    <!-- Residential -->
                    <button
                        wire:click="residential"
                        class="rounded-xl border p-8 text-center transition hover:border-blue-700 hover:shadow-xl">

                        <div class="mb-4 text-6xl">
                            🏠
                        </div>

                        <h3 class="text-2xl font-bold">
                            Residential
                        </h3>

                        <p class="mt-3 mb-6 text-gray-500">
                            Register as a residential consumer.
                        </p>

                        <button
                            type="button"
                            class="w-full rounded-lg bg-blue-700 px-4 py-3 font-medium text-white hover:bg-blue-800">
                            Continue
                        </button>

                    </button>

                    <!-- Public -->
                    <button
                        wire:click="publicBuilding"
                        class="rounded-xl border p-8 text-center transition hover:border-green-600 hover:shadow-xl">

                        <div class="mb-4 text-6xl">
                            🏢
                        </div>

                        <h3 class="text-2xl font-bold">
                            Public Building / Juridical
                        </h3>

                        <p class="mt-3 mb-6 text-gray-500">
                            Register a government office, institution, cooperative, business establishment, or other juridical entity.
                        </p>

                        <button
                            type="button"
                            class="w-full rounded-lg bg-green-600 px-4 py-3 font-medium text-white hover:bg-green-700">
                            Continue
                        </button>

                    </button>

                </div>

                <!-- Information -->
                <div class="mt-10 rounded-xl border border-blue-200 bg-blue-50 p-5">

                    <h4 class="font-semibold text-blue-900">
                        Before You Begin
                    </h4>

                    <p class="mt-2 text-sm text-blue-800">
                        Please select the registration type that matches your electric service account. The next page will ask for the required information based on your selection.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>
