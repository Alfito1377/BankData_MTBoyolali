<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="utf-8">

<meta
    http-equiv="X-UA-Compatible"
    content="IE=edge"
>

<meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no"
>

<title>Login - Patra Logistik</title>


<!-- =====================================================
     FONT
====================================================== -->

<link
    rel="preconnect"
    href="https://fonts.googleapis.com"
>

<link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin
>

<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>


<!-- =====================================================
     FONT AWESOME
====================================================== -->

<script
    src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
    crossorigin="anonymous">
</script>


<style>

    /* =====================================================
       COLOR SYSTEM
    ====================================================== */

    :root {

        --blue-main: #5f7f9b;

        --blue-dark: #496b88;

        --blue-light: #eef4f8;

        --blue-hover: #e5eef5;

        --text-main: #263746;

        --text-secondary: #687783;

        --text-muted: #929da5;

        --border: #e1e7eb;

        --border-light: #edf1f4;

        --background: #f5f7f9;

        --white: #ffffff;

        --danger: #a95b61;

        --danger-bg: #faf0f1;

    }


    /* =====================================================
       GLOBAL
    ====================================================== */

    * {
        box-sizing: border-box;
    }


    html,
    body {
        margin: 0;

        padding: 0;

        width: 100%;

        min-height: 100%;

        font-family: 'Inter', sans-serif;
    }


    body {

        background: var(--background);

        color: var(--text-main);

        overflow-x: hidden;
    }


    /* =====================================================
       LOGIN WRAPPER
    ====================================================== */

    .login-wrapper {

        min-height: 100vh;

        display: flex;
    }


    /* =====================================================
       LEFT SIDE
    ====================================================== */

    .login-left {

        width: 52%;

        min-height: 100vh;

        position: relative;

        overflow: hidden;

        background: #edf3f7;

        display: flex;

        align-items: center;

        padding: 65px 70px;

        color: var(--text-main);
    }


    /*
     * Dekorasi sederhana.
     * Tidak terlalu banyak supaya terlihat natural.
     */

    .login-left::before {

        content: "";

        position: absolute;

        width: 430px;

        height: 430px;

        border: 70px solid rgba(95,127,155,.055);

        border-radius: 50%;

        right: -220px;

        top: -170px;
    }


    .login-left::after {

        content: "";

        position: absolute;

        width: 280px;

        height: 280px;

        border: 50px solid rgba(95,127,155,.045);

        border-radius: 50%;

        left: -160px;

        bottom: -140px;
    }


    .left-content {

        position: relative;

        z-index: 2;

        width: 100%;

        max-width: 560px;
    }


    /* =====================================================
       BRAND
    ====================================================== */

    .brand {

        display: flex;

        align-items: center;

        gap: 13px;

        margin-bottom: 62px;
    }


    .brand-icon {

        width: 48px;

        height: 48px;

        border-radius: 9px;

        background: var(--blue-main);

        color: #fff;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 19px;

        box-shadow:
            0 5px 15px rgba(73,107,136,.16);
    }


    .brand-name {

        font-size: 19px;

        font-weight: 700;

        color: var(--text-main);

        letter-spacing: .1px;
    }


    .brand-subtitle {

        font-size: 10px;

        color: var(--text-secondary);

        margin-top: 3px;
    }


    /* =====================================================
       INTRODUCTION
    ====================================================== */

    .welcome-label {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        color: var(--blue-dark);

        font-size: 11px;

        font-weight: 600;

        margin-bottom: 16px;

        text-transform: uppercase;

        letter-spacing: .7px;
    }


    .welcome-label::before {

        content: "";

        width: 24px;

        height: 2px;

        background: var(--blue-main);

        border-radius: 2px;
    }


    .welcome-title {

        font-size: 38px;

        line-height: 1.25;

        font-weight: 700;

        color: var(--text-main);

        margin: 0 0 18px;
    }


    .welcome-text {

        font-size: 14px;

        line-height: 1.8;

        color: var(--text-secondary);

        max-width: 490px;

        margin: 0 0 35px;
    }


    /* =====================================================
       FEATURE LIST
    ====================================================== */

    .feature-list {

        display: flex;

        flex-direction: column;

        gap: 12px;
    }


    .feature-item {

        display: flex;

        align-items: center;

        gap: 12px;

        color: #52616c;

        font-size: 12px;
    }


    .feature-icon {

        width: 32px;

        height: 32px;

        flex-shrink: 0;

        border-radius: 7px;

        background: rgba(95,127,155,.09);

        color: var(--blue-main);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 11px;
    }


    /* =====================================================
       RIGHT SIDE
    ====================================================== */

    .login-right {

        width: 48%;

        min-height: 100vh;

        background: var(--white);

        display: flex;

        align-items: center;

        justify-content: center;

        padding: 40px 55px;
    }


    .login-box {

        width: 100%;

        max-width: 390px;
    }


    /* =====================================================
       LOGIN HEADER
    ====================================================== */

    .login-heading {

        margin-bottom: 29px;
    }


    .login-heading h2 {

        font-size: 27px;

        font-weight: 700;

        color: var(--text-main);

        margin: 0 0 8px;
    }


    .login-heading p {

        font-size: 12px;

        color: var(--text-muted);

        margin: 0;

        line-height: 1.6;
    }


    /* =====================================================
       FORM
    ====================================================== */

    .form-group {

        margin-bottom: 18px;
    }


    .form-label {

        display: block;

        font-size: 11px;

        font-weight: 600;

        color: #52616c;

        margin-bottom: 7px;
    }


    .input-wrapper {

        position: relative;

        width: 100%;
    }


    .input-wrapper > i {

        position: absolute;

        left: 14px;

        top: 50%;

        transform: translateY(-50%);

        color: #9aa6ae;

        font-size: 12px;

        z-index: 2;

        pointer-events: none;
    }


    .form-control-custom {

        width: 100%;

        height: 46px;

        padding:
            0 43px;

        border:
            1px solid var(--border);

        border-radius: 7px;

        background: #fff;

        color: var(--text-main);

        font-family: 'Inter', sans-serif;

        font-size: 12px;

        outline: none;

        transition:
            border-color .18s ease,
            box-shadow .18s ease,
            background .18s ease;
    }


    .form-control-custom:hover {

        border-color: #ccd6dd;
    }


    .form-control-custom:focus {

        border-color: var(--blue-main);

        background: #fff;

        box-shadow:
            0 0 0 3px rgba(95,127,155,.09);
    }


    .form-control-custom::placeholder {

        color: #a5afb6;
    }


    /* =====================================================
       PASSWORD TOGGLE
    ====================================================== */

    .password-toggle {

        position: absolute;

        right: 13px;

        top: 50%;

        transform: translateY(-50%);

        width: 25px;

        height: 25px;

        padding: 0;

        border: none;

        background: transparent;

        color: #9aa6ae;

        cursor: pointer;

        display: flex;

        align-items: center;

        justify-content: center;

        transition: color .18s ease;
    }


    .password-toggle:hover {

        color: var(--blue-main);
    }


    /* =====================================================
       LOGIN BUTTON
    ====================================================== */

    .login-button {

        width: 100%;

        height: 46px;

        margin-top: 7px;

        border: none;

        border-radius: 7px;

        background: var(--blue-main);

        color: #fff;

        font-family: 'Inter', sans-serif;

        font-size: 12px;

        font-weight: 600;

        cursor: pointer;

        transition:
            background .18s ease,
            box-shadow .18s ease,
            transform .18s ease;
    }


    .login-button:hover {

        background: var(--blue-dark);

        box-shadow:
            0 5px 15px rgba(73,107,136,.18);

        transform: translateY(-1px);
    }


    .login-button:active {

        transform: translateY(0);
    }


    /* =====================================================
       ERROR
    ====================================================== */

    .alert-custom {

        display: flex;

        align-items: flex-start;

        border: 1px solid #f0dfe1;

        border-radius: 7px;

        background: var(--danger-bg);

        color: var(--danger);

        font-size: 11px;

        line-height: 1.5;

        padding: 10px 12px;

        margin-bottom: 18px;
    }


    /* =====================================================
       FOOTER
    ====================================================== */

    .login-footer {

        text-align: center;

        margin-top: 28px;

        padding-top: 18px;

        border-top:
            1px solid var(--border-light);
    }


    .login-footer p {

        font-size: 10px;

        color: var(--text-muted);

        margin: 0;

        line-height: 1.5;
    }


    .login-footer p:last-child {

        margin-top: 3px;
    }


    /* =====================================================
       SYSTEM INFO
    ====================================================== */

    .system-info {

        display: flex;

        align-items: center;

        gap: 7px;

        margin-bottom: 22px;

        color: var(--text-muted);

        font-size: 10px;
    }


    .status-dot {

        width: 6px;

        height: 6px;

        border-radius: 50%;

        background: var(--blue-main);
    }


    /* =====================================================
       RESPONSIVE
    ====================================================== */

    @media (max-width: 1100px) {

        .login-left {

            padding:
                50px;
        }

        .login-right {

            padding:
                35px;
        }

        .welcome-title {

            font-size: 34px;
        }
    }


    @media (max-width: 991px) {

        .login-left {

            display: none;
        }


        .login-right {

            width: 100%;

            min-height: 100vh;

            padding: 25px;

            background: var(--background);
        }


        .login-box {

            max-width: 400px;

            background: #fff;

            padding: 32px;

            border:
                1px solid var(--border);

            border-radius: 10px;

            box-shadow:
                0 8px 25px rgba(40,55,70,.055);
        }
    }


    @media (max-width: 480px) {

        .login-right {

            padding: 15px;
        }


        .login-box {

            padding:
                27px 22px;
        }


        .login-heading h2 {

            font-size: 24px;
        }


        .form-control-custom,
        .login-button {

            height: 45px;
        }
    }

