@props(['dates', 'presencesData', 'fullDates'])

<form id="presenceForm" method="POST" action="{{ route('presences.update') }}">
    @csrf
    <div class="py-6 relative overflow-x-auto">
        <table id="candidatpresence"
            class="w-full p-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 cell-border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th
                        class="bg-gray-400 px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Id
                    </th>
                    <th
                        class="bg-gray-400 px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        FirstName
                    </th>
                    <th
                        class="bg-gray-400 px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        LastName
                    </th>

                    @foreach ($dates as $item)
                        <th scope="col"
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($presencesData as $i => $item)
                    <tr id="rowAll" class="bg-white border dark:bg-gray-800 dark:border-gray-700">
                        <td scope="col" class="px-6 py-3 bg-gray-400 text-white text-center">
                            {{ $i + 1 }}
                        </td>
                        <td scope="col" class="px-6 py-3 bg-gray-400 text-white">
                            {{ $item['odcuser']['first_name'] }}
                        </td>
                        <td scope="col" class="px-6 py-3 bg-gray-400 text-white">
                            {{ $item['odcuser']['last_name'] }}
                        </td>
                        @foreach ($fullDates as $i => $date)
                            <td scope="col" class="px-6 py-3 text-center">
                                @if (in_array($date, $item['date']))
                                    <input type="hidden" name="dates[]" value="{{ $date }}">

                                    <input type="checkbox" class="checkbox" name="presences[{{ $item['id'] }}][]"
                                        value="{{ $date }}" checked>
                                @else
                                    <input type="checkbox" class="checkbox" name="presences[{{ $item['id'] }}][]"
                                        value="{{ $date }}">
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach

            </tbody>
        </table>
        <p>
            <button type="submit" id="submitPresenceButton"
                class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Valider
            </button>
        </p>
    </div>
</form>
