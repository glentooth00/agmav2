<style>
    .page{
    min-height:100vh;
    background:url("../images/bg.jpg") center/cover fixed;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:40px 20px;
}

.page::before{
    content:"";
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.55);
}

.registration-card{
    position:relative;
    z-index:1;
    width:100%;
    max-width:1100px;
    background:#fff;
    border-radius:24px;
    padding:45px;
    box-shadow:0 25px 60px rgba(0,0,0,.25);
}

.page-header{
    text-align:center;
    margin-bottom:35px;
}

.logo{
    width:90px;
    margin-bottom:15px;
}

.page-header h1{
    color:#084880;
    margin-bottom:10px;
}

.page-header p{
    color:#666;
}

.back-btn{
    float:left;
    text-decoration:none;
    color:#084880;
    font-weight:600;
}

.search-card,
.results-card,
.help-card{
    background:#fafafa;
    border:1px solid #e5e7eb;
    border-radius:18px;
    padding:30px;
    margin-top:25px;
}

.subtitle{
    color:#777;
    margin-bottom:25px;
}

.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

.form-group span{
    color:red;
}

.form-group input,
.form-group select{
    width:100%;
    padding:14px;
    border:1px solid #ccc;
    border-radius:10px;
    font-size:15px;
}

.form-group input:focus,
.form-group select:focus{
    outline:none;
    border-color:#084880;
    box-shadow:0 0 0 3px rgba(8,72,128,.15);
}

.search-btn{
    width:100%;
    margin-top:30px;
    border:none;
    border-radius:12px;
    padding:16px;
    background:#084880;
    color:#fff;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
}

.search-btn:hover{
    background:#063763;
}

.empty-state{
    text-align:center;
    padding:50px 20px;
}

.empty-icon{
    width:100px;
    opacity:.6;
    margin-bottom:20px;
}

.help-card ul{
    margin-top:15px;
    padding-left:20px;
}

.help-card li{
    margin-bottom:10px;
    line-height:1.6;
}

@media(max-width:768px){

    .registration-card{
        padding:25px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .back-btn{
        float:none;
        display:inline-block;
        margin-bottom:20px;
    }

}
</style>

@extends('layouts.guest')

@section('content')

<div class="page">

    <div class="registration-card">

        <!-- Header -->
        <div class="page-header">
{{-- {{ route('registration') }} --}}
            <a href="" class="back-btn">
                ← Back
            </a>

            <img src="{{ asset('images/logo.png') }}" class="logo">

            <h1>Residential Registration</h1>

            <p>
                Search your membership record by entering your registered name.
            </p>

        </div>

        <!-- Search Form -->
        <div class="search-card">

            <h2>Find Your Membership</h2>

            <p class="subtitle">
                Please enter your complete registered name.
            </p>

            <form action="{{ route('residential.search') }}" method="POST">

                @csrf

                <div class="form-grid">

                    <div class="form-group">

                        <label>Family Name <span>*</span></label>

                        <input
                            type="text"
                            name="family_name"
                            placeholder="e.g. Dela Cruz"
                            required>

                    </div>

                    <div class="form-group">

                        <label>Given Name <span>*</span></label>

                        <input
                            type="text"
                            name="given_name"
                            placeholder="e.g. Juan"
                            required>

                    </div>

                    <div class="form-group">

                        <label>Middle Name <span>*</span></label>

                        <input
                            type="text"
                            name="middle_name"
                            placeholder="e.g. Santos"
                            required>

                    </div>

                    <div class="form-group">

                        <label>Suffix</label>

                        <select name="suffix">

                            <option value="">None</option>
                            <option>Jr.</option>
                            <option>Sr.</option>
                            <option>II</option>
                            <option>III</option>
                            <option>IV</option>

                        </select>

                    </div>

                </div>

                <button class="search-btn">

                    🔍 Search Membership

                </button>

            </form>

        </div>

        <!-- Results -->

        <div class="results-card">

            <h2>Search Results</h2>

            <div class="empty-state">

                <img src="{{ asset('images/search.png') }}" class="empty-icon">

                <h3>No Search Yet</h3>

                <p>
                    Enter your registered name above to search your
                    membership information.
                </p>

            </div>

        </div>

        <!-- Help -->

        <div class="help-card">

            <h3>Need Assistance?</h3>

            <ul>

                <li>Use the exact name registered with ILECO III.</li>

                <li>If your record cannot be found, visit the nearest Area Office.</li>

                <li>Bring your latest electric bill and a valid government ID.</li>

            </ul>

        </div>

    </div>

</div>

@endsection