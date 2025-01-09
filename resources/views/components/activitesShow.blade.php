@props([
    'event',
    'nbj',
    'candidats',
    'total_ih',
    'total_if',
    'total_ph',
    'total_pf',
    'total_p',
    'participants',
    'nbj',
    'criteres',
])

<div class=" p-4 rounded-lg bg-[#eaeaebf3] dark:bg-gray-800" id="styled-details" role="tabpanel"
    aria-labelledby="details-tab">
    <div class="k-state-active k-content" style="opacity: 1; display: block;">
        <div class="weather">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="basis-2/4">
                    @if (empty($event->thumbnail_url))
                        <img class="" src="{{ asset('img/placeholder-event.webp') }}"
                            alt="Event placeholder image">
                    @else
                        <img class="" src="{{ $event->thumbnail_url }}" alt="{{ $event->title }}">
                    @endif

                    <h2 style="font-size:30px;margin-top:30px;text-decoration:underline;"></h2>

                    <div id="accordion-collapse" data-accordion="collapse">
                        <h2 id="accordion-collapse-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                                aria-controls="accordion-collapse-body-1">
                                <span>{{ $event->title }}</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-1" class="hidden"
                            aria-labelledby="accordion-collapse-heading-1">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <p class="mb-2 text-gray-800 dark:text-white"> {!! $event->content ?? null !!}</p>

                            </div>
                        </div>

                    </div>

                    <div>
                        <div class="py-5 text-justify">

                            <!-- $item->data->content -->
                        </div>
                    </div>
                </div>
                <div class="basis-2/4">
                    <div class="flex flex-wrap gap-2 py-5">
                        <!-- Status Badge -->
                        <div class="badge-wrapper">
                            @if ($event->status)
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                                    </svg>
                                    status
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" />
                                    </svg>
                                    status Inactif
                                </span>
                            @endif
                        </div>

                        <!-- Deleted Badge -->
                        <div class="badge-wrapper">
                            @if ($event->deleted)
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Supprimé
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" />
                                    </svg>
                                    Non Supprimé
                                </span>
                            @endif
                        </div>

                        <!-- Calendar Badge -->
                        <div class="badge-wrapper">
                            @if ($event->showInCalendar)
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Calendrier
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" />
                                    </svg>
                                    Calendrier Inactif
                                </span>
                            @endif
                        </div>

                        <!-- Slider Badge -->
                        <div class="badge-wrapper">
                            @if ($event->showInSlider)
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                                    </svg>
                                    Slider
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" />
                                    </svg>
                                    Slider Inactif
                                </span>
                            @endif
                        </div>

                        <!-- Form Badge -->
                        <div class="badge-wrapper">
                            @if ($event->bookASeat)
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Formulaire
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" />
                                    </svg>
                                    Formulaire Inactif
                                </span>
                            @endif
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200 dark:border-gray-700">

                    <div
                        class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 bg-slate-50 dark:bg-gray-800 rounded-lg shadow-sm">
                        <!-- Date de création -->
                        <div
                            class="p-3 bg-white dark:bg-gray-700 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <h3 class="font-semibold text-gray-700 dark:text-gray-200">Date de création</h3>
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($event->createdAt)->format('d/m/Y H:i') }}
                            </div>
                        </div>

                        <!-- Date Début -->
                        <div
                            class="p-3 bg-white dark:bg-gray-700 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                                <h3 class="font-semibold text-gray-700 dark:text-gray-200">Date Début</h3>
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}
                            </div>
                        </div>

                        <!-- Date Fin -->
                        <div
                            class="p-3 bg-white dark:bg-gray-700 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                                <h3 class="font-semibold text-gray-700 dark:text-gray-200">Date Fin</h3>
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}
                            </div>
                        </div>

                        <!-- Durée -->
                        <div
                            class="p-3 bg-white dark:bg-gray-700 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="font-semibold text-gray-700 dark:text-gray-200">Durée</h3>
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                @if ($nbj == 1)
                                    1 jour
                                @else
                                    {{ $nbj }} jours
                                @endif
                            </div>
                        </div>
                    </div>

                    @php
                        // Initialisation des dates
                        $now = now();
                        $createdAt = Carbon\Carbon::parse($event->createdAt);
                        $startDate = Carbon\Carbon::parse($event->start_date);
                        $endDate = Carbon\Carbon::parse($event->end_date);

                        // Calcul des différences en jours
                        $daysUntilStart = $now->diffInDays($startDate, false);
                        $daysUntilEnd = $now->diffInDays($endDate, false);
                        $eventDuration = $startDate->diffInDays($endDate);
                        $daysSinceCreation = $now->diffInDays($createdAt);
                        $daysFromCreateToStart = $createdAt->diffInDays($startDate);

                        // Initialisation des variables
                        $status = '';
                        $statusColor = '';
                        $percent = 0;

                        // Détermination du statut de l'événement
