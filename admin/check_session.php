<?php

session_start();

if(!isset($_SESSION['user'])){
	http_response_code(404);
}
if($_SESSION['user']['tipo'] != 2 ){
	http_response_code(404);
}

?>