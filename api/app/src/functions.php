<?php
function setResponse($status, $message) {
    $response = new StdClass();
    $response->status = $status;
    $response->message = $message;
    return json_encode($response);
}