</style>

</head>

<body>

<div class="login-wrapper">

<!-- =====================================================
     LEFT PANEL
====================================================== -->

<div class="login-left">

    <div class="left-content">


        <!-- BRAND -->

        <div class="brand">

            <div class="brand-icon">

                <i class="fas fa-truck"></i>

            </div>


            <div>

                <div class="brand-name">
                    Patra Logistik
                </div>

                <div class="brand-subtitle">
                    Fleet Management System
                </div>

            </div>

        </div>


        <!-- INTRO -->

        <div class="welcome-label">
            Fleet Management
        </div>


        <h1 class="welcome-title">

            Kelola Armada
            <br>
            Lebih Teratur.

        </h1>


        <p class="welcome-text">

            Sistem pengelolaan armada yang membantu
            proses pencatatan, monitoring, dan pengelolaan
            status kendaraan secara lebih terstruktur.

        </p>


        <!-- FEATURES -->

        <div class="feature-list">


            <div class="feature-item">

                <div class="feature-icon">
                    <i class="fas fa-database"></i>
                </div>

                <span>
                    Pengelolaan data armada
                </span>

            </div>


            <div class="feature-item">

                <div class="feature-icon">
                    <i class="fas fa-truck"></i>
                </div>

                <span>
                    Monitoring kendaraan
                </span>

            </div>


            <div class="feature-item">

                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>

                <span>
                    Informasi armada terintegrasi
                </span>

            </div>


        </div>


    </div>

