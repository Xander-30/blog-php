<?php

class Conexion{

	static public function conectar(){


		$link = new PDO("mysql:host=127.0.0.1:33065;dbname=blog-php","root","alex");

		$link->exec("set names utf8");

		return $link;

	}


}