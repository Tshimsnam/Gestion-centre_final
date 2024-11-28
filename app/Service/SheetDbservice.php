<?php

namespace App\Service;

use Google\Client;
use Google\Service\Sheets;
use Exception;

class SheetDbservice
{
    private $client;
    private $service;
    private $spreadsheetId;

    public function __construct($spreadsheetId)
    {

        $credentialsPath = storage_path('credentials/credentials.json');
        $this->client = new Client();
        $this->client->setApplicationName('Google Sheets API Service');
        $this->client->setScopes(Sheets::SPREADSHEETS_READONLY);
        $this->client->setAuthConfig($credentialsPath);

        // Initialise le service Google Sheets
        $this->service = new Sheets($this->client);
        $this->spreadsheetId = $spreadsheetId;
    }

    /**
     * Récupère les données d'une plage spécifique
     *
     * @param string $range Plage de données dans la feuille (ex: "Sheet1!A1:C10")
     * @return array Les données récupérées
     */
    public function getData($range)
    {
        try {
            $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
            return $response->getValues();
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }
}