if ($startDate <= $now && $endDate >= $now) {
    // Événement en cours
    $daysElapsed = $startDate->diffInDays($now);
    $percent = min(($daysElapsed * 100) / max($eventDuration, 1), 100);
    $status = 'En cours';
    $statusColor = 'green';
} elseif ($startDate > $now) {
    // Événement à venir
    $percent = min(($daysSinceCreation * 100) / max($daysFromCreateToStart, 1), 100);
    $status = $daysUntilStart === 1 ? 'Dans 1 jour' : "Dans $daysUntilStart jours";
    $statusColor = 'blue';
} else {
    // Événement terminé
    $percent = 100;
    $daysAgo = abs($daysUntilEnd);
    $status = $daysAgo === 1 ? 'Il y a 1 jour' : "Il y a $daysAgo jours";
    $statusColor = $daysAgo === 1 ? 'orange' : 'gray';
                        }
                    @endphp
                    <div class="p-4 my-5 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                        <div class="flex justify-between mb-2">
                            <span class="text-base font-medium text-{{ $statusColor }}-700 dark:text-white">
                                {{ $status }}
                            </span>
                            <span class="text-sm font-medium text-{{ $statusColor }}-700 dark:text-white">
                                {{ number_format($percent, 1) }}%
                            </span>
                        </div>

                        <div class="relative w-full h-2.5 bg-gray-200 rounded-full dark:bg-gray-700">
                            <div class="absolute top-0 left-0 h-full bg-{{ $statusColor }}-600 rounded-full transition-all duration-500 ease-out"
                                style="width: {{ $percent }}%">
                            </div>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200 dark:border-gray-700">
                    <!-- Statistics Cards Section -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <!-- Total Inscrits -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-300">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-gray-500 dark:text-gray-400 text-sm font-semibold">Total Inscrits
                                    </h4>
                                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-full">
                                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-3xl font-bold text-gray-700 dark:text-gray-200">
                                            {{ $candidats->count() }}</h2>
                                        <p class="text-xs text-gray-400">Personnes inscrites</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Hommes -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-300">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-gray-500 dark:text-gray-400 text-sm font-semibold">Total Hommes
                                    </h4>
                                    <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-full">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                            {{ $total_ih }}</h2>
                                        <p class="text-xs text-gray-400">Hommes inscrits</p>
                                    </div>
                                    <div class="text-sm text-gray-400">
                                        {{ number_format(($total_ih / max($candidats->count(), 1)) * 100, 1) }}%
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Femmes -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-300">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-gray-500 dark:text-gray-400 text-sm font-semibold">Total Femmes
                                    </h4>
                                    <div class="p-2 bg-pink-100 dark:bg-pink-900 rounded-full">
                                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-3xl font-bold text-pink-600 dark:text-pink-400">
                                            {{ $total_if }}</h2>
                                        <p class="text-xs text-gray-400">Femmes inscrites</p>
                                    </div>
                                    <div class="text-sm text-gray-400">
                                        {{ number_format(($total_if / max($candidats->count(), 1)) * 100, 1) }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Participants Statistics Cards Section -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <!-- Total Participants -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-300">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-gray-500 dark:text-gray-400 text-sm font-semibold">Total
                                        Participants</h4>
                                    <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-full">
                                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                                            {{ $total_p }}</h2>
                                        <p class="text-xs text-gray-400">Participants actifs</p>
                                    </div>
                                    <div class="text-sm text-gray-400">
                                        {{ number_format(($total_p / max($candidats->count(), 1)) * 100, 1) }}%
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Participants Hommes -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-300">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-gray-500 dark:text-gray-400 text-sm font-semibold">Participants
                                        Hommes</h4>
                                    <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-full">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                            {{ $total_ph }}</h2>
                                        <p class="text-xs text-gray-400">Hommes participants</p>
                                    </div>
                                    <div class="text-sm text-gray-400">
                                        {{ number_format(($total_ph / max($total_p, 1)) * 100, 1) }}%
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Participants Femmes -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-300">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-gray-500 dark:text-gray-400 text-sm font-semibold">Participants
                                        Femmes</h4>
                                    <div class="p-2 bg-pink-100 dark:bg-pink-900 rounded-full">
                                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-3xl font-bold text-pink-600 dark:text-pink-400">
                                            {{ $total_pf }}</h2>
                                        <p class="text-xs text-gray-400">Femmes participantes</p>
                                    </div>
                                    <div class="text-sm text-gray-400">
                                        {{ number_format(($total_pf / max($total_p, 1)) * 100, 1) }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-5 border-gray-200 dark:border-gray-700">

                    <!-- Action Buttons Section -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4">
                        <!-- Parcours Button -->
                        <button data-modal-target="parcours-modal" data-modal-toggle="parcours-modal"
                            onclick="parcours({{ $event->id }})"
                            class="group relative w-full flex items-center justify-center px-6 py-3 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm transition-all duration-300 hover:shadow-lg overflow-hidden">
                            <div
                                class="absolute inset-0 w-3 bg-blue-800 transition-all duration-300 ease-out group-hover:w-full opacity-0 group-hover:opacity-20">
                            </div>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>Candidats avec parcours</span>
                        </button>

                        <!-- Nouveaux Button -->
                        <button data-modal-target="news-modal" data-modal-toggle="news-modal"
                            onclick="nouveau({{ $event->id }})"
                            class="group relative w-full flex items-center justify-center px-6 py-3 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm transition-all duration-300 hover:shadow-lg overflow-hidden">
                            <div
                                class="absolute inset-0 w-3 bg-green-700 transition-all duration-300 ease-out group-hover:w-full opacity-0 group-hover:opacity-20">
                            </div>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Nouveaux candidats</span>
                        </button>

                        <!-- Cinq Formations Button -->
                        <button data-modal-target="cinq-modal" data-modal-toggle="cinq-modal"
                            onclick="cinq_event({{ $event->id }})"
                            class="group relative w-full flex items-center justify-center px-6 py-3 text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm transition-all duration-300 hover:shadow-lg overflow-hidden">
                            <div
                                class="absolute inset-0 w-3 bg-cyan-700 transition-all duration-300 ease-out group-hover:w-full opacity-0 group-hover:opacity-20">
                            </div>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span>Candidats avec 5+ formations</span>
                        </button>

                        <!-- Modifier Button -->
                        <a href="{{ route('activites.edit', $event->id) }}"
                            class="group relative w-full flex items-center justify-center px-6 py-3 text-white bg-gradient-to-r from-purple-400 via-purple-500 to-purple-600 hover:bg-gradient-to-br focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm transition-all duration-300 hover:shadow-lg overflow-hidden">
                            <div
                                class="absolute inset-0 w-3 bg-purple-700 transition-all duration-300 ease-out group-hover:w-full opacity-0 group-hover:opacity-20">
                            </div>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span>Modifier Activité</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template pour les modales -->
@php
    $modals = [
        [
            'id' => 'parcours-modal',
            'title' => 'Candidats avec parcours',
            'table_id' => 'search-table',
            'columns' => ['N°', 'Nom', 'Prénom', 'Genre', 'Parcours'],
        ],
        [
            'id' => 'news-modal',
            'title' => 'Nouveaux candidats',
            'table_id' => 'news-table',
            'columns' => ['N°', 'Nom', 'Prénom', 'Genre'],
        ],
        [
            'id' => 'cinq-modal',
            'title' => 'Candidats avec 5+ formations',
            'table_id' => 'cinq-table',
            'columns' => ['N°', 'Nom', 'Prénom', 'Genre', 'Formation'],
        ],
    ];
@endphp

@section('modal')
    @foreach ($modals as $modal)
        <div id="{{ $modal['id'] }}" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-7xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-2 text-gray-500 dark:text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            {{ $modal['title'] }}
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition-colors duration-200"
                            data-modal-hide="{{ $modal['id'] }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Fermer</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-6 space-y-4 overflow-y-auto max-h-[60vh]">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table id="{{ $modal['table_id'] }}"
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        @foreach ($modal['columns'] as $column)
                                            <th scope="col" class="px-6 py-3">
                                                <span class="flex items-center">{{ $column }}</span>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-700">
                        <button data-modal-hide="{{ $modal['id'] }}" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors duration-200">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection



<script>
// Animation des lignes du tableau
document.querySelectorAll('#usersTable tbody tr').forEach(row => {
    row.addEventListener('mouseenter', () => {
        row.classList.add('bg-gray-50', 'dark:bg-gray-700', 'transition-colors', 'duration-150');
    });
    row.addEventListener('mouseleave', () => {
        row.classList.remove('bg-gray-50', 'dark:bg-gray-700');
    });
});

// Recherche en temps réel
const searchInput = document.getElementById('search');
const resultsContainer = document.getElementById('resultsContainer');

searchInput.addEventListener('input', debounce(async (e) => {
    const searchTerm = e.target.value;
    if (searchTerm.length < 2) return;

    try {
        // Simuler une recherche (à remplacer par votre logique)
        const results = await searchUsers(searchTerm);
        displayResults(results);
    } catch (error) {
        console.error('Erreur de recherche:', error);
    }
}, 300));

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
</script>