</div>


<!-- =====================================================
     RIGHT PANEL
====================================================== -->

<div class="login-right">

    <div class="login-box">


        <!-- SYSTEM STATUS -->

        <div class="system-info">

            <span class="status-dot"></span>

            Sistem siap digunakan

        </div>


        <!-- LOGIN HEADING -->

        <div class="login-heading">

            <h2>
                Selamat Datang
            </h2>

            <p>
                Silakan masuk menggunakan akun Anda
                untuk mengakses sistem.
            </p>

        </div>


        <!-- ERROR -->

        @if($errors->any())

            <div class="alert-custom">

                <i
                    class="fas fa-circle-exclamation me-2"
                    style="margin-top: 2px;">
                </i>

                <span>
                    {{ $errors->first() }}
                </span>

            </div>

        @endif


        <!-- LOGIN FORM -->

        <form
            method="POST"
            action="{{ route('login.authenticate') }}"
        >

            @csrf


            <!-- EMAIL -->

            <div class="form-group">

                <label
                    for="inputEmail"
                    class="form-label"
                >
                    Email
                </label>


                <div class="input-wrapper">

                    <i class="fas fa-envelope"></i>


                    <input
                        class="form-control-custom"
                        id="inputEmail"
                        type="email"
                        name="email"
                        placeholder="Masukkan email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                        autofocus
                    >

                </div>

            </div>


            <!-- PASSWORD -->

            <div class="form-group">

                <label
                    for="inputPassword"
                    class="form-label"
                >
                    Password
                </label>


                <div class="input-wrapper">

                    <i class="fas fa-lock"></i>


                    <input
                        class="form-control-custom"
                        id="inputPassword"
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >


                    <button
                        type="button"
                        class="password-toggle"
                        onclick="togglePassword()"
                        aria-label="Tampilkan password"
                    >

                        <i
                            class="fas fa-eye"
                            id="passwordIcon">
                        </i>

                    </button>

                </div>

            </div>


            <!-- BUTTON -->

            <button
                type="submit"
                class="login-button"
            >

                <i class="fas fa-right-to-bracket me-2"></i>

                Masuk ke Sistem

            </button>


        </form>


        <!-- FOOTER -->

        <div class="login-footer">

            <p>
                Patra Logistik &copy; {{ date('Y') }}
            </p>

            <p>
                Fleet Management System
            </p>

        </div>


    </div>

</div>


</div>

<!-- =====================================================
     PASSWORD SCRIPT
====================================================== -->

<script>

    function togglePassword() {

        const passwordInput =
            document.getElementById('inputPassword');

        const passwordIcon =
            document.getElementById('passwordIcon');


        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';

            passwordIcon.classList.remove('fa-eye');

            passwordIcon.classList.add('fa-eye-slash');

        } else {

            passwordInput.type = 'password';

            passwordIcon.classList.remove('fa-eye-slash');

            passwordIcon.classList.add('fa-eye');

        }

    }

</script>

</body>

</html>
