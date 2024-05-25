<?php

include "../../Session/User.php";
use \App\Session\User as SessionUser;

SessionUser::init();

$client_id = 'a67a5d11-bddf-48cf-bc64-dbd5f96470e5';
$client_secret = 'yEA8Q~-QA3sqgd.FFkaC0r1V6mXGn.uNSvl4ycU5';
$redirect_uri = 'http://localhost/Comunidade-Anima/app/APIs/Login_Microsoft/callback.php';

// Verifique se o state recebido é o mesmo que foi enviado
if (!isset($_GET['state']) || !isset($_SESSION['oauth2state']) || $_GET['state'] !== $_SESSION['oauth2state']) {
    unset($_SESSION['oauth2state']);
    die('State mismatch');
}

// Verifique se foi recebido o código de autorização
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Trocar o código de autorização por um token de acesso
    $token_url = 'https://login.microsoftonline.com/common/oauth2/v2.0/token';
    $token_params = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $code,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    ];

    $curl = curl_init($token_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($token_params));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($http_code >= 200 && $http_code < 300) {
        $token_response = json_decode($response, true);
        if (isset($token_response['access_token'])) {
            $access_token = $token_response['access_token'];

            // Solicitar informações do perfil do usuário
            $user_info_url = 'https://graph.microsoft.com/v1.0/me';
            $headers = [
                'Authorization: Bearer ' . $access_token
            ];

            $curl = curl_init($user_info_url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $user_info_response = curl_exec($curl);
            $user_info_http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($user_info_http_code >= 200 && $user_info_http_code < 300) {
                $user_info = json_decode($user_info_response, true);
                $_SESSION['user_info'] = $user_info;

                // Armazenar informações do usuário em variáveis
                $user_name = $user_info['displayName'];
                $user_email = $user_info['mail'] ?? $user_info['userPrincipalName'];
                $user_id = $user_info['id'];

                // armazenar as informações na Sessão do usuário
                SessionUser::login($user_info['mail']);
                SessionUser::setDados($user_info['mail'],$user_info['displayName']);
                header('Location: ../../../public/index.php');

            } else {
                die('Failed to get user info: ' . $user_info_response);
            }
        } else {
            die('Failed to get access token: ' . $response);
        }
    } else {
        die('Failed to get access token: ' . $response);
    }
} else {
    die('No authorization code received');
}
?>
