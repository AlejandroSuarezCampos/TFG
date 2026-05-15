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
		$sentencia="INSERT INTO usuarios(nombre,email,password,foto) VALUES (:nombre,:email,:password,:foto)";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":nombre" => $nombre,
				":email" => $email,
				":password" => password_hash($pass,PASSWORD_DEFAULT),
				":foto"=>"/img/foto_usu.png"
			)
		);
	}

	public function obtenerUsuarioPorEmail($correo) {
    $sentencia="SELECT id_usuario, nombre, email,id_rol, password,foto FROM usuarios WHERE email = :email";
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



//Funciones para el manejo del carrito
public function listarjuegoscarrito($carrito){
	$juegos=[];
	foreach ($carrito as $id => $horas) {
		$sentencia = "SELECT * FROM juegos WHERE id_juego=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":id" => $id
			)
		);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		if($resultado){
			$resultado["horas"]=$horas;
			$juegos[]=$resultado;	
		}
	}
	return $juegos;
}

public function comprobarJuegoExiste($titulo){
		$sentencia = "SELECT COUNT(*) as total FROM juegos WHERE LOWER(titulo) = LOWER(:titulo)";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":titulo"=>$titulo
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		
		return $resultado['total']>0;
}
public function registrarJuego($titulo, $descripcion, $precio,$imagen, $ventas, $stock){
		$sentencia="INSERT INTO jeugos(titulo,descripcion,precio_alquiler,imagen,ventas,stock) VALUES (:titulo,:descripcion,:precio,:imagen,:ventas,:stock)";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":titulo" => $titulo,
				":descripcion" => $descripcion,
				":precio" => $precio,
				":imagen"=>$imagen,
				":ventas"=> $ventas,
				":stock"=> $stock
			)
		);
	}
	public function obtenerPrecio($id){
	$sentencia = "SELECT precio_alquiler FROM juegos WHERE id_juego=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id"=>$id
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		
		return $resultado["precio_alquiler"];
}
public function obtenerCarritoUsuario($id){
		$sentencia="SELECT * FROM carrito_item where id_usuario=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
        $ejecucion->execute(array(
			":id"=> $id
		));
	 $data = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
    $carrito = [];
    foreach ($data as $item) {
        $carrito[$item["id_juego"]] = (int)$item["duracion"];
    }
    return $carrito;
}
public function guardarCarritoUsuario($id_usuario, $carrito) {
	
    $sentencia1 = "INSERT INTO carrito_item (id_usuario, id_juego, duracion, precio) VALUES (:id_usuario, :id_juego, :duracion, :precio)
        ON DUPLICATE KEY UPDATE
            duracion = VALUES(duracion),
            precio = VALUES(precio)";

    $ejecucion1 = $this->pdo->prepare($sentencia1);

    foreach ($carrito as $id_juego => $horas) {
        $sentencia ="SELECT precio_alquiler FROM juegos WHERE id_juego = :id";
        $ejecucion = $this->pdo->prepare($sentencia);
        $ejecucion->execute(array(
			":id"=> $id_juego
		));
		$precio=$ejecucion->fetchColumn();
		$precioTotal = $precio * $horas;
        $ejecucion1->execute([
            ":id_usuario" => $id_usuario,
            ":id_juego" => $id_juego,
            ":duracion" => $horas,
			"precio"=> $precioTotal
        ]);
    }

    return true;
}
public function actualizarHorasCarrito($usuarioId, $juegoId, $horas){

    $sentencia= "UPDATE carrito_item SET duracion = :horas WHERE id_usuario = :usuario AND id_juego = :id";
	$ejecucion = $this->pdo->prepare($sentencia);
	$ejecucion->execute([
			":id"=>$juegoId,
			":usuario"=>$usuarioId,
			":horas"=>$horas
		]);
}

public function eliminarJuegoCarrito($usuarioId, $juegoId){

    $sentencia= "DELETE from carrito_item WHERE id_usuario = :usuario AND id_juego = :id";
	$ejecucion = $this->pdo->prepare($sentencia);
	$ejecucion->execute([
			":id"=>$juegoId,
			":usuario"=>$usuarioId
		]);
	}
		public function obtenerdato($id,$invoker){
			if($invoker==0){
				$sentencia = "SELECT email as resultado FROM usuarios WHERE id_usuario=:id";
			}else{
				$sentencia = "SELECT nombre as resultado FROM usuarios WHERE id_usuario=:id";
			}
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id"=>$id
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		
		return $resultado["resultado"];
}
}
?>