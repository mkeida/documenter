<?php

/**
 * Script, který vrací data o suplování z datového konektoru Bakalářů
 *
 * Datový konektor bakalářů běží na adrese https://bakalari.ssps.cz/if/2/. Pro
 * autorizaci je používán HTTP Basic Auth, který je nutné předávat v každém
 * headeru požadavku. Vzhledem k citlivosti dat v tomto scriptu musí být soubor
 * umístěn v adresáři, který není veřejný.
 *
 * PHP version 7
 * LICENSE: MIT
 *
 * @author   Marek Kejda <Kejda.Marek@outlook.cz>
 * @author   200solutions <Marek.Kejda@200solutions.com>
 * @version  1.0
 */

// Nastaví správný header
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

// Credentials (přístupové údaje k datovému konektoru bakalářů)
$LOGIN = 'TEST';
$PASSWORD = 'xE3788D19B11D';
$AUTH = base64_encode("$LOGIN:$PASSWORD");

// Query parametry (date ve formátu YYYYMMDD)
$date = isset($_GET['date']) ? $_GET['date'] : '';

// Parametry pro funkci file_get_contents
$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => "Authorization: Basic $AUTH\r\nAccept: application/json\r\nContent-type: application/json\r\n"
    ]
]);

// Požádá datový konektor o JSON odpověď
$response = file_get_contents(
    // URL
    "https://bakalari.ssps.cz/if/2/substitutions/public/$date",
    false,
    $context
);

// Vypíše odpověď
echo $response;
