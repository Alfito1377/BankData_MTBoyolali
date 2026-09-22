<nav
    id="navbar"
    class="sticky top-0 z-50 w-full border-b border-slate-200/80
           bg-white/95 shadow-[0_2px_14px_rgba(15,23,42,0.045)]
           backdrop-blur"
>
    @php
        /*
        |--------------------------------------------------------------------------
        | Navigation Menu
        |--------------------------------------------------------------------------
        */
        $navigationMenus = [
            [
                'route' => 'bank-data.index',
                'label' => 'Bank Data',
                'icon'  => 'fa-database',
            ],
            [
                'route' => 'afkir.index',
                'label' => 'MT Afkir & Dispen',
                'icon'  => 'fa-file-signature',
            ],
            [
                'route' => 'kategori.index',
                'label' => 'Kategori MT',
                'icon'  => 'fa-chart-pie',
            ],
            [
                'route' => 'transportir.index',
                'label' => 'List Transportir',
                'icon'  => 'fa-building',
            ],
            [
                'route' => 'users.index',
                'label' => 'Manajemen User',
                'icon'  => 'fa-users',
            ],
        ];
    @endphp

    {{-- =========================================================
         NAVBAR HEADER
    ========================================================== --}}
    <div
        class="flex min-h-[74px] w-full items-center px-6
               xl:px-8 2xl:px-10
               max-lg:min-h-[68px] max-lg:px-5
               max-md:min-h-[64px] max-md:px-4"
    >

        {{-- =====================================================
             BRAND
        ====================================================== --}}
        <a
            href="{{ route('bank-data.index') }}"
            class="group flex shrink-0 items-center no-underline"
        >

            {{-- LOGO --}}
            <div
                class="flex h-11 w-11 shrink-0 items-center justify-center
                       overflow-hidden rounded-xl border border-slate-200
                       bg-slate-50 shadow-sm transition duration-200
                       group-hover:border-slate-300
                       group-hover:bg-slate-100
                       max-md:h-10 max-md:w-10"
            >
                <img
                    src="{{ asset('logo-pertamina.png') }}"
                    alt="Pertamina Patra Logistik"
                    class="h-8 w-8 object-contain max-md:h-7 max-md:w-7"
                >
            </div>

            {{-- BRAND NAME --}}
            <div class="ml-3.5 leading-tight max-md:ml-2.5">
                <div
                    class="whitespace-nowrap text-[14px] font-bold
                           tracking-[-0.1px] text-slate-700"
                >
                    Pertamina Patra Logistik
                </div>

                <div
                    class="mt-0.5 text-[9px] font-medium tracking-wide
                           text-slate-400 max-md:hidden"
                >
                    Monitoring Kendaraan
                </div>
            </div>

        </a>


        {{-- =====================================================
             DESKTOP NAVIGATION
        ====================================================== --}}
        <div
            class="ml-auto flex min-w-0 items-center max-lg:hidden"
        >

            {{-- MENU --}}
            <div
                class="flex items-center rounded-xl border border-slate-100
                       bg-slate-50/70 p-1"
            >

                @foreach ($navigationMenus as $menu)
                    @php
                        $isActive = request()->routeIs($menu['route']);
                    @endphp

                    <a
                        href="{{ route($menu['route']) }}"
                        class="group flex items-center gap-2 rounded-lg
                               px-3 py-2 text-[11px] font-medium
                               no-underline transition-all duration-200
                               {{ $isActive
                                    ? 'bg-white text-[#496b88] shadow-sm ring-1 ring-slate-200/70'
                                    : 'text-slate-500 hover:bg-white/80 hover:text-[#496b88]' }}"
                    >

                        <span
                            class="flex h-6 w-6 items-center justify-center
                                   rounded-md transition
                                   {{ $isActive
                                        ? 'bg-[#eef4f8] text-[#5f7f9b]'
                                        : 'bg-transparent text-slate-400 group-hover:bg-[#eef4f8] group-hover:text-[#5f7f9b]' }}"
                        >
                            <i class="fas {{ $menu['icon'] }} text-[10px]"></i>
                        </span>

                        <span>
                            {{ $menu['label'] }}
                        </span>

                    </a>
                @endforeach

            </div>


            {{-- =================================================
                 PROFILE
            ================================================== --}}
            <div class="ml-4 flex items-center">

                <div
                    class="relative flex items-center rounded-xl
                           border border-slate-100 bg-white px-2 py-1.5
                           shadow-sm transition
                           hover:border-slate-200 hover:shadow-md"
                >

                    {{-- PROFILE TEXT --}}
                    <div
                        class="mr-2.5 text-right leading-tight max-xl:hidden"
                    >
                        <div
                            class="max-w-[120px] truncate text-[11px]
                                   font-semibold text-slate-700"
                        >
                            {{ Auth::user()->name ?? 'Administrator' }}
                        </div>

                        <div
                            class="mt-0.5 text-[8px] font-medium
                                   text-slate-400"
                        >
                            Patra Logistik
                        </div>
                    </div>


                    {{-- AVATAR --}}
                    @if (Auth::check())

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=5f7f9b&color=fff&bold=true"
                            alt="Profile"
                            class="h-9 w-9 rounded-[10px]
                                   border-2 border-white object-cover
                                   shadow-sm ring-1 ring-slate-200"
                        >

                    @else

                        <div
                            class="flex h-9 w-9 items-center justify-center
                                   rounded-[10px] bg-[#5f7f9b]
                                   text-xs text-white shadow-sm"
                        >
                            <i class="fas fa-user"></i>
                        </div>

                    @endif


                    {{-- DROPDOWN BUTTON --}}
                    <button
                        type="button"
                        id="profileDropdownButton"
                        aria-expanded="false"
                        aria-label="Menu profil"
                        class="ml-1.5 flex h-7 w-7 items-center
                               justify-center rounded-lg border-0
                               bg-transparent text-slate-400
                               transition duration-200
                               hover:bg-slate-50
                               hover:text-[#496b88]
                               focus:outline-none"
                    >
                        <i
                            id="profileChevron"
                            class="fas fa-chevron-down text-[8px]
                                   transition-transform duration-200"
                        ></i>
                    </button>


                    {{-- PROFILE DROPDOWN --}}
                    <div
                        id="profileDropdown"
                        class="absolute right-0 top-full mt-3 hidden
                               w-64 overflow-hidden rounded-2xl
                               border border-slate-200 bg-white
                               shadow-[0_15px_45px_rgba(15,23,42,0.12)]"
                    >

                        {{-- USER --}}
                        <div class="p-3">

                            <div
                                class="flex items-center gap-3 rounded-xl
                                       bg-slate-50 p-3"
                            >

                                <div
                                    class="flex h-10 w-10 shrink-0
                                           items-center justify-center
                                           rounded-xl bg-[#eef4f8]
                                           text-[#5f7f9b]"
                                >
                                    <i class="fas fa-user text-sm"></i>
                                </div>

                                <div class="min-w-0">

                                    <div
                                        class="truncate text-xs font-semibold
                                               text-slate-700"
                                    >
                                        {{ Auth::user()->name ?? 'Administrator' }}
                                    </div>

                                    <div
                                        class="mt-1 truncate text-[9px]
                                               text-slate-400"
                                    >
                                        {{ Auth::user()->email ?? '' }}
                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- DIVIDER --}}
                        <div class="border-t border-slate-100"></div>


                        {{-- LOGOUT --}}
                        <div class="p-2">

                            <a
                                href="{{ route('logout') }}"
                                class="group flex items-center gap-3
                                       rounded-xl px-3 py-2.5
                                       text-[11px] font-medium
                                       text-slate-500 no-underline
                                       transition
                                       hover:bg-red-50 hover:text-red-600"
                            >

                                <span
                                    class="flex h-8 w-8 items-center
                                           justify-center rounded-lg
                                           bg-slate-50 text-slate-400
                                           transition
                                           group-hover:bg-white
                                           group-hover:text-red-500"
                                >
                                    <i
                                        class="fas fa-sign-out-alt text-[10px]"
                                    ></i>
                                </span>

                                <span>Logout</span>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             MOBILE TOGGLE
        ====================================================== --}}
        <button
            type="button"
            id="navbarToggle"
            aria-controls="mobileNavbarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
            class="ml-auto hidden h-9 w-9 items-center justify-center
                   rounded-xl border border-slate-200 bg-white
                   text-slate-500 shadow-sm transition
                   hover:bg-slate-50 lg:hidden"
        >
            <i
                id="navbarToggleIcon"
                class="fas fa-bars text-xs"
            ></i>
        </button>

    </div>


    {{-- =========================================================
         MOBILE MENU
    ========================================================== --}}
    <div
        id="mobileNavbarMenu"
        class="hidden border-t border-slate-100
               bg-white px-4 py-3 lg:hidden"
    >

        <div
            class="rounded-xl border border-slate-100
                   bg-slate-50/70 p-1"
        >

            @foreach ($navigationMenus as $menu)
                @php
                    $isActive = request()->routeIs($menu['route']);
                @endphp

                <a
                    href="{{ route($menu['route']) }}"
                    class="group flex items-center gap-3 rounded-lg
                           px-3 py-2.5 text-sm font-medium
                           no-underline transition
                           {{ $isActive
                                ? 'bg-white text-[#496b88] shadow-sm'
                                : 'text-slate-500 hover:bg-white hover:text-[#496b88]' }}"
                >

                    <span
                        class="flex h-7 w-7 items-center justify-center
                               rounded-md transition
                               {{ $isActive
                                    ? 'bg-[#eef4f8] text-[#5f7f9b]'
                                    : 'bg-transparent text-slate-400 group-hover:bg-[#eef4f8] group-hover:text-[#5f7f9b]' }}"
                    >
                        <i class="fas {{ $menu['icon'] }} text-[10px]"></i>
                    </span>

                    <span>
                        {{ $menu['label'] }}
                    </span>

                </a>

            @endforeach

        </div>

    </div>

