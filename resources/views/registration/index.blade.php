@extends('layouts.guest')

@section('content')

<div class="hero">

    <div class="overlay"></div>

    <div class="container">

        <section class="hero-card">

            <img
                src="{{ asset('images/logo.png') }}"
                alt="ILECO III Logo"
                class="logo">

            <h1>AGMA 2026</h1>

            <h2>Annual General Membership Assembly</h2>

            <p>Online Registration Portal</p>

        </section>

        <section class="main-card">

            <div class="heading">

                <h2>Select Registration Type</h2>

                <p>
                    Choose the registration category that matches your electric
                    service account.
                </p>

            </div>

            <div class="registration-grid">

                {{-- {{ route('registration.residential') }} --}}
                <a href="" class="registration-card">

                    <h3>Joint / Single Membership</h3>

                    <p>
                        Register as an individual residential consumer using
                        your electric service account information.
                    </p>

                    <span class="btn btn-blue">
                        Continue
                    </span>

                </a>

                {{-- {{ route('registration.public') }} --}}
                <a href="" class="registration-card">

                    <h3>Public Building / Juridical</h3>

                    <p>
                        Register government offices, schools, cooperatives,
                        companies, and other juridical entities.
                    </p>

                    <span class="btn btn-green">
                        Continue
                    </span>

                </a>

            </div>

            <div class="info-box">

                <h4>Before You Begin</h4>

                <p>
                    Please select the registration type that matches your
                    electric service account. The next page will display the
                    appropriate registration form.
                </p>

            </div>

        </section>

    </div>

</div>

@endsection