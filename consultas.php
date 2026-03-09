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

	public function listarProductoID($id){
		$sentencia="SELECT * FROM juegos where id_juego = :id";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id"=> $id
		]);
		$registros=$ejecucion->fetch(PDO::FETCH_ASSOC);
		return $registros;

	}

	public function listarCategorias(){
		$sentencia="SELECT * FROM categorias";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}


	public function listarProductos(){
		$sentencia = "SELECT juegos.*, juego_categoria.id_categoria
                  FROM juegos
                  LEFT JOIN juego_categoria
                  ON juegos.id_juego = juego_categoria.id_juego";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}
}
?>