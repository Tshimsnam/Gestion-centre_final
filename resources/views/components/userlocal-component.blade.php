@props(['activites'])
<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md md:max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-black">
            <!-- Modal header -->
            <div class="flex items-center bg-odcolor justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Nouvel utilisateur
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal">
                    <svg class=" w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            @if (session('error'))
                <div id="alert-2"
                    class="flex items-center mt-10 p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Alert</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('error') }}
                    </div>

                </div>
            @endif

            <div class="mx-auto">
                <form class="p-4 mx-auto md:p-5" action="{{ route('userlocal') }}" method="POST">
                    @csrf
                    <div class="grid gap-5 mb-4 grid-cols-2">
                        <div class="col-span-2 flex items-center space-x-4">
                            <label for="first_name"
                                class="block mb-2 text-sm w-52 font-medium text-gray-900 dark:text-white">Prénom</label>
                            <input type="text" name="first_name" id="first_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-72 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Prénom" required>
                        </div>
                        <div class="col-span-2 flex items-center space-x-4">
                            <label for="last_name"
                                class="block mb-2 text-sm w-52 font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" name="last_name" id="last_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-72 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Nom" required>
                        </div>
                        <div class="col-span-2 flex items-center space-x-4">
                            <label for="gender"
                                class="block mb-2 text-sm w-52 font-medium text-left text-gray-900 dark:text-white">
                                Genre
                            </label>
                            <select id="gender" name="gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-72 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="">Choisir une option</option>
                                <option value="male">Homme</option>
                                <option value="female">Femme</option>
                            </select>
                        </div>
                        <div class="col-span-2 flex items-center space-x-4">
                            <label for="email"
                                class="block mb-2 text-sm w-52 font-medium text-gray-900 dark:text-white">
                                Adresse mail (facultatif)
                            </label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-72 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="nom@exemple.com">
                        </div>
                        <div class="col-span-2 flex items-center space-x-4">
                            <label for="phone"
                                class="block mb-2 text-sm w-52 font-medium text-gray-900 dark:text-white">Numéro de téléphone (obligatoire)</label>
                            <input type="text" name="phone" id="phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-72 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Téléphone" required>
                        </div>
                        <div class="col-span-2 flex items-center space-x-4">
                            <label for="activite"
                                class="block mb-2 text-sm w-52 font-medium text-gray-900 dark:text-white">Activité</label>
                            <select id="activite" name="activite"
                                class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-72 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($activites as $item)
                                    <option class="w-72 h-48" value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class=" flex justify-end mt-4 mb-4">

                        <button type="submit"
                            class="col-span-2 w-52 text-center space-x-2 mx-auto text-white inline-flex items-center bg-odcolor hover:bg-odcolor/75 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-5 py-2.5 dark:bg-orange-500 dark:hover:bg-orange-400 dark:focus:ring-wite-800">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white space-x-4" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span>Enregistrer</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
    @if (session()->has('error'))
        <script>
            setTimeout(function() {
                $('.alert-danger').fadeOut();
            }, 30000);
        </script>
    @endif
@endsection
