<?php

namespace App\Http\Controllers\Api;


use App\Models\Odcuser;
use Illuminate\Http\Request;
use App\Service\SheetDbservice;
use App\Http\Controllers\Controller;

class OdcuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $odcusers = Odcuser::all();

        return response()->json($odcusers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Odcuser $odcuser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Odcuser $odcuser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Odcuser $odcuser)
    {
        //
    }

    public function getSheetUsers(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'spreadsheetId' => 'required|string',
            'range' => 'required|string',
        ]);


        $range = 'Réponses au formulaire 1';

        $sheetService = new SheetDbservice($validated['spreadsheetId']);
        $data = $sheetService->getData( $range);

        return response()->json($data);
    }
}
