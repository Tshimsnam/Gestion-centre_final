<x-app-layout>
    <div class="relative mt-8 mb-12">
        <!-- Contenu -->
        <div class="relative">
            <div class="flex flex-col gap-6">
                <!-- Titre et Badge -->
                <div class="flex items-center gap-4">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white">
                        Tableau de Bord
                    </h1>
                    <span class="px-3 py-1 text-sm font-medium rounded-md
                        bg-orange-100 text-orange-800 dark:bg-orange-900/50 dark:text-orange-300">
                        Administration
                    </span>
                </div>

                <!-- Description -->
                <div class="flex flex-col md:flex-row md:items-center gap-4 text-gray-600 dark:text-gray-400">
                    <span class="text-lg font-medium">Supervision Complète</span>
                    <div class="flex items-center gap-6">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            Activités
                        </span>
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                            </svg>
                            Apprenants
                        </span>
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                            </svg>
                            Employabilité
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Séparateur -->
        <div class="mt-8 border-b border-gray-200 dark:border-gray-700"></div>
    </div>

    <section class="grid grid-cols-1 md:grid-cols-4 gap-6 w-full mb-8">
        <a href="{{ route('activites.index') }}"
            class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden transition-all duration-300
            hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)] dark:hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)]
            border border-gray-100 dark:border-gray-700">
            <div class="absolute top-0 left-0 w-2 h-full bg-[#ff9822] transition-all duration-300 group-hover:w-3"></div>
            <div class="p-6 relative">
                <div class="flex items-start gap-4 mb-6">
                    <div
                        class="flex-shrink-0 p-3 rounded-lg bg-orange-50 dark:bg-gray-700
                        group-hover:bg-orange-100 dark:group-hover:bg-gray-600 transition-colors">
                        <svg class="w-8 h-8 text-[#ff9822] dark:text-orange-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z" />
                            <path
                                d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-gray-200 group-hover:text-[#ff9822] transition-colors">
                            Total des activités
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Toutes les activités enregistrées
                        </p>
                    </div>
                </div>

                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-3xl font-bold text-[#ff9822] dark:text-orange-400">
                            {{ $activites->count() }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Activités</p>
                    </div>
                    <div
                        class="text-gray-400 dark:text-gray-500 transform translate-x-2 group-hover:translate-x-0 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-[#ff98221a] to-transparent opacity-0
                group-hover:opacity-100 transition-opacity pointer-events-none">
            </div>
        </a>

        <!-- Carte pour les activités de la semaine -->
        <div onclick="openModal()"
            class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden transition-all duration-300
            hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)] dark:hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)]
            border border-gray-100 dark:border-gray-700 cursor-pointer">
            <div class="absolute top-0 left-0 w-2 h-full bg-[#ff9822] transition-all duration-300 group-hover:w-3">
            </div>
            <div class="p-6 relative">
                <div class="flex items-start gap-4 mb-6">
                    <div
                        class="flex-shrink-0 p-3 rounded-lg bg-orange-50 dark:bg-gray-700
                        group-hover:bg-orange-100 dark:group-hover:bg-gray-600 transition-colors">
                        <svg class="w-8 h-8 text-[#ff9822] dark:text-orange-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-gray-200 group-hover:text-[#ff9822] transition-colors">
                            Activités hebdomadaires
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Lundi - Samedi
                        </p>
                    </div>
                </div>

                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-3xl font-bold text-[#ff9822] dark:text-orange-400">
                            {{ $activityForWeekend->count() }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Cette semaine</p>
                    </div>
                    <div
                        class="text-gray-400 dark:text-gray-500 transform translate-x-2 group-hover:translate-x-0 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-[#ff98221a] to-transparent opacity-0
                group-hover:opacity-100 transition-opacity pointer-events-none">
            </div>
        </div>

        <!-- Carte pour les membres Coursera -->
        <div
            class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden transition-all duration-300
            hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)] dark:hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)]
            border border-gray-100 dark:border-gray-700">
            <div class="absolute top-0 left-0 w-2 h-full bg-[#ff9822] transition-all duration-300 group-hover:w-3">
            </div>
            <div class="p-6 relative">
                <div class="flex items-start gap-4 mb-6">
                    <div
                        class="flex-shrink-0 p-3 rounded-lg bg-orange-50 dark:bg-gray-700
                        group-hover:bg-orange-100 dark:group-hover:bg-gray-600 transition-colors">
                        <svg class="w-8 h-8 text-[#ff9822] dark:text-orange-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-gray-200 group-hover:text-[#ff9822] transition-colors">
                            Membres Coursera
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Formations en cours
                        </p>
                    </div>
                </div>

                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-3xl font-bold text-[#ff9822] dark:text-orange-400">
                            {{ $coursera_members->count() }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Apprenants</p>
                    </div>
                    <div
                        class="text-gray-400 dark:text-gray-500 transform translate-x-2 group-hover:translate-x-0 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-[#ff98221a] to-transparent opacity-0
                group-hover:opacity-100 transition-opacity pointer-events-none">
            </div>
        </div>

        <!-- Carte pour les utilisateurs -->
        <a href="{{ route('odcusers.index') }}"
            class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden transition-all duration-300
            hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)] dark:hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)]
            border border-gray-100 dark:border-gray-700">
            <div class="absolute top-0 left-0 w-2 h-full bg-[#ff9822] transition-all duration-300 group-hover:w-3">
            </div>
            <div class="p-6 relative">
                <div class="flex items-start gap-4 mb-6">
                    <div
                        class="flex-shrink-0 p-3 rounded-lg bg-orange-50 dark:bg-gray-700
                        group-hover:bg-orange-100 dark:group-hover:bg-gray-600 transition-colors">
                        <svg class="w-8 h-8 text-[#ff9822] dark:text-orange-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-gray-200 group-hover:text-[#ff9822] transition-colors">
                            Utilisateurs
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Total des utilisateurs
                        </p>
                    </div>
                </div>

                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-3xl font-bold text-[#ff9822] dark:text-orange-400">
                            {{ $user->count() }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Utilisateurs</p>
                    </div>
                    <div
                        class="text-gray-400 dark:text-gray-500 transform translate-x-2 group-hover:translate-x-0 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-[#ff98221a] to-transparent opacity-0
                group-hover:opacity-100 transition-opacity pointer-events-none">
            </div>
        </a>

    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full mb-8">
        <!-- Graphique principal -->
        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden transition-all duration-300
            hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)] dark:hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)]
            border border-gray-100 dark:border-gray-700">
            <div class="p-6">
                <!-- En-tête avec actions -->
                <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                    <!-- Actions à gauche -->
                    <div class="flex gap-4">
                        <a href="{{ route('activites.create') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-orange-50 dark:bg-gray-700
                            hover:bg-orange-100 dark:hover:bg-gray-600 transition-colors
                            text-gray-700 dark:text-gray-200">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857ZM18 14a1 1 0 1 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0-2h-2v-2Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium">Ajouter une activité</span>
                        </a>

                        <a href="{{ route('rapportSemestriel.index') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-orange-50 dark:bg-gray-700
                            hover:bg-orange-100 dark:hover:bg-gray-600 transition-colors
                            text-gray-700 dark:text-gray-200">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.403 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-6.403a3.01 3.01 0 0 1-1.743-1.612l-3.025 3.025A3 3 0 1 1 9.99 9.768l3.025-3.025A3.01 3.01 0 0 1 11.403 5Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M13.232 4a1 1 0 0 1 1-1H20a1 1 0 0 1 1 1v5.768a1 1 0 1 1-2 0V6.414l-6.182 6.182a1 1 0 0 1-1.414-1.414L17.586 5h-3.354a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium">Générer Rapport</span>
                        </a>
                    </div>

                    <!-- Filtres à droite -->
                    <div class="flex gap-4">
                        <select id="year-select"
                            class="bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg
                            focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200
                            dark:focus:ring-orange-500 dark:focus:border-orange-500">
                        </select>

                        <select id="month-select"
                            class="bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg
                            focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200
                            dark:focus:ring-orange-500 dark:focus:border-orange-500">
                        </select>
                    </div>
                </div>

                <!-- Graphique -->
                <div class="w-full h-[400px]">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Section droite -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Dernières activités -->
            <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden transition-all duration-300
                hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)] dark:hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)]
                border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6">
                    Dernières activités enregistrées
                </h3>

                <div class="space-y-3">
                    @foreach ($data as $item)
                        <a href="{{ route('activites.show', $item->id) }}"
                            class="group flex items-center p-3 rounded-lg transition-all duration-300
                            bg-gray-50 dark:bg-gray-700/50
                            hover:bg-orange-50 dark:hover:bg-gray-700
                            border border-gray-100 dark:border-gray-600">
                            <span class="text-sm text-gray-600 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">
                                {{ substr($item->title, 0, 50) }}...
                            </span>
                            <svg class="w-5 h-5 ml-auto text-gray-400 group-hover:text-gray-600 dark:text-gray-500 dark:group-hover:text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Graphique circulaire -->
            <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden transition-all duration-300
                hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)] dark:hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)]
                border border-gray-100 dark:border-gray-700 p-6">
                <div class="w-full h-full">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </section>

    <div class="p-4 sm:px-6 mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden transition-all duration-300
            hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)] dark:hover:shadow-[0_0_40px_-15px_rgba(255,152,34,0.3)]
            border border-gray-100 dark:border-gray-700">

            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Activités de la semaine (Lundi - Samedi)
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Découvrez les événements et activités prévus du lundi au samedi
                </p>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            @foreach(['Titre', 'Categorie', 'Statut', 'Date debut', 'Date fin'] as $header)
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                        {{ $header }}
                                    </span>
                                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="m7 15 5 5 5-5M7 9l5-5 5 5"/>
                                    </svg>
                                </div>
                            </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($activityForWeekend as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                        {{ $item->title }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300">
                                    {{ $item->categorie->name }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center">
                                    @if($item->status)
                                        <span class="flex items-center text-green-600 dark:text-green-400">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Terminé
                                        </span>
                                    @else
                                        <span class="flex items-center text-yellow-600 dark:text-yellow-400">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            En cours
                                        </span>
                                    @endif
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Affichage de <span class="font-medium text-gray-900 dark:text-gray-200">{{ $activityForWeekend->count() }}</span> activités
                </p>
            </div>
        </div>
    </div>

    @section('modal')
        <div id="myModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden fixed top-0 left-0 w-full h-full bg-gray-900/75 backdrop-blur-sm flex justify-center items-center z-50">
            <div class="relative p-4 w-full max-w-3xl max-h-[90vh] overflow-hidden">
                <!-- Modal content -->
                <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                Activités de la semaine
                            </h2>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Du Lundi au Samedi
                            </p>
                        </div>
                        <button type="button" onclick="closeModal()"
                            class="p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100
                            dark:hover:bg-gray-700 dark:hover:text-gray-300 transition-colors">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-6 overflow-y-auto max-h-[60vh] space-y-4">
                        @foreach ($activityForWeekend as $activite)
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <a href="{{ route('activites.show', $activite->id) }}"
                                class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl
                                hover:bg-orange-50 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-600
                                transition-all duration-300">

                                <!-- Image -->
                                <div class="flex-shrink-0 h-16 w-16 rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-600">
                                    <img src="{{ $activite->thumbnail_url ?? asset('img/placeholder-event.webp') }}"
                                        alt="{{ $activite->title }}"
                                        class="h-full w-full object-cover">
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-4">
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 truncate">
                                            {{ $activite->title }}
                                        </h3>
                                        <span class="flex-shrink-0 px-3 py-1 text-xs font-medium rounded-full
                                            text-orange-700 bg-orange-100 dark:bg-orange-900 dark:text-orange-300">
                                            {{ $activite->categorie->name ?? 'Non catégorisé' }}
                                        </span>
                                    </div>

                                    <div class="mt-2 flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>{{ \Carbon\Carbon::parse($activite->start_date)->format('d M Y') }}</span>
                                        </div>

                                        @if($activite->location)
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span>{{ $activite->location }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex-shrink-0 text-gray-400 dark:text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </a>
                        </div>
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
