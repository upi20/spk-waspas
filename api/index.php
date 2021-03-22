<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

function responseResult($data = [], $code = 500, $boolean = '', $message = '')
{
    $response['response'] = $boolean;
    $response['message'] = $message;
    $response['data'] = $data;
    http_response_code($code);
    echo json_encode($response);
}

if (isset($_GET['api'])) {
    switch ($_GET['api']) {
        case 'kasus':
            include_once 'studi_kasus.php';
            break;

        default:
            # code...
            break;
    }
}
