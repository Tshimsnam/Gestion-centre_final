<x-app-layout>
    <div class=" mt-4">
        <h1
            class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-700 md:text-5xl lg:text-6xl dark:text-white">
            Tableau de Bord
        </h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl  dark:text-gray-400">
            Supervision Complète : Activités, Apprenants, Employabilité et Présence</p>
    </div>

    <section class=" grid grid-cols-1 md:grid-cols-4 gap-4 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full mb-8">
        <a href="{{ route('activites.index') }}"
            class="h-36 items-center  p-2 w-full rounded-lg shadow-lg dark:shadow-lg dark:shadow-gray-500/20 backdrop-blur-xl bg-cover bg-[#fcdab40a] dark:bg-[#1e293b62] dark:hover:bg-gray-700  hover:bg-[#f8f0e7] hover:scale-105 transition duration-700 ease-in-out border-l-8 border-[#ff9822] hover:border-l-10 ">
            <div class=" ">
                <div class="flex gap-4 items-center mb-4">
                    <svg class="w-16 h-16 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z" />
                        <path
                            d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z" />
                    </svg>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 ">
                        Total des activités enregistrées
                    </h3>

                </div>
                <div>

                    <p class="text-4xl font-bold text-[#ff9822] dark:text-gray-400">
                        {{ $activites->count() }}</p>
                </div>
            </div>
        </a>
        <div onclick="openModal()"
            class="  p-2 h-36 w-full items-center  rounded-lg shadow-lg  dark:shadow-gray-500/20 backdrop-blur-xl bg-[#fcdab40a] dark:bg-[#1e293b62] dark:hover:bg-gray-700  hover:scale-105 transition duration-700 ease-in-out hover:bg-[#f8f0e7] hover:text-black border-l-8 border-[#ff9822] hover:border-l-10 ">

            <div class="flex gap-4 items-center mb-4">
                <svg class="w-16 h-16 text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                        clip-rule="evenodd" />
                </svg>

                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Activités de la semaine (Lundi - Samedi)
                </h3>

            </div>
            <div>

                <p class="text-4xl font-bold text-[#ff9822] dark:text-gray-400">
                    {{ $activityForWeekend->count() }}
                </p>
            </div>

        </div>
        <div
            class="  p-2 h-36 w-full items-center  rounded-lg shadow-lg  dark:shadow-gray-500/20 backdrop-blur-xl bg-[#fcdab40a] dark:bg-gray-800 dark:bg-[#1e293b62] hover:scale-105 transition duration-700 ease-in-out hover:bg-[#f8f0e7] hover:text-black border-l-8 border-[#ff9822] hover:border-l-10 ">

            <div class="flex gap-4 items-center mb-4">
                <svg class="w-16 h-16 text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                        clip-rule="evenodd" />
                </svg>

                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Membres des formations coursera

                </h3>

            </div>
            <div>

                <p class="text-4xl font-bold text-[#ff9822] dark:text-gray-400">
                    {{ $coursera_members->count() }}
                </p>
            </div>

        </div>
        <a href="{{route('odcusers.index')}}" class="rounded-xl items-center  p-2 h-36 w-full shadow-lg dark:shadow-lg dark:shadow-gray-500/20 backdrop-blur-xl bg-cover bg-[#fcdab40a] dark:bg-[#1e293b62] dark:hover:bg-gray-700   hover:bg-[#f8f0e7]  hover:scale-105 transition duration-700 ease-in-out border-l-8 border-[#ff9822] hover:border-l-10 ">
            <div
                >

                <div class=" flex gap-4 items-center mb-4">
                    <svg class=" w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                            clip-rule="evenodd" />
                    </svg>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        Nombre total d'utilisateurs enregistrés
                    </h3>

                </div>
                <div class="">

                    <p class="text-4xl font-bold text-[#ff9822] dark:text-gray-400">
                        {{ $user->count() }} </p>
                </div>

            </div>
        </a>

    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 md:p-4 p-1 gap-4 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full mb-8">

        <div
            class=" bg-[#fcdab40a] dark:bg-[#1e293b62] md:p-5 p-1 rounded-lg  w-full shadow-lg dark:shadow-lg dark:shadow-gray-500/20 ">
            <div class=" flex justify-between items-center ">
                <div class=" flex gap-4">
                    <div class=" ">
                        <a href="{{ route('activites.create') }}" class=" flex items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857ZM18 14a1 1 0 1 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0-2h-2v-2Z"
                                    clip-rule="evenodd" />
                            </svg>



                            <span class="text-gray-800 lg:text-sm  dark:text-gray-200">Ajouter une activite</span>

                        </a>
                    </div>
                    <div>
                        <a href="{{ route('rapportSemestriel.index') }}" class=" flex items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M11.403 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-6.403a3.01 3.01 0 0 1-1.743-1.612l-3.025 3.025A3 3 0 1 1 9.99 9.768l3.025-3.025A3.01 3.01 0 0 1 11.403 5Z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M13.232 4a1 1 0 0 1 1-1H20a1 1 0 0 1 1 1v5.768a1 1 0 1 1-2 0V6.414l-6.182 6.182a1 1 0 0 1-1.414-1.414L17.586 5h-3.354a1 1 0 0 1-1-1Z"
                                    clip-rule="evenodd" />
                            </svg>


                            <span class="text-gray-800 lg:text-sm  dark:text-gray-200">Genere Rapport</span>

                        </a>
                    </div>
                </div>


                <div>

                    <form class="max-w-sm mx-auto">
                        <div class=" flex items-center gap-4">
                            <div>
                                <select id="year-select"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">


                                </select>
                            </div>

                            <div>
                                <select id="month-select"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                </select>
                            </div>

                        </div>

                    </form>

                </div>

            </div>


            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div class=" grid grid-cols-1 md:grid-cols-2 gap-4 rounded-lg  w-full">
            <div class="  w-full">
                <div>
                    <h3 class="mb-6 text-lg font-normal text-gray-500 lg:text-xl  dark:text-gray-400">Dernière activité enregistrée</h3>
                </div>
                <div>
                    @foreach ($data as $i => $item)
                        <div
                            class=" h-16 flex shadow-lg dark:shadow-lg dark:shadow-gray-500/20   w-full gap-1 items-center p-2 mb-2 rounded-xl bg-[#fcdab40a] dark:bg-gray-800 dark:hover:bg-gray-600 hover:bg-[#f8f0e7] hover:scale-105 transition duration-700 ease-in-out">

                            <a href="{{ route('activites.show', $item->id) }}"
                                class="text-xs font-normal text-gray-800 lg:text-sm  dark:text-gray-400">{{ substr($item->title, 0, 50) }}...</a>

                        </div>
                    @endforeach
                </div>

            </div>

            <div class=" w-full">
                <div class=" m-4 ">
                    <canvas id="myChart2"></canvas>
                </div>


            </div>


        </div>

    </section>


    <div class="  p-4 sm:px-6 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div
                        class="bg-[#fcdab40a] border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-[#1e293b62] dark:border-neutral-700">
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                    Activités de la semaine (Lundi - Samedi)
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Découvrez les événements et activités prévus du lundi au samedi
                                </p>
                            </div>


                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-700 dark:divide-neutral-200">
                            <thead class="bg-[#fcdab40a] dark:bg-[#fcdab40a]">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <a class="group inline-flex items-center gap-x-2 text-xs font-semibold uppercase text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                                            href="#">
                                            Titre
                                            <svg class="shrink-0 size-3.5 text-gray-800 dark:text-neutral-200"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m7 15 5 5 5-5" />
                                                <path d="m7 9 5-5 5 5" />
                                            </svg>
                                        </a>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <a class="group inline-flex items-center gap-x-2 text-xs font-semibold uppercase text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                                            href="#">
                                            Categorie
                                            <svg class="shrink-0 size-3.5 text-gray-800 dark:text-neutral-200"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m7 15 5 5 5-5" />
                                                <path d="m7 9 5-5 5 5" />
                                            </svg>
                                        </a>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <a class="group inline-flex items-center gap-x-2 text-xs font-semibold uppercase text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                                            href="#">
                                            Statut
                                            <svg class="shrink-0 size-3.5 text-gray-800 dark:text-neutral-200"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m7 15 5 5 5-5" />
                                                <path d="m7 9 5-5 5 5" />
                                            </svg>
                                        </a>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <a class="group inline-flex items-center gap-x-2 text-xs font-semibold uppercase text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                                            href="#">
                                            Date debut
                                            <svg class="shrink-0 size-3.5 text-gray-800 dark:text-neutral-200"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m7 15 5 5 5-5" />
                                                <path d="m7 9 5-5 5 5" />
                                            </svg>
                                        </a>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <a class="group inline-flex items-center gap-x-2 text-xs font-semibold uppercase text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                                            href="#">
                                            Date fin
                                            <svg class="shrink-0 size-3.5 text-gray-800 dark:text-neutral-200"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m7 15 5 5 5-5" />
                                                <path d="m7 9 5-5 5 5" />
                                            </svg>
                                        </a>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-end"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-700 dark:divide-neutral-200">
                                @foreach ($activityForWeekend as $item)
                                    <tr
                                        class=" text-gray-700 dark:text-gray-200 bg-[#eaeaebf3] hover:bg-[#96816a0a] dark:bg-[#1e293b62] dark:hover:bg-neutral-800">
                                        <td scope="col" class="px-6 py-3">
                                            {{ $item->title }}

                                        </td>

                                        <td scope="col" class="px-6 py-3">
                                            {{ $item->categorie->name }}

                                        </td>

                                        <td scope="col" class="px-6 py-3">
                                            {{ $item->status ? '✔️' : '⭕️' }}
                                        </td>

                                        <td scope="col" class="px-6 py-3">
                                            {{ $item->start_date }}
                                        </td>

                                        <td scope="col" class="px-6 py-3">
                                            {{ $item->end_date }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    <span
                                        class="font-semibold text-gray-800 dark:text-neutral-200">{{ $activityForWeekend->count() }}</span>
                                    results
                                </p>
                            </div>


                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>

    @section('modal')
        <div id="myModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                            Activités de la semaine (Lundi - Samedi)
                        </h2>
                        <button type="button" onclick="closeModal()"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4 relative overflow-x-auto" id="resultsContainer">
                        @foreach ($activityForWeekend as $item)
                            <a href="http://127.0.0.1:8000/activites/${activite.id}"
                                class="inline-flex items-center justify-center p-5 text-base font-medium text-gray-500 rounded-lg bg-gray-50 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">

                                <span class="w-full">{{ $item->title }}</span>
                                <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                                <br>

                            </a>
                        @endforeach



                    </div>

                </div>
            </div>
        </div>
    @endsection


    @section('script')
        <script>
            function openModal() {
                document.getElementById('myModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('myModal').classList.add('hidden');
            }
        </script>
        <script>
            const currentYear = new Date().getFullYear();
            const currentMonth = new Date().getMonth() + 1;
            const startYear = 2022;
            const yearSelect = document.getElementById('year-select');
            const monthSelect = document.getElementById('month-select');

            for (let year = startYear; year <= currentYear; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.text = year;
                yearSelect.appendChild(option);
            }


            const months = [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ];


            function updateMonths(selectedYear) {
                monthSelect.innerHTML = '';
                const allOption = document.createElement('option');
                allOption.value = 'all';
                allOption.text = 'Tous les mois';
                monthSelect.appendChild(allOption);
                const maxMonth = (selectedYear == currentYear) ? currentMonth : 12;


                for (let i = 0; i < maxMonth; i++) {
                    const option = document.createElement('option');
                    option.value = i + 1;
                    option.text = months[i];
                    monthSelect.appendChild(option);
                }
            }

            yearSelect.addEventListener('change', function() {
                updateMonths(this.value);
            });


            yearSelect.value = currentYear;
            updateMonths(currentYear);
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const data1 = {
                labels: ['Hommes', 'Femmes'],
                datasets: [{
                    label: 'Participation',
                    data: [
                        {{ $hommes }},
                        {{ $femmes }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            const config1 = {
                type: 'doughnut',
                data: data1,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Participation des Hommes et des Femmes (7 Derniers Jours)'
                        }
                    }
                },
            };

            const myChart2 = new Chart(
                document.getElementById('myChart2'),
                config1
            );

            // Deuxième graphique (Line)
            let myChart;

            function fetchChartData(year, month) {
                let url = `/api/activities?year=${year}`;
                if (month !== "all") {
                    url += `&month=${month}`;
                }

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const dates = data.map(item => item.date);
                        const aggregates = data.map(item => item.aggregate);

                        // Mettre à jour le graphique avec les nouvelles données
                        if (myChart) {
                            myChart.data.labels = dates;
                            myChart.data.datasets[0].data = aggregates;
                            myChart.update();
                        } else {
                            const ctx = document.getElementById('myChart').getContext('2d');
                            myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: dates,
                                    datasets: [{
                                        label: 'Période de Création d\'Activités',
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        data: aggregates,
                                    }]
                                }
                            });
                        }
                    })
                    .catch(error => console.error('Erreur lors de la récupération des données :', error));
            }

            // Événements pour mettre à jour le graphique lors de la sélection de l'année ou du mois
            yearSelect.addEventListener('change', function() {
                fetchChartData(yearSelect.value, monthSelect.value);
            });

            monthSelect.addEventListener('change', function() {
                fetchChartData(yearSelect.value, monthSelect.value);
            });

            // Initialiser avec l'année et le mois par défaut
            fetchChartData(yearSelect.value, monthSelect.value);
        </script>
    @endsection



</x-app-layout>
