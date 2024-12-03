<!-- resources/views/sheet_form.blade.php -->
<form method="POST" action="{{ route('getSheetUsers') }}">
    @csrf
    <label for="spreadsheetId">ID de la feuille Google:</label>
    <input type="text" id="spreadsheetId" name="spreadsheetId" required>


    <button type="submit">Obtenir les données</button>
</form>