</nav>


{{-- =============================================================
     NAVBAR JAVASCRIPT
============================================================== --}}
<script>
document.addEventListener('DOMContentLoaded', () => {

    const profileButton = document.getElementById('profileDropdownButton');
    const profileDropdown = document.getElementById('profileDropdown');
    const profileChevron = document.getElementById('profileChevron');

    const navbarToggle = document.getElementById('navbarToggle');
    const mobileMenu = document.getElementById('mobileNavbarMenu');
    const navbarToggleIcon = document.getElementById('navbarToggleIcon');


    /* =========================================================
       PROFILE DROPDOWN
    ========================================================== */

    const closeProfileDropdown = () => {

        if (!profileDropdown || !profileButton) {
            return;
        }

        profileDropdown.classList.add('hidden');

        profileButton.setAttribute('aria-expanded', 'false');

        profileChevron?.classList.remove('rotate-180');
    };


    const toggleProfileDropdown = (event) => {

        event.stopPropagation();

        if (!profileDropdown || !profileButton) {
            return;
        }

        const isOpen = !profileDropdown.classList.contains('hidden');

        profileDropdown.classList.toggle('hidden');

        profileButton.setAttribute(
            'aria-expanded',
            String(!isOpen)
        );

        profileChevron?.classList.toggle(
            'rotate-180',
            !isOpen
        );
    };


    profileButton?.addEventListener(
        'click',
        toggleProfileDropdown
    );


    document.addEventListener('click', (event) => {

        if (
            profileDropdown &&
            profileButton &&
            !profileDropdown.contains(event.target) &&
            !profileButton.contains(event.target)
        ) {
            closeProfileDropdown();
        }

    });


    /* =========================================================
       MOBILE MENU
    ========================================================== */

    navbarToggle?.addEventListener('click', () => {

        if (!mobileMenu || !navbarToggle) {
            return;
        }

        const isOpen = !mobileMenu.classList.contains('hidden');

        mobileMenu.classList.toggle('hidden');

        navbarToggle.setAttribute(
            'aria-expanded',
            String(!isOpen)
        );

        navbarToggleIcon?.classList.toggle(
            'fa-bars',
            isOpen
        );

        navbarToggleIcon?.classList.toggle(
            'fa-times',
            !isOpen
        );

    });

});
</script>