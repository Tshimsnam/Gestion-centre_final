@props(['event', 'participants', 'nbj'])
@php
    $ts = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
@endphp
<form action="{{ route('presences.store')}}" method="post">

    @csrf
    <input type="hidden" name="event" value="{{$event->id}}">
    <table class="w-full text-xs display cell-border border-collapse border stripe bg-white" id="tableau3" style="width:100%;">
        <thead>
            <tr>
                <th class="p-2 text-start bg-slate-800 text-slate-50">N°</th>
                <th class="p-2 text-start bg-slate-800 text-slate-50">Nom</th>
                <th class="p-2 text-start bg-slate-800 text-slate-50">Genre</th>
                <th class="p-2 text-start bg-slate-800 text-slate-50">Email</th>
                @php
                  $tdates = [];
                @endphp
                @for ($i = 0; $i < $nbj; $i++)
                @php 
                    
                    $date = null;
                    $date = date_create($event->startDate);  
                    date_add($date,date_interval_create_from_date_string($i." days"));
                    $ladate =  date_format($date,"d/m/Y");
                    $ladate2 =  date_format($date,"Y-m-d");

                    $tdates[] = $ladate2;
                @endphp
                <th class="p-2 text-start bg-slate-800 text-slate-50">
                    {{$ts[date('w', strtotime($ladate2))];}} ({{ $ladate }}) 
                </th>   
                @endfor
            </tr>
        </thead>

        <tbody>

        @foreach ($participants as $i=>$item)
        @php
            

            @endphp 
            <tr class="border" id="tr{{$item->id}}">
                <td class="p-2">{{$i+1}}</td> 
                <td>{{ $item->odcuser->firstName }} {{ $item->odcuser->lastName }}</td>
                <td>{{ $item->odcuser->gender }}</td>
                <td>{{ $item->odcuser->email }}</td>
                @for ($i = 0; $i < $nbj; $i++)
                <td class="text-center">
                    @php
                        $presence = $item->presences()->where(DB::raw('DATE(date_enter)'), $tdates[$i])->first();
                    @endphp
                    @if ($presence)
                        <input type="hidden" name="id_presence[]" value="{{ $presence->id }}">
                        <input type="checkbox" name="presences[{{$i}}][]" value="{{ $item->id }}" id="" checked>
                    @else
                        <input type="checkbox" name="presences[{{$i}}][]" value="{{ $item->id }}" id="">
                    @endif
                    
                
                </td>   
                @endfor
            </tr>
        @endforeach
        </tbody> 
    </table>

    <p><button type="submit" class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Valider</button></p>
</form>

    


    
    