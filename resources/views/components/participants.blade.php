@props(['event', 'participants'])

<table class="w-full text-xs display cell-border border-collapse border stripe bg-white" id="tableau2" style="width:100%;">
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
             
            <th class="p-2 text-start bg-slate-800 text-slate-50">Action</th>
        </tr>
    </thead>

    <tbody>

    @foreach ($participants as $i=>$item)
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
        
            <td>
                <div class="tdAction" style="position:relative !important;">
 
                    <button id="dropdownMenuIconButtonp{{$item->id}}" data-dropdown-toggles="dropdownDotsp{{$item->id}}" class="btn-menu inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                        </svg>
                    </button>
                
                    <!-- Dropdown menu -->
                    <div id="dropdownDotsp{{$item->id}}" style="position:absolute;top:40px;right:-50px;" class="bk-dropdown z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                            
                            <li>
                                <a href="{{ route('odcusers.show', $item->odcuser->id)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Voir</a>
                            </li>
                            <li>
                                <a style="cursor: pointer;" data-modal-target="form-modal" data-modal-toggle="form-modal" onclick="form_event({{ $item->id}})" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Formulaire</a>
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

    


    
    