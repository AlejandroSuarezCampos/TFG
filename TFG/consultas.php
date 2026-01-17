<?php

class Tienda{

	private $pdo;

	public function __construct($host,$port,$db,$user,$pass){

		$this->pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$user,$pass);
	}

    public function listarProductosVendidos(){
		$sentencia="SELECT * FROM juegos ORDER BY ventas DESC LIMIT 4";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}
}
?>