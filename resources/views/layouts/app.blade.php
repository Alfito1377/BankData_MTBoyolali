
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - Patra Logistik</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    {{-- =====================================================
         TAILWIND CSS
    ====================================================== --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- =====================================================
         FONT AWESOME
    ====================================================== --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    {{-- =====================================================
         CUSTOM HEAD STYLE
    ====================================================== --}}
    @stack('styles')

</head>


<body class="min-h-screen bg-slate-50 text-slate-700 antialiased">

    {{-- =====================================================
         NAVBAR
    ====================================================== --}}
    @include('layouts.navbar')


    {{-- =====================================================
         MAIN WRAPPER
    ====================================================== --}}
    <main class="w-full">

        {{-- =================================================
             CONTENT AREA
        ================================================== --}}
        <div
            class="
                w-full
                min-h-[calc(100vh-78px)]
                px-4 py-5
                sm:px-5 sm:py-6
                lg:px-7 lg:py-7
                xl:px-8
            "
        >

            {{-- =================================================
                 SUCCESS ALERT
            ================================================== --}}
            @if(session('success'))

                <div
                    id="success-alert"
                    class="
                        relative mb-5
                        flex items-start gap-3
                        rounded-xl
                        border border-emerald-200
                        bg-emerald-50
                        px-4 py-3.5
                        text-emerald-700
                        shadow-sm
                    "
                    role="alert"
                >

                    <div
                        class="
                            flex h-7 w-7 shrink-0
                            items-center justify-center
                            rounded-lg
                            bg-emerald-100
                            text-emerald-600
                        "
                    >
                        <i class="fas fa-check text-xs"></i>
                    </div>

                    <div class="flex-1 pt-0.5">

                        <p class="text-xs font-semibold">
                            Berhasil
                        </p>

                        <p class="mt-0.5 text-xs text-emerald-600">
                            {{ session('success') }}
                        </p>

                    </div>

                    <button
                        type="button"
                        onclick="this.closest('#success-alert').remove()"
                        class="
                            shrink-0
                            rounded-md
                            p-1
                            text-emerald-500
                            transition
                            hover:bg-emerald-100
                            hover:text-emerald-700
                        "
                        aria-label="Tutup"
                    >
                        <i class="fas fa-xmark text-xs"></i>
                    </button>

                </div>

            @endif


            {{-- =================================================
                 ERROR ALERT
            ================================================== --}}
            @if(session('error'))

                <div
                    id="error-alert"
                    class="
                        relative mb-5
                        flex items-start gap-3
                        rounded-xl
                        border border-red-200
                        bg-red-50
                        px-4 py-3.5
                        text-red-700
                        shadow-sm
                    "
                    role="alert"
                >

                    <div
                        class="
                            flex h-7 w-7 shrink-0
                            items-center justify-center
                            rounded-lg
                            bg-red-100
                            text-red-600
                        "
                    >
                        <i class="fas fa-exclamation text-xs"></i>
                    </div>

                    <div class="flex-1 pt-0.5">

                        <p class="text-xs font-semibold">
                            Terjadi Kesalahan
                        </p>

                        <p class="mt-0.5 text-xs text-red-600">
                            {{ session('error') }}
                        </p>

                    </div>

                    <button
                        type="button"
                        onclick="this.closest('#error-alert').remove()"
                        class="
                            shrink-0
                            rounded-md
                            p-1
                            text-red-500
                            transition
                            hover:bg-red-100
                            hover:text-red-700
                        "
                        aria-label="Tutup"
                    >
                        <i class="fas fa-xmark text-xs"></i>
                    </button>

                </div>

            @endif


            {{-- =================================================
                 VALIDATION ERRORS
            ================================================== --}}
            @if($errors->any())

                <div
                    id="validation-alert"
                    class="
                        relative mb-5
                        rounded-xl
                        border border-red-200
                        bg-red-50
                        px-4 py-3.5
                        text-red-700
                        shadow-sm
                    "
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="
                                flex h-7 w-7 shrink-0
                                items-center justify-center
                                rounded-lg
                                bg-red-100
                                text-red-600
                            "
                        >
                            <i class="fas fa-circle-exclamation text-xs"></i>
                        </div>

                        <div class="flex-1">

                            <p class="text-xs font-semibold">
                                Terdapat kesalahan pada formulir
                            </p>

                            <ul class="mt-1.5 list-disc space-y-0.5 pl-4 text-xs text-red-600">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                        <button
                            type="button"
                            onclick="this.closest('#validation-alert').remove()"
                            class="
                                shrink-0
                                rounded-md
                                p-1
                                text-red-500
                                transition
                                hover:bg-red-100
                                hover:text-red-700
                            "
                            aria-label="Tutup"
                        >
                            <i class="fas fa-xmark text-xs"></i>
                        </button>

                    </div>

                </div>

            @endif


            {{-- =================================================
                 PAGE CONTENT
            ================================================== --}}
            @yield('content')

        </div>

    </main>


    {{-- =====================================================
         GLOBAL SCRIPT
    ====================================================== --}}

    <script>

        /*
        |--------------------------------------------------------------------------
        | AUTO HIDE ALERT
        |--------------------------------------------------------------------------
        */

        document.addEventListener('DOMContentLoaded', function () {

            const alerts = [
                document.getElementById('success-alert'),
                document.getElementById('error-alert'),
            ];

            alerts.forEach(function (alert) {

                if (!alert) return;

                setTimeout(function () {

                    alert.style.transition =
                        'opacity .3s ease, transform .3s ease';

                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-5px)';

                    setTimeout(function () {
                        alert.remove();
                    }, 300);

                }, 5000);

            });

        });

    </script>


    {{-- =====================================================
         PAGE SCRIPT
    ====================================================== --}}
    @stack('scripts')

</body>

</html>

