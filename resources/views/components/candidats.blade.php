@props(['event', 'candidats'])

<table class="w-full text-xs display cell-border border-collapse border stripe bg-white" id="tableau" style="width:100%;">
    <thead>
        <tr>
            <th class="p-2 text-start bg-slate-800 text-slate-50">N°</th>
            <th class="p-2 text-start bg-slate-800 text-slate-50">Date</th> 
            <th class="p-2 text-start bg-slate-800 text-slate-50">Nom</th>
            <th class="p-2 text-start bg-slate-800 text-slate-50">Genre</th>
            <th class="p-2 text-start bg-slate-800 text-slate-50">Email</th>
            <th class="p-2 text-start bg-slate-800 text-slate-50">Âge</th>
            <th class="p-2 text-start bg-slate-800 text-slate-50">Profession</th>
            <th class="p-2 text-start bg-slate-800 text-slate-50">Détail</th>
            
            <th class="p-2 text-start bg-slate-800 text-slate-50">Picture</th>
            <th class="p-2 text-start bg-slate-800 text-slate-50">Status</th>
            
            <th class="p-2 text-start bg-slate-800 text-slate-50">Action</th>
        </tr>
    </thead>

    <tbody>

    @foreach ($candidats as $i=>$item)
    @php
        $dateNaissance = new DateTime($item->odcuser->birthDay);  
        $aujourdhui = new DateTime();  
        $age = $aujourdhui->diff($dateNaissance);  
        $birthday = $age->y; // retourne l'âge en années  

        $temps = null;
        $date = new DateTime(); 
        $profession = json_decode($item->odcuser->profession);

        if($item->odcuser->detailProfession)
        {
            $detailProfession = json_decode($item->odcuser->detailProfession);
            $detail ="";
            if(!empty($detailProfession->company)) {
                $detail = $detailProfession->company;
            }
            if(!empty($detailProfession->university)) {
                $detail = $detailProfession->university;
            }

        }
        else {
            $detail = null;
        }

        @endphp 
        <tr class="border" id="tr{{$item->id}}">
            <td>{{$i+1}}</td>
            <td>{{ $item->createdAt }}</td>
            <td>{{ $item->odcuser->firstName }} {{ $item->odcuser->lastName }}</td>
            <td>{{ $item->odcuser->gender }}</td>
            <td>{{ $item->odcuser->email }}</td>
            <td>{{ $birthday }}</td>
            <td>{{ ($item->odcuser->profession)?$profession->translations->fr->profession:null}}</td>
            <td>{{ $detail }}</td>
            <td>@if (!empty($item->odcuser->picture))
                <a href="{{$item->odcuser->picture}}" target="_bank">
                    <svg style="width: 30px;" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M853.333333 874.666667H170.666667c-46.933333 0-85.333333-38.4-85.333334-85.333334V234.666667c0-46.933333 38.4-85.333333 85.333334-85.333334h682.666666c46.933333 0 85.333333 38.4 85.333334 85.333334v554.666666c0 46.933333-38.4 85.333333-85.333334 85.333334z" fill="#F57C00"></path><path d="M746.666667 341.333333m-64 0a64 64 0 1 0 128 0 64 64 0 1 0-128 0Z" fill="#FFF9C4"></path><path d="M426.666667 341.333333L192 682.666667h469.333333z" fill="#942A09"></path><path d="M661.333333 469.333333l-170.666666 213.333334h341.333333z" fill="#BF360C"></path></g></svg>
                </a> 
                @endif
            </td>
            <td>{{ $item->status }}</td>
        
            <td>
                <div class="tdAction" style="position:relative !important;">
 
                    <button id="dropdownMenuIconButton{{$item->id}}" data-dropdown-toggles="dropdownDots{{$item->id}}" class="btn-menu inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                        </svg>
                    </button>
                
                    <!-- Dropdown menu -->
                    <div id="dropdownDots{{$item->id}}" style="position:absolute;top:40px;right:-50px;" class="bk-dropdown z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                            
                            <li>
                                <a href="{{ route('odcusers.show', $item->odcuser->id)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Voir</a>
                            </li>
                            <li>
                                <a style="cursor: pointer;" data-modal-target="form-modal" data-modal-toggle="form-modal" onclick="form_event({{ $item->id}})" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Formulaire</a>
                            </li>
                            <li>
                                <a style="cursor: pointer;" onclick="status_candidat({{ $item->id}}, '{{ $item->status}}')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Changer Status</a>
                            </li>
                            
                        </ul>
                        <div class="py-2">
                            <a href="{{$item->_id}}" onclick="supprimer(event);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Desactiver</a>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody> 
</table>




<button type="button" data-modal-target="crypto-modal" data-modal-toggle="crypto-modal" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
    <svg aria-hidden="true" class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
    Connect wallet
    </button>
    
    <!-- Main modal -->
    <div id="status-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Changer le status
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="status-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    
                    <ul class="my-4 space-y-3">
                        <li>
                            <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <input id="default-radio-1" type="radio"  name="status" value="new" class="radio_status w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="flex-1 ms-3 whitespace-nowrap">New</span>
                                
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <input id="default-radio-1" type="radio" name="status" value="accepted" class="radio_status w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="flex-1 ms-3 whitespace-nowrap">Accept</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <input id="default-radio-1" type="radio" name="status" value="declined" class="radio_status w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="flex-1 ms-3 whitespace-nowrap">Decline</span>
                            </a>
                        </li>
                         
                    </ul>
                    <input type="hidden" id="id_status">
                    <div>
                        <button type="button" onclick="change_status(event)" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Changer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    