<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

@extends('layouts.guest')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root{
    --primary:#084880;
    --primary-dark:#06365f;
    --accent:#5CB20D;
    --bg:#f4f7fb;
    --card:#ffffff;
    --border:#e7edf5;
}

body{
    background:var(--bg);
    font-family:Inter,Segoe UI,sans-serif;
}

.hero{
    background:linear-gradient(135deg,var(--primary),#1677ff);
    color:#fff;
    border-radius:22px;
    padding:45px 35px;
    box-shadow:0 15px 40px rgba(8,72,128,.18);
}

.hero h2{
    font-weight:700;
}

.hero p{
    opacity:.9;
    margin-bottom:0;
}

.registration-card{
    margin-top:-45px;
    border:none;
    border-radius:22px;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
    overflow:hidden;
}

.section-title{
    font-weight:700;
    color:var(--primary);
    font-size:15px;
    text-transform:uppercase;
    letter-spacing:1px;
    margin-bottom:25px;
}

.form-label{
    font-weight:600;
    color:#444;
}

.form-control,
.form-select{
    height:54px;
    border-radius:14px;
    border:1px solid var(--border);
    font-size:15px;
}

.form-control:focus,
.form-select:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 .15rem rgba(8,72,128,.15);
}

textarea.form-control{
    height:auto;
    min-height:120px;
}

.upload-box{
    border:2px dashed #cfd8e3;
    border-radius:18px;
    padding:35px;
    text-align:center;
    background:#fafcff;
    transition:.25s;
}

.upload-box:hover{
    border-color:var(--primary);
    background:#f5faff;
}

.upload-icon{
    font-size:42px;
    color:var(--primary);
}

.btn-register{
    height:58px;
    border-radius:15px;
    background:var(--primary);
    border:none;
    font-size:17px;
    font-weight:600;
}

.btn-register:hover{
    background:var(--primary-dark);
}

.required{
    color:#dc3545;
}

@media(max-width:768px){

    .hero{
        border-radius:0 0 24px 24px;
        padding:35px 20px;
    }

    .registration-card{
        margin-top:-25px;
        border-radius:22px 22px 0 0;
    }

    .sticky-footer{
        position:sticky;
        bottom:0;
        background:#fff;
        padding:15px;
        border-top:1px solid #eee;
        z-index:100;
    }
}
</style>

<div class="container py-4">

    <div class="hero text-center">

        <img src="{{ asset('logo.png') }}" width="75" class="mb-3">

        <h2>AGMA 2026</h2>

        <p>
            Annual General Membership Assembly Online Registration
        </p>

    </div>

    <div class="card registration-card">

        <div class="card-body p-4 p-lg-5">

            <form>

                <div class="section-title">
                    <i class="bi bi-person-fill me-2"></i>
                    Personal Information
                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">First Name <span class="required">*</span></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Middle Name</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Last Name <span class="required">*</span></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mobile Number <span class="required">*</span></label>
                        <input type="tel" class="form-control">
                    </div>

                </div>

                <hr class="my-4">

                <div class="section-title">
                    <i class="bi bi-card-checklist me-2"></i>
                    Membership Information
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Membership Type</label>

                        <select class="form-select">
                            <option selected disabled>Select Membership Type</option>
                            <option>Regular</option>
                            <option>Associate</option>
                            <option>Lifetime</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Town / Chapter</label>

                        <select class="form-select">
                            <option selected disabled>Select Town</option>
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Complete Address</label>

                        <textarea class="form-control"></textarea>
                    </div>

                </div>

                <hr class="my-4">

                <div class="section-title">
                    <i class="bi bi-camera-fill me-2"></i>
                    Profile Photo
                </div>

                <div class="upload-box">

                    <div class="upload-icon mb-3">
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                    </div>

                    <h5>Upload Profile Photo</h5>

                    <p class="text-muted mb-3">
                        JPG, PNG (Maximum 5MB)
                    </p>

                    <input type="file" class="form-control">

                </div>

                <div class="sticky-footer mt-4">

                    <button class="btn btn-register text-white w-100">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Complete Registration

                    </button>

                </div>

            </form>

        </div>
s
    </div>

</div>

@endsection