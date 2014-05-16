<?php

function check_session(){
	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION['user'])) return "No hay usuario conectado";
	if($_SESSION['user']['tipo'] != 2) return "No tienes permisos";
	return "";
}

?>