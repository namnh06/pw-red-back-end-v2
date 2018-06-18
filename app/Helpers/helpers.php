<?php

 function response_success($data= [], $msg='', $status = 200) {
    return response([
        'statusText' => 'OK',
        'data' => $data,
        'message' => $msg
    ],$status);
 }

function response_error($data= [],  $msg='',$status = 400) {
    return response([
        'statusText' => 'ERROR',
        'data' => $data,
        'message' => $msg
    ],$status);
}