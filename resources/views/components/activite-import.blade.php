@props(['activite'])

<div class="flex justify-center space-x-4">
    <div>
        <form action="{{ route('export') }}" method="POST">
            @csrf
            <input type="hidden" name="activite" value="{{ $activite->id }}">
            <div>
                <button type="submit" class="py-2 px-3 mr-2 mt-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 text-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/>
                    </svg>
                    Télécharger le Modèle
                </button>
            </div>
        </form>
    </div>

    <div>
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto mt-4 flex">
            @csrf
            <input type="hidden" name="activite" value="{{ $activite->id }}">
            <div class="mb-1">
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="fileHelp" id="file" type="file" accept=".csv" name="file" placeholder="*CSV file" required>
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300 text-center" id="fileHelp">N'importez que des fichiers CSV dans ce champ.</div>
            </div>
            <div class="ml-2">
                <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none text-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/>
                    </svg>
                    Importer votre CSV
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Messages d'erreur ou de succès -->
<div id="message" class="mt-4 text-center">
    @if(session('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="text-red-600">{{ session('error') }}</div>
    @endif
</div>
