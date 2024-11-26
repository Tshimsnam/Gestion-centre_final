<div class="fixed w-full z-30 flex bg-gray-900 dark:bg-[#0F172A] p-2 items-center justify-center h-16 px-10">
    <div
        class="flex items-center justify-center flex-none h-full ml-12 duration-500 ease-in-out transform logo dark:text-white">
        <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
            <img src="{{ asset('img/orange.webp') }}" class="h-8 me-3" alt="FlowBite Logo" />
            <span class="self-center font-semibold text-white text-1xl sm:text-1xl whitespace-nowrap">Orange
                Digital Center</span>
        </a>
    </div>
    <!-- SPACER -->
    <div class="flex items-center justify-center h-full grow"></div>
    <div class="flex items-center justify-center flex-none h-full text-center">

        <div class="flex items-center px-3 space-x-3 " data-dropdown-toggle="dropdown-user">
            <div>
                <button type="button"
                    class="flex text-sm bg-white rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="{{ asset('img/profil.jpeg') }}" alt="user photo">

                </button>
            </div>


            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="dropdown-user">
                <div class="px-4 py-3" role="none">
                    <p class="text-sm text-gray-900 dark:text-white" role="none">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                        {{ Auth::user()->email }}
                    </p>
                </div>
                <ul class="py-1" role="none">
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Profil</a>
                    </li>

                    <li>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Deconnexion') }}
                            </x-dropdown-link>
                        </form>


                    </li>
                </ul>
            </div>
            @if (Auth()->user()->hasRole('superadmin'))
                <div class="hidden text-sm text-white cursor-pointer md:block md:text-md" aria-expanded="false">
                    <a href="{{ route('setting') }}">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M17 10v1.126c.367.095.714.24 1.032.428l.796-.797 1.415 1.415-.797.796c.188.318.333.665.428 1.032H21v2h-1.126c-.095.367-.24.714-.428 1.032l.797.796-1.415 1.415-.796-.797a3.979 3.979 0 0 1-1.032.428V20h-2v-1.126a3.977 3.977 0 0 1-1.032-.428l-.796.797-1.415-1.415.797-.796A3.975 3.975 0 0 1 12.126 16H11v-2h1.126c.095-.367.24-.714.428-1.032l-.797-.796 1.415-1.415.796.797A3.977 3.977 0 0 1 15 11.126V10h2Zm.406 3.578.016.016c.354.358.574.85.578 1.392v.028a2 2 0 0 1-3.409 1.406l-.01-.012a2 2 0 0 1 2.826-2.83ZM5 8a4 4 0 1 1 7.938.703 7.029 7.029 0 0 0-3.235 3.235A4 4 0 0 1 5 8Zm4.29 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h6.101A6.979 6.979 0 0 1 9 15c0-.695.101-1.366.29-2Z"
                                clip-rule="evenodd" />
                        </svg>

                    </a>


                </div>
            @endif
        </div>



    </div>
</div>


