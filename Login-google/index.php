<?php 
    // ID : 903940557014-hm740l3n2kdcos450dngthgo4qne8n9h.apps.googleusercontent.com
    // KEY : 8Ma1qF8z0fZ3Uk8oxcA4ropU
    session_start();
    require('vendor/autoload.php');

    $gClient = new Google_Client();
    
    $gClient->setClientId("903940557014-hm740l3n2kdcos450dngthgo4qne8n9h.apps.googleusercontent.com");
    $gClient->setClientSecret("8Ma1qF8z0fZ3Uk8oxcA4ropU");

    $gClient->setRedirectUri('http://localhost/CursoDanki-Back-End/Projetos/WebService%20e%20API/Login-google/index.php');

    $gClient->addScope('email');

    if(!isset($_GET['code'])){
        // Precisamos logar
        echo '<a href="'.$gClient->createAuthUrl().'">Logar com sua conta do google!</a>';
    }else{
        $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);

        if(!isset($token['error'])){
            $gClient->setAccessToken($token['access_token']);

            $_SESSION['access_token'] = $token['access_token'];

            $google_service = new Google_Service_Oauth2($gClient);

            $data = $google_service->userinfo->get();

            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
    }
?>

