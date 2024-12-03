@props(['activitespAll'])

<div class="overflow-x-auto">
    <table id="participationsTable" class="min-w-full text-xs sm:text-sm md:text-base text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase border-b bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    N°
                </th>
                <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Titre
                </th>
                <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Catégorie
                </th>
                <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Emplacement
                </th>
                <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Date debut
                </th>
                <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Date fin
                </th>
                <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Nombre de jours
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activitespAll as $i => $item)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td scope="col" class="px-6 py-3">
                        {{ $i + 1 }}
                    </td>
                    <td scope="col" class="px-6 py-3 hover:underline">
                        <a href="{{ route('activites.show', $item->id) }}">{{ $item->title }}</a>
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $item->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->location }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->start_date }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->end_date }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($item->start_date)->diffInDays(\Carbon\Carbon::parse($item->end_date)) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


