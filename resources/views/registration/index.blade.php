@extends('layouts.guest')

@section('content')

<div
    class="relative min-h-screen overflow-hidden bg-cover bg-center bg-fixed py-12"
    style="background-image: url('{{ asset('images/bg.jpg') }}');">

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <!-- Content -->
    <div class="relative z-10 mx-auto max-w-5xl px-6">

    <div class="mx-auto max-w-5xl px-6">

        <!-- Hero -->
        <div class="rounded-3xl bg-gradient-to-r from-[#084880] to-[#0b63b8] px-10 py-12 text-center text-white shadow-2xl">

            <img
                src="{{ asset('logo.png') }}"
                alt="ILECO III"
                class="mx-auto h-24 w-24 rounded-full bg-white p-2 shadow-lg">

            <h1 class="mt-6 text-4xl font-bold tracking-wide">
                AGMA 2026
            </h1>

            <p class="mt-2 text-lg text-blue-100">
                Annual General Membership Assembly
            </p>

            <p class="text-blue-200">
                Online Registration Portal
            </p>

        </div>

        <!-- Main Card -->
        <div class="-mt-8 rounded-3xl bg-white p-10 shadow-2xl">

            <div class="text-center">

                <h2 class="text-3xl font-bold text-slate-800">
                    Select Registration Type
                </h2>

                <p class="mt-2 text-gray-500">
                    Choose the registration category that applies to your electric service account.
                </p>

            </div>

            <div class="mt-10 grid gap-8 md:grid-cols-2">

                <!-- Residential -->
                {{-- {{ route('registration.residential') }} --}}
                <a href=""
                class="group rounded-2xl border border-gray-200 p-8 transition duration-300 hover:-translate-y-1 hover:border-[#084880] hover:shadow-xl">

                    <h3 class="text-center text-2xl font-bold text-gray-800">
                        Joint/Single Membership
                    </h3>

                    <p class="mt-4 text-center text-gray-500 leading-relaxed">
                        Register as an individual residential consumer using your electric service account information.
                    </p>

                    <div class="mt-8">
                        <span class="block rounded-xl bg-[#084880] py-3 text-center font-semibold text-white transition hover:bg-[#063763]">
                            Continue
                        </span>
                    </div>

                </a>

                <!-- Public Building -->
                {{-- {{ route('registration.public') }} --}}
                <a href=""
                class="group rounded-2xl border border-gray-200 p-8 transition duration-300 hover:-translate-y-1 hover:border-[#5CB20D] hover:shadow-xl">

                    <h3 class="text-center text-2xl font-bold text-gray-800">
                        Public Building / Juridical
                    </h3>

                    <p class="mt-4 text-center text-gray-500 leading-relaxed">
                        Register government offices, schools, companies, and other juridical entities.
                    </p>

                    <div class="mt-8">
                        <span class="block rounded-xl bg-[#5CB20D] py-3 text-center font-semibold text-white transition hover:bg-[#4a920a]">
                            Continue
                        </span>
                    </div>

                </a>

            </div>

            <!-- Information -->
            <div class="mt-10 rounded-2xl border border-blue-200 bg-blue-50 p-6">

                <div class="flex items-start gap-4">

                    <div class="text-3xl">
                        ℹ️
                    </div>

                    <div>

                        <h4 class="text-lg font-semibold text-blue-900">
                            Before You Begin
                        </h4>

                        <p class="mt-2 text-sm leading-6 text-blue-800">
                            Select the registration type that matches your electric service account.
                            The next page will display the appropriate registration form and required
                            information based on your selected category.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection