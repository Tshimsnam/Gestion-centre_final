@props(['odcuser', 'odcuserDatas', 'activitesP', 'activitespAll', 'candidatsData'])
<style>
    .custom-swal {
        width: 100%;
        background-color: #111827;
        color: white;
    }
</style>
<section class=" w-full p-4 flex justify-between gap-8">
    <div class="">
        <div class="bg-[#7357120a] border shadow-lg dark:shadow-lg dark:shadow-gray-500/20 p-4 mb-4 rounded-lg text-center">
            <div class="">
                <div class=" flex justify-center">
                    <img src="{{ $odcuser->picture }}" alt=""
                        class=" w-28 h-28 rounded-full object-cover border-4 border-gray-700 dark:border-white">
                </div>
            </div>
            <div class="mb-4">
                <h2
                    class="text-4xl mb-2 font-extrabold leading-none tracking-tight text-gray-700 md:text-5xl lg:text-5xl dark:text-white">
                    {{ $odcuser->first_name }} {{ $odcuser->last_name }}</h2>
                <p class="text-sm text-gray-400">{{ $odcuser->email }}</p>
                @if ($odcuser->hasCV)
                    <a href="#" id="showCVLink"
                        onclick="showUserCV(event, '{{ $odcuser->user_cv }}', '{{ $odcuser->first_name }}', '{{ $odcuser->last_name }}')"
                        class="text-sm hover:underline text-gray-400">Voir le CV</a>
                @endif
            </div>

            <div class=" flex justify-between gap-5 text-center">
                <div>
                    <span class="mb-6 text-lg font-normal text-gray-500 lg:text-sm  dark:text-gray-400">
                        Formation participées
                    </span>
                    <p
                        class="mb-4 text-4xl  leading-none tracking-tight text-gray-700 md:text-2xl lg:text-2xl dark:text-white">
                        {{ isset($nbrParticipation) ? $nbrParticipation : 0 }} +
                    </p>
                </div>
                <div>
                    <span class="mb-6 text-lg font-normal text-gray-500 lg:text-sm  dark:text-gray-400">
                        Formations postulees
                    </span>
                    <p
                        class="mb-4 text-4xl  leading-none tracking-tight text-gray-700 md:text-2xl lg:text-2xl dark:text-white">
                        {{ isset($activitesC) ? count($activitesC) : 0 }} +
                    </p>
                </div>
                {{-- <div>
                    <span class="mb-6 text-lg font-normal text-gray-500 lg:text-sm  dark:text-gray-400">
                        Taux Presence</span>
                    <p
                        class="mb-4 text-4xl leading-none tracking-tight text-gray-700 md:text-2xl lg:text-2xl dark:text-white">
                        {{ $taux_presence . ' %' }}</p>
                </div> --}}
            </div>

        </div>

        <div
            class=" bg-[#7357120a] border shadow-lg dark:shadow-lg dark:shadow-gray-500/20 p-4 mb-4 rounded-lg text-lg font-normal text-gray-500 lg:text-sm  dark:text-gray-400">

            <div
                class="mb-1.5 text-4xl font-extrabold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-2xl dark:text-white">
                <h2>Cordonnées utilisateur</h2>
            </div>
            @php
                $profession = json_decode($odcuser->profession, true);
            @endphp
            @foreach ($odcuserDatas as $item)
                <div class=" text-left">
                    <p>Numéro telephone :
                        <span>{{ isset($item['Téléphone']) ? $item['Téléphone'] : (isset($item['Téléphone (obligatoire)']) ? $item['Téléphone (obligatoire)'] : 'N/A') }}</span>
                    </p>
                </div>
                <div class=" text-left">
                    <p>Email : <span>{{ $odcuser->email }}</span></p>
                </div>
                <div class=" text-left">
                    <p>
                        @if (isset($item['Profesion']))
                            Profession : <span>{{ $item['Profesion'] }}</span>
                        @else
                            @if (isset($item['Spécialité ou domaine (étude ou profession)']))
                                Profession :
                                <span>{{ $item['Spécialité ou domaine (étude ou profession)'] }}</span>
                            @else
                                Profession :
                                <span>{{ $profession['translations']['fr']['profession'] ?? '' }}</span>
                            @endif
                        @endif
                    </p>
                </div>
            @break
        @endforeach

        <div class=" text-left">
            <p> LinkedIn : <span><a class="hover:underline"
                        href="{{ $odcuser->linkedin }}">{{ $odcuser->linkedin }}</a></span></p>
        </div>

        <div class=" text-left">
            <p> Genre : <span>{{ $odcuser->gender }}</span></p>
        </div>
        <div class=" text-left">
            <p> Date de naissance :
                <span>
                    @php
                        $date = new DateTimeImmutable($odcuser->birth_date);
                        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE);
                        $format = $formatter->format($date);
                    @endphp
                    {{ $format }}
                </span>
            </p>
        </div>
    </div>
</div>
<div class=" bg-[#7357120a] border shadow-lg dark:shadow-lg dark:shadow-gray-500/20 p-4 mb-4 rounded-lg w-full">
    <div class=" flex justify-between mb-4 items-center">
        <h3
            class="text-4xl font-extrabold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-2xl dark:text-white">
            Historique de participation</h3>
    </div>
    <div class=" flex justify-between gap-4 w-full md:inset-0  mb-8">
        @if (count($activitesP) > 0)
            @foreach ($activitesP as $item)
                <a href="{{ route('activites.show', $item->id) }}"
                    class=" h-36  flex  items-center  p-4 w-full rounded-lg shadow-lg dark:shadow-lg dark:shadow-gray-500/20 backdrop-blur-xl bg-cover bg-white dark:bg-gray-800 dark:hover:bg-gray-700  hover:bg-[#f8f0e7] hover:scale-105 transition duration-700 ease-in-out border-l-8 border-[#ff9822] hover:border-l-10 ">

                    <div>
                        <p class=" text-lg font-normal text-gray-500 lg:text-sm  dark:text-gray-400">
                            {{ $item->name }}
                        </p>

                        <h3 class="mb-4 mt-4 text-lg font-semibold text-gray-800 dark:text-gray-200 ">
                            {{ $item->title }}
                        </h3>
                    </div>
                </a>
            @endforeach
        @else
            <div class=" flex justify-center items-center w-full h-full">
                <p class=" text-lg font-normal text-gray-500 lg:text-sm  dark:text-gray-400">
                    Aucune
                    participation
                    enregistrée
                </p>
            </div>
        @endif

    </div>
    <div class="py-6 relative overflow-x-auto">
        <x-table-list-participations :activitespAll="$activitespAll" />
    </div>
</div>

</section>
