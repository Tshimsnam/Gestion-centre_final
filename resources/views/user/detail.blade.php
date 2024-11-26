<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        @if (session('status'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="text-sm font-medium ms-3">
                    {{ session('status') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 bg-slate-700">
                        Nom
                        d'utilisateur
                    </th>
                    @foreach ($roles as $item)
                        <th scope="col" class="px-6 py-3 bg-slate-700">
                            {{ $item->name }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr
                    class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->name }}
                    </th>
                    @foreach ($roles as $role)
                        <td class="px-6 py-4">
                            @if (in_array($role->name, $user_role))
                                <div class="flex items-center">
                                    @if ($role->name === 'reader')
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" onclick="D2(event)"
                                                data-modal-target="des-role" @checked(true)
                                                data-modal-toggle="des-role" type="checkbox"
                                                class="w-4 h-4 text-yellow-500 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                            <a id="d-{{ $role->name }}"
                                                href="{{ route('desactiver_role', ['role' => $role->name, 'user' => $user->id]) }}"></a>
                                        </div>
                                    @endif
                                    @if ($role->name === 'admin')
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" onclick="D3(event)"
                                                data-modal-target="des-role" @checked(true)
                                                data-modal-toggle="des-role" type="checkbox"
                                                class="w-4 h-4 text-yellow-600 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                            <a id="d-{{ $role->name }}"
                                                href="{{ route('desactiver_role', ['role' => $role->name, 'user' => $user->id]) }}"></a>
                                        </div>
                                    @endif

                                    @if ($role->name === 'superadmin')
                                    <div class="flex items-center">
                                        <input id="checkbox-all-search" onclick="D4(event)"
                                            data-modal-target="des-role" @checked(true)
                                            data-modal-toggle="des-role" type="checkbox"
                                            class="w-4 h-4 text-yellow-600 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        <a id="d-{{ $role->name }}"
                                            href="{{ route('desactiver_role', ['role' => $role->name, 'user' => $user->id]) }}"></a>
                                    </div>
                                @endif
                            @endif
                            @if (!in_array($role->name,$user_role))
                            @if ($role->name === 'reader')
                            <div class="flex items-center">
                                <input id="checkbox-all-search" onclick="Role1(event)" data-modal-target="check-role"  data-modal-toggle="check-role"  type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                <a id="add-{{$role->name}}" href="{{route('assign_role',['role' => $role->name, 'user' => $user->id])}}"></a>
                            </div>
                            @endif
                            @if ($role->name === 'admin')
                            <div class="flex items-center">
                                <input id="checkbox-all-search" onclick="Role3(event)" data-modal-target="check-role"  data-modal-toggle="check-role"  type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                <a id="add-{{$role->name}}" href="{{route('assign_role',['role' => $role->name, 'user' => $user->id])}}"></a>
                            </div>
                            @endif

                            @if ($role->name === 'superadmin')
                            <div class="flex items-center">
                                <input id="checkbox-all-search" onclick="Role4(event)" data-modal-target="check-role"  data-modal-toggle="check-role"  type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                <a id="add-{{$role->name}}" href="{{route('assign_role',['role' => $role->name, 'user' => $user->id])}}"></a>
                            </div>
                            @endif

                    @endif
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>

        @section('modal')
        <x-checkboxAddRole />
        <x-checkboxDesRole />
        @endsection

</x-app-layout>
