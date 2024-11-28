@props(['event', 'criteres'])

 
    <button type="button" data-modal-target="critere-modal" data-modal-toggle="critere-modal" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
        <svg aria-hidden="true" class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
        Critères d'évaluation
    </button>
    
    <!-- Main modal -->
    <div id="critere-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Critères d'évaluation
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="critere-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    
                    <table class="my-5 w-full text-xs display cell-border border-collapse border stripe bg-white">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Designation</th>
                                <th>Description</th>
                                <th>Pondération</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($criteres as $i=>$item)
                            <tr>
                                <td class="border p-3">{{$i+1}}</td>
                                <td class="border p-3">{{ $item->designation }}</td>
                                <td class="border p-3">{{ $item->content }}</td>
                                <td class="border p-3">{{ $item->ponderation }}</td>
                                <td class="border p-3">
                                    <button type="button" onclick="editer_critere(event, {{$item->id}})" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-xs px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Modifier</button>
                                    <button type="button" onclick="delete_critere(event, {{$item->id}})" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-xs px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Supprimer</button>
                                </td>
                            </tr>    
                            @endforeach
                        </tbody>
                    </table>

                    <hr>

                    <form action="{{ route('criteres.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="critere_id" id="critere_id" value="">
                        <div class="mb-6 mt-5">
                            <label for="designation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Designation</label>
                            <input required type="text" id="designation" name="designation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="mb-6">
                            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Designation</label>
                            <input type="text" id="content" name="content" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="mb-6">
                            <label for="ponderation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Designation</label>
                            <input required type="text" id="ponderation" name="ponderation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    
                    <input type="hidden" id="id_event_c" name="event" value="{{$event->id}}">
                    <div>
                        <button type="submit" id="edit_validate"  class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Valider</button>
                        <button type="button" onclick="cancel_edit()" style="display: none;" id="edit_cancel"  class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Annuler</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        async function delete_critere(event, id) {
            if(confirm('Confirmez cette suppression')) {
                event.target.textContent = "En cours..."
                let rep = await fetch('http://127.0.0.1:8000/api/criteres/'+id, {
                            method:'DELETE',
                            headers:{"Content-Type": "application/json", 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                        }).then(response =>response.json())


                event.target.closest('tr').remove()
            }
        }

        function editer_critere(event, id) {
            const form = document.querySelector('#critere-modal form')
            const tr = event.target.closest('tr')
            const designation = tr.children[1].textContent
            form.designation.value = designation
            const content = tr.children[2].textContent
            form.content.value = content
            const ponderation = tr.children[3].textContent
            form.ponderation.value = ponderation

            critere_id.value = id
            edit_validate.textContent = "Modifier"
            edit_cancel.style.display = "inline-block"
        }

        function cancel_edit() {
            critere_id.value = ""
            edit_validate.textContent = "Valider"
            edit_cancel.style.display = "none"
        }
    </script>
    