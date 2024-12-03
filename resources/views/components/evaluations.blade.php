@props(['event', 'participants', 'nbj', 'criteres'])
@php
    $ts = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
@endphp
<form action="{{ route('evaluations.store')}}" method="post">

    @csrf

    <table class="w-full text-xs display cell-border border-collapse border stripe bg-white" id="tableau3" style="width:100%;">
        <thead>
            <tr>
                <th class="p-2 text-start bg-slate-800 text-slate-50">N°</th>
                <th class="p-2 text-start bg-slate-800 text-slate-50">Nom</th>
                <th class="p-2 text-start bg-slate-800 text-slate-50">Genre</th>
                <th class="p-2 text-start bg-slate-800 text-slate-50">Email</th>
                <th class="p-2 text-start bg-slate-800 text-slate-50">Etablissement</th>

                @foreach ($criteres as $critere)

                <th class="p-2 text-start bg-slate-800 text-slate-50">
                    {{ $critere->designation }}
                </th>
                @endforeach
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

                @foreach ($criteres as $j=>$critere)
                @php
                    $eval = $item->evaluations()->where('critere_id', $critere->id)->where('candidat_id', $item->id)->first();

                @endphp
                @if ($j==0)
                    @if ($eval)
                        <td><input value="{{$eval->etablissement}}" type="text" name="etablissement[{{$item->id}}]" style="width:200px;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block"></td>
                    @else
                        <td><input type="text" name="etablissement[{{$item->id}}]" style="width:200px;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block"></td>
                    @endif
                @endif

                <td class="text-center">

                    @if ($eval)
                        <input type="hidden" name="evaluation_id[]" value="{{ $eval->id }}">
                        <input type="number" value="{{ $eval->cotation }}" min="0" max="{{$critere->ponderation}}" name="cotation[{{$critere->id}}][{{$item->id}}]" style="width:100px;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                    @else
                    <input type="number" value="0" min="0" max="{{$critere->ponderation}}" name="cotation[{{$critere->id}}][{{$item->id}}]" style="width:100px;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                    @endif


                </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    <p><button type="submit" class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Valider</button>
        <a href="" class="mt-5 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Rapport de l'activité</a>
    </p>
</form>
