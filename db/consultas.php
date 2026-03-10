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
		$sentencia="SELECT * FROM juegos";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	public function listarProductosFiltradosCategoria($id){
		$sentencia="SELECT juegos.* FROM juegos LEFT JOIN juego_categoria ON juegos.id_juego = juego_categoria.id_juego WHERE juego_categoria.id_categoria=:id";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id"=> $id
		]);
		$registros=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}

	public function buscarJuego($texto){
	
		$texto="%".$texto."%";
	
		$sql="SELECT * FROM juegos WHERE titulo LIKE :texto";
		$sentencia = $this->pdo->prepare($sql);
		$sentencia->execute(array(
			":texto" => $texto
		));
		
		return $sentencia;
	
	}
}
?>