<aside
    class="w-60 -translate-x-48 fixed transition transform ease-in-out duration-1000 z-40 flex h-screen dark:bg-[#1E293B] bg-gray-900">
    <!-- open sidebar button -->
    <div
        class="max-toolbar translate-x-24 scale-x-0 w-full -right-6 transition transform ease-in duration-300 flex items-center justify-between border-4 border-white dark:border-[#0F172A] bg-[#eaeaebf3] dark:bg-[#1E293B]  absolute top-2 rounded-full h-12">

        <div class="flex items-center pl-4 space-x-2 ">
            <div>
                <div onclick="setDark('dark')"
                    class="moon text-gray-700 dark:text-white hover:text-blue-500 dark:hover:text-[#38BDF8]">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3}
                        stroke="currentColor" class="w-4 h-4">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
                </div>
                <div onclick="setDark('light')"
                    class="sun hidden text-gray-700 dark:text-white hover:text-[#ff7900] dark:hover:text-[#ff7900]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-gray-700 dark:text-white hover:text-[#ff7900] dark:hover:text-[#ff7900]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3}
                    stroke="currentColor" class="w-4 h-4">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
            </div>
        </div>

    </div>
    <div onclick="openNav()"
        class="-right-6 transition transform ease-in-out duration-500 flex border-4 border-white dark:border-[#0F172A] dark:bg-[#1E293B]  bg-[#ff7900]  dark:text-white dark:hover:bg-[#0F172A] hover:bg-[#0F172A] absolute top-2 p-3 rounded-full text-white hover:rotate-45">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3} stroke="currentColor"
            class="w-4 h-4">
            <path strokeLinecap="round" strokeLinejoin="round"
                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
        </svg>
    </div>

    <!-- MAX SIDEBAR-->
    <div class="max hidden text-white mt-20 flex-col space-y-2 w-full h-[calc(100vh)]">
        <div
            class="hover:ml-4 w-full text-white  hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">

            <a href="{{ route('dashboard') }}"
                class="hover:ml-4 justify-end pr-5  hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('dashboard') ? ' text-[#FF7900] ' : 'text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                </svg>
                <span>Dashboard</span>
            </a>
        </div>
        <div
            class="hover:ml-4 w-full   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
            <a href="{{ route('activites.index') }}"
                class="hover:ml-4 justify-end pr-5   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('activites.index') ? ' text-[#FF7900] ' : 'text-white' }}">
                <svg aria-hidden="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z" />
                </svg>
                <span>Activites</span>
            </a>
        </div>
        <div
            class="hover:ml-4 w-full hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
            <a href="{{ route('odcusers.index') }}"
                class="hover:ml-4 justify-end pr-5   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('odcusers.index') ? ' text-[#FF7900] ' : 'text-white' }}">
                <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                        clip-rule="evenodd" />
                </svg>
                <span>Odc User</span>
            </a>
        </div>

        <div
            class="hover:ml-4 w-full   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
            <a href="{{ route('employabilites.index') }}"
                class="hover:ml-4 justify-end pr-5   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('employabilites.index') ? ' text-[#FF7900] ' : 'text-white' }}">
                <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9h2V7h-2zm1 14q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23m-.5-2h1v-2.5H21v-1h-2.5V15h-1v2.5H15v1h2.5zm5.5-7.875q-.975-1.05-2.275-1.588T18 11q-.275 0-.513.013t-.487.062V10l-7-5.05V3h13zM1 21V11l7-5l7 5v.675q-1.8.85-2.9 2.588T11 18q0 .775.163 1.538T11.675 21H10v-6H6v6z" />
                </svg>
                <span>Employabilités</span>
            </a>
        </div>


        @if (Auth()->user()->hasRole('superadmin'))
            <div
                class="hover:ml-4 w-full hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <a href="{{ route('type_Contrats.index') }}"
                    class="hover:ml-4 justify-end pr-5  hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('type_Contrats.index') ? ' text-[#FF7900] ' : 'text-white' }}">
                    <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10,2H14A2,2 0 0,1 16,4V6H20A2,2 0 0,1 22,8V19A2,2 0 0,1 20,21H4C2.89,21 2,20.1 2,19V8C2,6.89 2.89,6 4,6H8V4C8,2.89 8.89,2 10,2M14,6V4H10V6H14Z" />
                    </svg>
                    <span>Type Contract</span>
                </a>
            </div>
        @endif

        <div
            class="hover:ml-4 w-full   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
            <a href="{{ route('evaluations.index') }}"
                class="hover:ml-4 justify-end pr-5   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('evaluations.index') ? ' text-[#FF7900] ' : 'text-white' }}">
                <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8,12H16V14H8V12M10,20H6V4H13V9H18V12.1L20,10.1V8L14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H10V20M8,18H12.1L13,17.1V16H8V18M20.2,13C20.3,13 20.5,13.1
                 20.6,13.2L21.9,14.5C22.1,14.7 22.1,15.1 21.9,15.3L20.9,16.3L18.8,14.2L19.8,13.2C19.9,13.1 20,13 20.2,13M20.2,16.9L14.1,23H12V20.9L18.1,14.8L20.2,16.9Z" />
                </svg>

                <span>Evaluations</span>
            </a>
        </div>

        <div
            class="hover:ml-4 w-full  hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
            <a href="{{ route('notifications.index') }}"
                class="hover:ml-4 justify-end pr-5 hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('evaluations.index') ? ' text-[#FF7900] ' : 'text-white' }}">
                <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5C7.9 5 7 5.9 7 7V21L11 17H20C21.1 17 22 16.1 22 15V7C22 5.9 21.1 5 20 5H9M3 7C2.4 7 2 7.4 2 8S2.4 9 3 9H5V7H3M11 8H19V10H11V8M2 11C1.4 11 1 11.4
                                 1 12S1.4 13 2 13H5V11H2M11 12H16V14H11V12M1 15C.4 15 0 15.4 0 16C0 16.6 .4 17 1 17H5V15H1Z" />
                </svg>

                <span>Notifications</span>
            </a>
        </div>
        <div
            class="hover:ml-4 w-full text-white  hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
            <a href="{{ route('coursera.rapports') }}"
                class="hover:ml-4 justify-end pr-5 text-white  hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 5h9M5 9h5m8-8H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4l3.5 4 3.5-4h5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                </svg>

                <span>Coursera</span>
            </a>
        </div>




    </div>
    <!-- MINI SIDEBAR-->
    <div class="mini mt-20 flex flex-col space-y-2 w-full h-[calc(100vh)]">
        <a href="{{ route('dashboard') }}"
            class="hover:ml-4 justify-end pr-5   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('dashboard') ? ' text-[#FF7900] ' : 'text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
            </svg>
        </a>
        <a href="{{ route('activites.index') }}"
            class="hover:ml-4 justify-end pr-5  hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('activites.index') ? ' text-[#FF7900] ' : 'text-white' }}">
            <svg aria-hidden="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z" />
            </svg>
        </a>
        <a href="{{ route('odcusers.index') }}"
            class="hover:ml-4 justify-end pr-5   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('odcusers.index') ? ' text-[#FF7900] ' : 'text-white' }}">
            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                    clip-rule="evenodd" />
            </svg>
        </a>

        <a href="{{ route('employabilites.index') }}"
            class="hover:ml-4 justify-end pr-5  hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('employabilites.index') ? ' text-[#FF7900] ' : 'text-white' }}">
            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 9h2V7h-2zm1 14q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23m-.5-2h1v-2.5H21v-1h-2.5V15h-1v2.5H15v1h2.5zm5.5-7.875q-.975-1.05-2.275-1.588T18 11q-.275 0-.513.013t-.487.062V10l-7-5.05V3h13zM1 21V11l7-5l7 5v.675q-1.8.85-2.9 2.588T11 18q0 .775.163 1.538T11.675 21H10v-6H6v6z" />



                {{-- d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13
                16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /> --}}
            </svg>
        </a>

        <a href="{{ route('evaluations.index') }}"
            class="hover:ml-4 justify-end pr-5   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('evaluations.index') ? ' text-[#FF7900] ' : 'text-white' }}">
            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8,12H16V14H8V12M10,20H6V4H13V9H18V12.1L20,10.1V8L14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H10V20M8,18H12.1L13,17.1V16H8V18M20.2,13C20.3,13 20.5,13.1
                 20.6,13.2L21.9,14.5C22.1,14.7 22.1,15.1 21.9,15.3L20.9,16.3L18.8,14.2L19.8,13.2C19.9,13.1 20,13 20.2,13M20.2,16.9L14.1,23H12V20.9L18.1,14.8L20.2,16.9Z" />
            </svg>
        </a>

        <a href="{{ route('notifications.index') }}"
            class="hover:ml-4 justify-end pr-5   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('notifications.index') ? ' text-[#FF7900] ' : 'text-white' }}">
            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5C7.9 5 7 5.9 7 7V21L11 17H20C21.1 17 22 16.1 22 15V7C22 5.9 21.1 5 20 5H9M3 7C2.4 7 2 7.4 2 8S2.4 9 3 9H5V7H3M11 8H19V10H11V8M2 11C1.4 11 1 11.4
                                 1 12S1.4 13 2 13H5V11H2M11 12H16V14H11V12M1 15C.4 15 0 15.4 0 16C0 16.6 .4 17 1 17H5V15H1Z" />
            </svg>
        </a>

        <a href="{{ route('coursera.rapports') }}"
            class="hover:ml-4 justify-end pr-5   hover:text-[#FF7900] dark:hover:text-[#FF7900]  p-3 rounded-full transform ease-in-out duration-300 flex {{ request()->routeIs('coursera.rapports') ? ' text-[#FF7900] ' : 'text-white' }}">
            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 5h9M5 9h5m8-8H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4l3.5 4 3.5-4h5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
            </svg>
        </a>

    </div>

</aside>
