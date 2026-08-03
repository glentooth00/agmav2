@extends('layouts.guest')

@section('content')

<div class="hero">

    <div class="overlay"></div>

    <div class="container">

        <section class="main-card">

            <div class="heading">

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="ILECO III Logo"
                    class="logo-small">

                <h2>AGMA 2026 Online Registration</h2>

                <p>
                    Select the registration category that matches your electric
                    service account.
                </p>

            </div>

            <div class="registration-grid">

                <a href="{{ route('registration.residential') }}" class="registration-card">

                    <h3>Joint / Single Membership</h3>

                    <p>
                        Register as an individual residential consumer using
                        your electric service account information.
                    </p>

                    <span class="btn btn-blue">
                        Continue
                    </span>

                </a>

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