<?php

class Tienda{

	private $pdo;

	public function __construct($host,$port,$db,$user,$pass){

		$this->pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$user,$pass);
	}

	//Función para listar los 4 productos más vendidos
    public function listarProductosVendidos(){
		$sentencia="SELECT * FROM juegos ORDER BY ventas DESC LIMIT 4";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}

	//Función para listar los productos por id
	public function listarProductoID($id){
		$sentencia="SELECT * FROM juegos where id_juego = :id";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id"=> $id
		]);
		$registros=$ejecucion->fetch(PDO::FETCH_ASSOC);
		return $registros;

	}

	//Función para listar todas las categorias
	public function listarCategorias(){
		$sentencia="SELECT * FROM categorias";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	//Función para listar todos los productos
	public function listarProductos(){
		$sentencia="SELECT * FROM juegos";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	//Función que muestra todos los productos de una categoría
	public function listarProductosFiltradosCategoria($id){
		$sentencia="SELECT juegos.* FROM juegos LEFT JOIN juego_categoria ON juegos.id_juego = juego_categoria.id_juego WHERE juego_categoria.id_categoria=:id";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id"=> $id
		]);
		$registros=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}

	//Función para buscar un juego por su título, conteniendo el texto solo una parte del título (zu->Inazuma)
	public function buscarJuego($texto){
		$texto="%".$texto."%";
		$sql="SELECT * FROM juegos WHERE titulo LIKE :texto";
		$sentencia = $this->pdo->prepare($sql);
		$sentencia->execute(array(
			":texto" => $texto
		));
		return $sentencia;
	}

	public function comprobarEmailExiste($email){
		$sentencia = "SELECT COUNT(*) as total FROM usuarios WHERE email = :email";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":email"=>$email
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		
		return $resultado['total'] > 0;
	}

	public function registrarUsuario($nombre, $email, $pass){
		$sentencia="INSERT INTO usuarios(nombre,email,password) VALUES (:nombre,:email,:password)";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":nombre" => $nombre,
				":email" => $email,
				":password" => password_hash($pass,PASSWORD_DEFAULT)
			)
		);
	}

	public function obtenerUsuarioPorEmail($correo) {
    $sentencia="SELECT id_usuario, nombre, email,id_rol, password FROM usuarios WHERE email = :email";
    $ejecucion=$this->pdo->prepare($sentencia);
    $ejecucion->execute(
        array(
            ":email" => $correo
        )
    );
    return $ejecucion->fetch(PDO::FETCH_ASSOC);
}
public function comprobarCatExiste($nombre){
    $sentencia = "SELECT COUNT(*) as total FROM categorias WHERE nombre = :nombre";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":nombre"=>$nombre
    ]);
    $resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
    
    return $resultado['total'] > 0;
}

public function crearCat($nombre){
    $sentencia="INSERT INTO categorias(nombre) VALUES (:nombre)";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":nombre"=>$nombre
    ]);
}

public function listarUsuarios(){
		$sentencia="SELECT * FROM usuarios";
		$ejecucion= $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}

public function modificarCat($modificar,$nombre){
		$sentencia="UPDATE categorias SET nombre=:nombre WHERE id_categoria=:id_cat";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":nombre" => $nombre,
                ":id_cat"=> $modificar
			)
		);
	}

	public function comprobarCatExistePorID($id){
    $sentencia = "SELECT COUNT(*) as total FROM categorias WHERE id_categoria = :id_Cat";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_Cat"=>$id
    ]);
    $resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
    
    return $resultado['total'] > 0;
}

public function eliminarCat($id){
		$sentencia="DELETE FROM categorias where id_categoria=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":id" => $id
			)
		);
	}


public function comprobarUsuExistePorID($id){
	$sentencia = "SELECT COUNT(*) as total FROM usuarios WHERE id_usuario = :id_usu";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_usu"=>$id
    ]);
    $resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
    
    return $resultado['total'] > 0;
}

public function eliminarUsu($id){
		$sentencia="DELETE FROM usuarios where id_usuario = :id_usu";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":id_usu" => $id
			)
		);
	}

	public function modificarUsu($modificar,$nombre,$email,$contraseña){
		$sentencia="UPDATE usuarios SET nombre=:nombre,email=:email,password=:pass WHERE id_usuario=:id_usu";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":nombre" => $nombre,
				":email"=>$email,
				":pass"=>$contraseña,
                ":id_usu"=> $modificar
			)
		);
	}
}
?>