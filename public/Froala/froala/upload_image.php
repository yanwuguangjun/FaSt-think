<?php

//require __DIR__ . '/../lib/FroalaEditor.php';
require_once './../lib/FroalaEditor.php';
try {
  $response = FroalaEditor_Image::upload('/uploads/demo/');
  echo stripslashes(json_encode($response));

} catch (Exception $e) {

  echo $e->getMessage();
  http_response_code(404);
}