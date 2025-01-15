<x-app-layout>

    <style>
        .active {
            background: white;
            border-radius: 6px;
            color: #e38407;
        }

        /* Personnalisation de la barre de défilement */
        #search-activities .relative[style*="overflow-y: auto;"] {
            scrollbar-width: thin; /* Pour Firefox */
            scrollbar-color: #e38407 #f0f0f0; /* Couleur de la barre de défilement et de l'arrière-plan */
        }

        #search-activities .relative[style*="overflow-y: auto;"]::-webkit-scrollbar {
            width: 8px; /* Largeur de la barre de défilement */
        }

        #search-activities .relative[style*="overflow-y: auto;"]::-webkit-scrollbar-track {
            background: #f0f0f0; /* Couleur de l'arrière-plan de la barre de défilement */
        }

        #search-activities .relative[style*="overflow-y: auto;"]::-webkit-scrollbar-thumb {
            background-color: #e38407; /* Couleur de la barre de défilement */
            border-radius: 10px; /* Arrondir les bords de la barre de défilement */
        }

        #search-activities .relative[style*="overflow-y: auto;"]::-webkit-scrollbar-thumb:hover {
            background-color: #d57c06; /* Couleur de la barre de défilement au survol */
        }
    </style>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="font-medium">{{ $error }}</span>
            </div>
        @endforeach
    @endif



    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                @section('svg')
                    <svg aria-hidden="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z" />
                    </svg>
                @endsection
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Gestion des activités') }}
                </h2>
            </div>
        </div>
    </x-slot>

    @if (Session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class=" w-full bg-[#fcdab40a] darj p-4 rounded-lg bg-opacity-5 relative">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800  shadow-lg transition-all duration-300">
            <div class="p-6 space-y-4">
                <!-- Header Section -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Activités</h2>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Gérez vos activités, créez, modifiez et exportez facilement.
                        </p>
                    </div>

                    <!-- Actions Section -->
                    <div class="flex flex-wrap items-center gap-3">
                        <!-- View Toggle -->
                        <div class="inline-flex rounded-lg shadow-sm bg-gray-100 dark:bg-gray-700 p-1">
                            <button id="gridViewBtn"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200   text-gray-800 dark:text-white active">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                Grille
                            </button>
                            <button id="listViewBtn"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                Liste
                            </button>
                        </div>

                        <!-- Search Bar -->
                        <div class="relative">
                            <input type="search" onclick="openModal()"
                                class="w-64 pl-10 pr-4 py-2 text-sm text-gray-700 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 dark:focus:ring-orange-900 dark:text-white transition-colors duration-200"
                                placeholder="Rechercher des activités..." data-modal-target="search-activities"
                                data-modal-toggle="search-activities" />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Export Dropdown -->
                        <div class="relative inline-block">
                            <button id="dropdownExportButton"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Exporter
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="dropdownExport"
                                class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-600">
                                <div class="py-1">
                                    <a href="#"
                                        class="group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <svg class="mr-3 h-4 w-4 text-gray-400 group-hover:text-gray-500"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                                        </svg>
                                        Excel
                                    </a>
                                    <a href="#"
                                        class="group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <svg class="mr-3 h-4 w-4 text-gray-400 group-hover:text-gray-500"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" />
                                        </svg>
                                        PDF
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Create Activity Button -->
                        <a href="{{ route('activites.create') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg bg-orange-500 text-white hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Créer une activité
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="listView" class="hidden w-full rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table id="" class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700 border-b dark:border-gray-600">
                            <th class="group px-6 py-3 text-left">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">ID</span>
                                    <svg class="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M5 12l5-5 5 5H5z" />
                                    </svg>
                                </div>
                            </th>
                            <th class="group px-6 py-3 text-left">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Titre</span>
                                    <svg class="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M5 12l5-5 5 5H5z" />
                                    </svg>
                                </div>
                            </th>
                            <th class="group px-6 py-3 text-left">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Catégorie</span>
                                </div>
                            </th>
                            <th class="group px-6 py-3 text-left">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Date</span>
                                </div>
                            </th>
                            <th class="group px-6 py-3 text-left">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Lieu</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <span
                                    class="text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                        @forelse ($activites as $key => $activite)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $activite->_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            @if (empty($activite->thumbnail_url))
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ asset('img/placeholder-event.webp') }}" alt="">
                                            @else
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ $activite->thumbnail_url }}" alt="">
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $activite->title }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {!! Str::limit($activite->content, 50) !!}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                        {{ $activite->categorie->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($activite->start_date)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $activite->location }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                    <button id="dropdownMenuIconButton"
                                        data-dropdown-toggle="dropdownDots{{ $key }}"
                                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 4 15">
                                            <path
                                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div id="dropdownDots{{ $key }}"
                                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownMenuIconButton">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-left"
                                                aria-labelledby="dropdownMenuIconButton">
                                                <li>
                                                    <a href="{{ route('activites.show', $activite->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Voir</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('activites.edit', $activite->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Modifier</a>
                                                </li>

                                                <li>
                                                    @if ($activite->show_in_calendar)
                                                        <a href="{{ route('showInCalendar', $activite->id) }}"
                                                            onclick="return confirmAction(event, '{{ $activite->id }}', 'Désactiver')"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Désactiver
                                                            au
                                                            calendrier</a>
                                                    @else
                                                        <a href="{{ route('showInCalendar', $activite->id) }}"
                                                            onclick="return confirmAction(event, '{{ $activite->id }}', 'Activer')"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activer
                                                            au
                                                            calendrier</a>
                                                    @endif

                                                </li>

                                                <li>
                                                    @if ($activite->status)
                                                        <a href="{{ route('send', $activite->id) }}"
                                                            onclick="return confirmAction(event, '{{ $activite->id }}', 'Désactiver')"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Desactiver
                                                            Status</a>
                                                    @else
                                                        <a href="{{ route('send', $activite->id) }}"
                                                            onclick="return confirmAction(event, '{{ $activite->id }}', 'Activer')"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Active
                                                            Status</a>
                                                    @endif
                                                </li>

                                                <li>
                                                    @if ($activite->show_in_calendar)
                                                        <a href="{{ route('IsEvent', $activite->id) }}"
                                                            onclick="return confirmAction(event, '{{ $activite->id }}', 'Désactiver')"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Desactiver
                                                            IsEvent</a>
                                                    @else
                                                        <a href="{{ route('IsEvent', $activite->id) }}"
                                                            onclick="return confirmAction(event, '{{ $activite->id }}', 'Activer')"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Active
                                                            IsEvent</a>
                                                    @endif
                                                </li>

                                                <li>
                                                    @if ($activite->show_in_calendar)
                                                        <a href="{{ route('bookInSeat', $activite->id) }}"
                                                            onclick="return confirmAction(event, '{{ $activite->id }}', 'Désactiver')"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Désactiver
                                                            bookInSeat</a>
                                                    @else
                                                        <a href="{{ route('bookInSeat', $activite->id) }}"
                                                            data-modal-target="active-{{ $activite->id }}"
                                                            onclick="return confirmAction(event, '{{ $activite->id }}', 'Activer')"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activer
                                                            bookInSeat</a>
                                                    @endif
                                                </li>

                                                <li>
                                                    @if ($activite->show_in_slider)
                                                        <a href="{{ route('showInSlider', $activite->id) }}"
                                                            data-modal-target="active-{{ $activite->id }}"
                                                            onclick="return confirmAction(event, '{{ $activite->id }}', 'Désactiver')"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Désactiver
                                                            showInSlider</a>
                                                    @else
                                                        <a href="{{ route('showInSlider', $activite->id) }}"
                                                            data-modal-target="active-{{ $activite->id }}"
                                                            onclick="return confirmAction(event, '{{ $activite->id }}', 'Activer')"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activer
                                                            showInSlider</a>
                                                    @endif
                                                </li>

                                            </ul>
                                            <div class="py-2">
                                                <li>
                                                    <a onclick="return destroy(event, '{{ route('activites.destroy', $activite->id) }}')"
                                                        href="#"
                                                        class="block px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-left"
                                                        data-modal-target="delete"
                                                        data-modal-toggle="delete">Supprimer</a>
                                                </li>
                                            </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    Aucune activité trouvée
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($activites->hasPages())
                <div class="mt-6 p-4">
                    {{ $activites->links() }}
                </div>
            @endif
        </div>

        <div id="gridView">
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6 mt-8 ">
                @forelse ($activites as $activite)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden hover:scale-110 ">
                        <a href="{{ route('activites.show', $activite->id) }}" class="block">
                            <div class="relative">
                                @if (empty($activite->thumbnail_url))
                                    <img src="{{ asset('img/placeholder-event.webp') }}" alt="{{ $activite->name }}"
                                        class="w-full h-48 object-cover">
                                @else
                                    <img src="{{ $activite->thumbnail_url }}" alt="{{ $activite->name }}"
                                        class="w-full h-48 object-cover">
                                @endif
                                <div class="absolute top-0 right-0 m-2">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold text-white bg-orange-500 rounded-full">
                                        {{ $activite->categorie->name }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2 line-clamp-2">
                                    {{ $activite->title }}
                                </h3>

                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            <i class="far fa-calendar mr-1"></i>
                                            {{ \Carbon\Carbon::parse($activite->start_date)->format('d M Y') }}
                                        </span>
                                    </div>

                                </div>

                                <div class="flex items-center justify-between mt-4">
                                    <div class="flex items-center space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span class="truncate">{{ $activite->location }}</span>
                                    </div>
                                    <button class="text-orange-500 hover:text-orange-600 transition-colors">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full p-6 text-center">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 mb-4">
                            <i class="fas fa-calendar-times text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">
                            Aucune activité disponible
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">
                            Aucune activité n'a été trouvée. Veuillez réessayer avec d'autres critères.
                        </p>
                    </div>
                @endforelse
            </div>

            @if ($activites->hasPages())
                <div class="mt-6">
                    {{ $activites->links() }}
                </div>
            @endif
        </div>


    </div>

    @section('modal')
        <!-- Main modal -->
        <div id="search-activities" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-opacity duration-300 ease-in-out">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" style="max-height: 80vh; overflow: hidden;">
                    <!-- Modal header -->
                    <div class="sticky top-0 bg-white dark:bg-gray-700 z-10 border-b dark:border-gray-600">
                        <div class="flex items-center justify-between p-4 md:p-5">
                            <input type="search" id="search"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 dark:focus:ring-orange-900 dark:placeholder-gray-400"
                                placeholder="Rechercher des Activites ..." required aria-label="Rechercher des Activités" />
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="search-activities" aria-label="Fermer le modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4 relative overflow-y-auto" id="resultsContainer" style="max-height: calc(80vh - 100px);">
                        <p class="text-gray-500">Chargement des résultats...</p> <!-- Indication de chargement -->
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {
                var typingTimer;
                var doneTypingInterval = 500;

                $('#search').on('keyup', function() {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(searchActivites);

                });

                $('#search').on('keydown', function() {
                    clearTimeout(typingTimer);
                });

                function searchActivites() {
                    var formData = $('#search').serialize();
                    var searchInput = $('#search').val()
                        .trim();

                    if (searchInput === '') {

                        $('#resultsContainer').html('<p>Veuillez entrer un terme de recherche.</p>');
                        return;
                    }
                    if (searchInput.length < 3) {

                        $('#resultsContainer').html('<p>Veuillez entrer au moins 3 caractères.</p>');
                        return;
                    }

                    $.ajax({
                        url: "{{ route('activites.search') }}",
                        method: 'GET',
                        data: {
                            search: searchInput
                        },
                        success: function(response) {
                            var resultsContainer = $('#resultsContainer');
                            resultsContainer.html('');

                            if (response.length == 0) {
                                resultsContainer.html(
                                    '<p class=" text-red-500">Aucun résultat trouvé.</p>');
                            } else {
                                var htmlContent = '';

                                let host = window.location.origin;


                                response.forEach(function(activite) {
                                    htmlContent += `
        <div class="mb-3 transform transition-all hover:scale-[1.01]">
            <a href="${host}/activites/${activite.id}"
               class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-md transition-all">

                <!-- Image -->
                <div class="flex-shrink-0 h-16 w-16 rounded-lg overflow-hidden">
                    <img src="${activite.thumbnail_url || `${host}/img/placeholder-event.webp`}"
                         alt="${activite.title}"
                         class="h-full w-full object-cover">
                </div>

                <!-- Content -->
                <div class="ml-4 flex-grow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                            ${activite.title}
                        </h3>
                        <span class="px-2 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-full dark:bg-orange-900 dark:text-orange-300">
                            ${activite.categorie?.name || 'Non catégorisé'}
                        </span>
                    </div>

                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex items-center mr-4">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            ${new Date(activite.start_date).toLocaleDateString('fr-FR', {
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric'
                            })}
                        </div>

                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            ${activite.location || 'Lieu non spécifié'}
                        </div>
                    </div>
                </div>

                <!-- Arrow -->
                <div class="ml-4 flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-400 transition-transform group-hover:translate-x-1"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        </div>
    `;
                                });
                                resultsContainer.html(htmlContent);
                            }
                        },
                        error: function(xhr) {
                            console.error('Erreur de la requête AJAX', xhr);
                        }
                    });
                }
            });

            function openModal() {
                const modal = document.getElementById('search-activities').classList.remove('hidden')
                const inputField = document.getElementById('search').focus()
            }



            document.addEventListener("DOMContentLoaded", () => {
                const gridViewBtn = document.getElementById("gridViewBtn");
                const listViewBtn = document.getElementById("listViewBtn");
                const gridView = document.getElementById("gridView");
                const listView = document.getElementById("listView");

                // Fonction pour changer la vue
                function switchView(view) {
                    if (view === 'grid') {
                        gridView.classList.remove("hidden");
                        listView.classList.add("hidden");
                        gridViewBtn.classList.add("active");
                        listViewBtn.classList.remove("active");
                        localStorage.setItem('selectedView', 'grid');
                    } else {
                        listView.classList.remove("hidden");
                        gridView.classList.add("hidden");
                        listViewBtn.classList.add("active");
                        gridViewBtn.classList.remove("active");
                        localStorage.setItem('selectedView', 'list');
                    }
                }

                // Restaurer la vue précédemment sélectionnée
                const savedView = localStorage.getItem('selectedView') || 'grid';
                switchView(savedView);

                // Gestionnaires d'événements pour les boutons
                gridViewBtn.addEventListener("click", () => switchView('grid'));
                listViewBtn.addEventListener("click", () => switchView('list'));
            });
        </script>

        <script>
            $(document).ready(function() {
                $(document).on('click', '.btnModal', function() {
                    let id = $(this).data('dropdown-toggle');
                    $('.modal').not('#' + id).hide();
                    $('#' + id).toggle();
                    event.stopPropagation();
                });

                $('body').on('click', function(event) {
                    if (!$(event.target).closest('.modal, .btnModal').length) {
                        $('.modal').hide();
                    }
                });


                $(document).on('click', '.modal', function(event) {
                    event.stopPropagation();
                });


            });
        </script>

        <script>
            function destroy(event, url) {
                event.preventDefault();

                if (confirm("Êtes-vous sûr de vouloir supprimer cet élément ?")) {
                    POST
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.style.display = 'none';


                    let csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(csrfToken);


                    let _method = document.createElement('input');
                    _method.type = 'hidden';
                    _method.name = '_method';
                    _method.value = 'DELETE';
                    form.appendChild(_method);


                    document.body.appendChild(form);
                    form.submit();
                }

                return false;
            }


            function confirmAction(event, id, action) {
                event.preventDefault();

                let message = `Êtes-vous sûr de vouloir ${action.toLowerCase()} cette activité au calendrier ?`;

                if (confirm(message)) {

                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = event.target.href;
                    form.style.display = 'none';


                    let csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(csrfToken);


                    let status = document.createElement('input');
                    status.type = 'hidden';
                    status.name = 'status';
                    status.value = action === 'Activer' ? 'true' : 'false';
                    form.appendChild(status);


                    document.body.appendChild(form);
                    form.submit();
                }
                return false;
            }
        </script>

        <script>
            $(document).ready(function() {
                $('.dt-container').addClass('text-xl text-gray-800 dark:text-gray-200 leading-tight')

                $('.dt-buttons').addClass('mt-4')

                $('.dt-buttons buttons').addClass('cursor-pointer mt-5 bg-slate-600 p-2 rounded-sm font-bold')
            })
        </script>

        <script>
            $(document).ready(function() {
                $('#table').on('click', '.btn-menu', function() {
                    const lien = $(this).attr('data-dropdown-toggle')
                    $('#' + lien).fadeToggle('fast')
                })
            })
        </script>

        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('dt-length-0').addClass('w-24')
                $('#table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    language: {
                        lengthMenu: 'Afficher les entrées _MENU_',
                        info: 'Affichage de la page _PAGE_ sur _PAGES_'
                    },
                    ajax: {
                        url: "{{ route('get') }}",
                        type: "GET",
                        dataSrc: function(json) {
                            if (json.error) {
                                alert(json.error);
                                return [];
                            }
                            return json.data;
                        }
                    },

                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'categorie_id',
                            name: 'categorie_id'
                        },
                        {
                            data: 'typEvent',
                            name: 'typEvent'
                        },
                        {
                            data: 'location',
                            name: 'location'
                        },
                        {
                            data: 'message',
                            name: 'message'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'book_a_seat',
                            name: 'book_a_seat'
                        },
                        {
                            data: 'number_day',
                            name: 'number_day'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date'
                        },
                        {
                            data: 'end_date',
                            name: 'end_date'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ]
                });


                $('.dt-container').addClass('text-base text-gray-800 dark:text-gray-400 leading-tight')

                $('.dt-buttons').addClass('mt-4')
                $('.dt-buttons buttons').addClass('cursor-pointer mt-5 bg-slate-600 p-2 rounded-sm font-bold')

                $("#dt-length-0").addClass('text-gray-700 dark:text-gray-400 w-24 bg-white');

                $('.dt-input').addClass('w-20')


            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Fonction pour charger les données
                function loadActivites(url) {
                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            // Mettre à jour le contenu de la vue
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');

                            // Mise à jour de la grille/liste des activités
                            if (document.getElementById('gridView').style.display !== 'none') {
                                document.getElementById('gridView').innerHTML = doc.getElementById('gridView')
                                    .innerHTML;
                            } else {
                                document.querySelector('#table tbody').innerHTML = doc.querySelector(
                                    '#table tbody').innerHTML;
                            }

                            // Mise à jour de la pagination
                            document.getElementById('pagination-container').innerHTML = doc.getElementById(
                                'pagination-container').innerHTML;

                            // Mettre à jour l'URL sans recharger la page
                            window.history.pushState({}, '', url);

                            // Réinitialiser les écouteurs d'événements
                            initPaginationListeners();
                        })
                        .catch(error => console.error('Erreur:', error));
                }

                // Fonction pour initialiser les écouteurs d'événements de pagination
                function initPaginationListeners() {
                    document.querySelectorAll('#pagination-container a').forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            loadActivites(this.href);
                        });
                    });
                }

                // Initialisation des écouteurs d'événements
                initPaginationListeners();
            });
        </script>
    @endsection

</x-app-layout>
