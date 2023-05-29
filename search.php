<?php

require_once 'auth.php';

//Se la sessione è scaduta, esco
if (!checkAuth()) exit;

//Imposto l'header della risposta
header('Content-Type: application/json');

exercise_api();

function exercise_api() {
    //lettura parametro ricerca
    $curl_param = urlencode($_GET["q"]);
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://exerciseapi3.p.rapidapi.com/search/?primaryMuscle=".$curl_param,
        CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_ENCODING => "",
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 30,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => "GET",
	    CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: exerciseapi3.p.rapidapi.com",
		    "X-RapidAPI-Key: c4fa59fe35mshb1ca4c6a25c4f11p180c87jsn7c7489ac8f42"
        ]
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}

?>