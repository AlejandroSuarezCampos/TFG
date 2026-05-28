<?php

class Tienda
{

	private $pdo;

	public function __construct($host, $port, $db, $user, $pass)
	{
		$this->pdo = new PDO("mysql:host=" . $host . ";port=" . $port . ";dbname=" . $db, $user, $pass);
	}

	//Función para listar los 4 productos más vendidos
	public function listarProductosVendidos()
	{
		$sentencia = "SELECT * FROM juegos ORDER BY ventas DESC LIMIT 5";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}

	//Función para listar los productos por id
	public function listarProductoID($id)
	{
		$sentencia = "SELECT * FROM juegos where id_juego = :id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
		$registros = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $registros;

	}

	//Función para listar todas las categorias
	public function listarCategorias()
	{
		$sentencia = "SELECT * FROM categorias";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	//Función para listar todos los productos
	public function listarProductos()
	{
		$sentencia = "SELECT * FROM juegos";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	//Función que muestra todos los productos de una categoría
	public function listarProductosFiltradosCategoria($id)
	{
		$sentencia = "SELECT juegos.* FROM juegos LEFT JOIN juego_categoria ON juegos.id_juego = juego_categoria.id_juego WHERE juego_categoria.id_categoria=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}

	//Función para buscar un juego por su título, conteniendo el texto solo una parte del título (zu->Inazuma)
	public function buscarJuego($texto)
	{
		$texto = "%" . $texto . "%";
		$sql = "SELECT * FROM juegos WHERE titulo LIKE :texto";
		$sentencia = $this->pdo->prepare($sql);
		$sentencia->execute(array(
			":texto" => $texto
		));
		return $sentencia;
	}

	public function comprobarEmailExiste($email)
	{
		$sentencia = "SELECT COUNT(*) as total FROM usuarios WHERE email = :email";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":email" => $email
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);

		return $resultado['total'] > 0;
	}

	public function registrarUsuario($nombre, $email, $pass)
	{
		$sentencia = "INSERT INTO usuarios(nombre,email,password,foto) VALUES (:nombre,:email,:password,:foto)";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":nombre" => $nombre,
				":email" => $email,
				":password" => password_hash($pass, PASSWORD_DEFAULT),
				":foto" => "./img/foto_usu.png"
			)
		);
	}

	public function obtenerUsuarioPorEmail($correo)
	{
		$sentencia = "SELECT id_usuario, nombre, email,id_rol, password,foto FROM usuarios WHERE email = :email";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":email" => $correo
			)
		);
		return $ejecucion->fetch(PDO::FETCH_ASSOC);
	}
	public function comprobarCatExiste($nombre)
	{
		$sentencia = "SELECT COUNT(*) as total FROM categorias WHERE nombre = :nombre";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":nombre" => $nombre
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);

		return $resultado['total'] > 0;
	}

	public function crearCat($nombre)
	{
		$sentencia = "INSERT INTO categorias(nombre) VALUES (:nombre)";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":nombre" => $nombre
		]);
	}

	public function listarUsuarios()
	{
		$sentencia = "SELECT * FROM usuarios";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}

	public function modificarCat($modificar, $nombre)
	{
		$sentencia = "UPDATE categorias SET nombre=:nombre WHERE id_categoria=:id_cat";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":nombre" => $nombre,
				":id_cat" => $modificar
			)
		);
	}

	public function comprobarCatExistePorID($id)
	{
		$sentencia = "SELECT COUNT(*) as total FROM categorias WHERE id_categoria = :id_Cat";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id_Cat" => $id
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);

		return $resultado['total'] > 0;
	}

	public function eliminarCat($id)
	{
		$sentencia = "DELETE FROM categorias where id_categoria=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":id" => $id
			)
		);
	}



	//Funciones para el manejo del carrito
	public function listarjuegoscarrito($carrito)
	{
		$juegos = [];
		foreach ($carrito as $id => $horas) {
			$sentencia = "SELECT * FROM juegos WHERE id_juego=:id";
			$ejecucion = $this->pdo->prepare($sentencia);
			$ejecucion->execute(
				array(
					":id" => $id
				)
			);
			$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
			if ($resultado) {
				$resultado["horas"] = $horas;
				$juegos[] = $resultado;
			}
		}
		return $juegos;
	}

	public function comprobarJuegoExiste($titulo)
	{
		$sentencia = "SELECT COUNT(*) as total FROM juegos WHERE LOWER(titulo) = LOWER(:titulo)";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":titulo" => $titulo
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);

		return $resultado['total'] > 0;
	}
	public function registrarJuego($titulo, $descripcion, $precio, $imagen, $ventas, $stock)
	{
		$sentencia = "INSERT INTO jeugos(titulo,descripcion,precio_alquiler,imagen,ventas,stock) VALUES (:titulo,:descripcion,:precio,:imagen,:ventas,:stock)";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":titulo" => $titulo,
				":descripcion" => $descripcion,
				":precio" => $precio,
				":imagen" => $imagen,
				":ventas" => $ventas,
				":stock" => $stock
			)
		);
	}
	public function obtenerPrecio($id)
	{
		$sentencia = "SELECT precio_alquiler FROM juegos WHERE id_juego=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);

		return $resultado["precio_alquiler"];
	}
	public function obtenerCarritoUsuario($id)
	{
		$sentencia = "SELECT * FROM carrito_item where id_usuario=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(array(
			":id" => $id
		));
		$data = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		$carrito = [];
		foreach ($data as $item) {
			$carrito[$item["id_juego"]] = (int) $item["duracion"];
		}
		return $carrito;
	}
	public function guardarCarritoUsuario($id_usuario, $carrito)
	{

		$sentencia1 = "INSERT INTO carrito_item (id_usuario, id_juego, duracion, precio) VALUES (:id_usuario, :id_juego, :duracion, :precio)
        ON DUPLICATE KEY UPDATE
            duracion = VALUES(duracion),
            precio = VALUES(precio)";

		$ejecucion1 = $this->pdo->prepare($sentencia1);

		foreach ($carrito as $id_juego => $horas) {
			$sentencia = "SELECT precio_alquiler FROM juegos WHERE id_juego = :id";
			$ejecucion = $this->pdo->prepare($sentencia);
			$ejecucion->execute(array(
				":id" => $id_juego
			));
			$precio = $ejecucion->fetchColumn();
			$precioTotal = $precio * $horas;
			$ejecucion1->execute([
				":id_usuario" => $id_usuario,
				":id_juego" => $id_juego,
				":duracion" => $horas,
				"precio" => $precioTotal
			]);
		}

		return true;
	}
	public function actualizarHorasCarrito($usuarioId, $juegoId, $horas)
	{

		$sentencia = "UPDATE carrito_item SET duracion = :horas,precio=:precio WHERE id_usuario = :usuario AND id_juego = :id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$precio = $this->obtenerPrecio($juegoId) * $horas;
		$ejecucion->execute([
			":id" => $juegoId,
			":usuario" => $usuarioId,
			":horas" => $horas,
			":precio" => $precio

		]);
	}

	public function eliminarJuegoCarrito($usuarioId, $juegoId)
	{

		$sentencia = "DELETE from carrito_item WHERE id_usuario = :usuario AND id_juego = :id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $juegoId,
			":usuario" => $usuarioId
		]);
	}
	public function obtenerdato($id, $invoker)
	{
		if ($invoker == 0) {
			$sentencia = "SELECT email as resultado FROM usuarios WHERE id_usuario=:id";
		} else {
			$sentencia = "SELECT nombre as resultado FROM usuarios WHERE id_usuario=:id";
		}
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);

		return $resultado["resultado"];
	}
	public function crearForo($nombre, $descripcion)
	{
		$sentencia = "INSERT INTO foros (nombre, descripcion) 
					VALUES (:nombre, :descripcion)";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":nombre" => $nombre,
			":descripcion" => $descripcion
		]);
	}
	public function listarForos()
	{
		$sentencia = "SELECT id_foro, nombre FROM foros";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}

	public function listarTemas()
{
    $sentencia = "SELECT t.id_tema, t.titulo, t.id_foro, t.fecha_creacion, f.nombre AS nombre_foro
                  FROM temas t
                  JOIN foros f ON t.id_foro = f.id_foro
                  ORDER BY t.fecha_creacion DESC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute();

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}
	public function crearTema($idUser, $titulo, $foro)
	{
		$sentencia = "INSERT INTO temas 
					(titulo, id_usuario, id_foro, fecha_creacion)
					VALUES
					(:titulo, :idUser, :foro, NOW())";

		$ejecucion = $this->pdo->prepare($sentencia);

		$ejecucion->execute([
			":titulo" => $titulo,
			":idUser" => $idUser,
			":foro" => $foro
		]);
	}

public function crearTicket($idUser, $asunto)
{
    $sentencia = "INSERT INTO tickets 
                (id_usuario, asunto)
                VALUES
                (:idUser, :asunto)";

    $ejecucion = $this->pdo->prepare($sentencia);

    $ejecucion->execute([
        ":idUser" => $idUser,
        ":asunto" => $asunto
    ]);
}
public function listarTicketsUsuario($idUser)
{
    $sentencia = "SELECT * FROM tickets 
                  WHERE id_usuario = :idUser 
                  ORDER BY fecha DESC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([":idUser" => $idUser]);

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}
	public function obtenerMensajes($id_tema)
	{
		$sentencia = "SELECT m.id_respuesta, m.contenido, m.fecha_respuesta, u.nombre, u.foto
					FROM respuestas m
					INNER JOIN usuarios u ON u.id_usuario = m.id_usuario
					WHERE m.id_tema = :id
					ORDER BY m.fecha_respuesta DESC";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id_tema
		]);

		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}
public function obtenerTicket($id_ticket)
{
    $sentencia = "SELECT t.*, u.nombre 
                  FROM tickets t
                  JOIN usuarios u ON t.id_usuario = u.id_usuario
                  WHERE t.id_ticket = :id";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([":id" => $id_ticket]);

    return $ejecucion->fetch(PDO::FETCH_ASSOC);
}
public function obtenerMensajesTicket($id_ticket)
{
    $sentencia = "SELECT m.id_ticket, m.id_usuario, m.mensaje, m.fecha, u.nombre, u.foto
                FROM msgticket m
                INNER JOIN usuarios u ON u.id_usuario = m.id_usuario
                WHERE m.id_ticket = :id
                ORDER BY m.fecha ASC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id" => $id_ticket
    ]);

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

	public function crearMensaje($id_tema, $id_usuario, $contenido)
	{
		$sentencia = "INSERT INTO respuestas (contenido, id_tema, id_usuario, fecha_respuesta)
					VALUES (:contenido, :id_tema, :id_usuario, NOW())";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":contenido" => $contenido,
			":id_tema" => $id_tema,
			":id_usuario" => $id_usuario
		]);
	}

public function crearMensajeTicket($id_usuario, $id_ticket, $mensaje)
{
    $sentencia = "INSERT INTO msgticket (id_usuario, id_ticket, mensaje, fecha)
                  VALUES (:id_usuario, :id_ticket, :mensaje, NOW())";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_usuario" => $id_usuario,
        ":id_ticket"  => $id_ticket,
        ":mensaje"    => $mensaje
    ]);
}
	public function obtenerTema($id_tema)
{
    $sentencia = "SELECT t.id_tema, t.titulo, t.id_foro, t.fecha_creacion, t.id_usuario, u.nombre
                FROM temas t
                INNER JOIN usuarios u ON u.id_usuario = t.id_usuario
                WHERE t.id_tema = :id";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id" => $id_tema
    ]);

    return $ejecucion->fetch(PDO::FETCH_ASSOC);
}
	public function insertarpedido($id_usuario)
	{

		$sentencia = "INSERT INTO pedido (id_usuario, fecha, metodo_pago) VALUES (:id, NOW(),1)";

		$ejecucion = $this->pdo->prepare($sentencia);

		$ejecucion->execute([
			":id" => $id_usuario
		]);
		return $this->pdo->lastInsertId();
	}
	public function insertarpedidoitem($id_pedido, $id_juego, $duracion, $precio, $codigo)
	{

		$sentencia = "INSERT INTO pedido_item (id_pedido, id_juego, duracion, precio,codigo) VALUES (:pedido, :juego, :duracion, :precio,:codigo)";

		$ejecucion = $this->pdo->prepare($sentencia);

		$ejecucion->execute([
			":pedido" => $id_pedido,
			":juego" => $id_juego,
			":duracion" => $duracion,
			"precio" => $precio,
			":codigo" => $codigo
		]);
		$sentencia = "UPDATE juegos SET stock = stock - 1,ventas = ventas + 1 WHERE id_juego=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id_juego
		]);
	}
	public function reciboExiste($stripe_session_id)
	{
		$sentencia = "SELECT id_recibo FROM recibos WHERE stripe_session_id = :session LIMIT 1";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([":session" => $stripe_session_id]);

		return $ejecucion->fetch(PDO::FETCH_ASSOC);
	}
	public function insertarpdf($id_usuario, $numero_factura, $nombre_fichero, $estado, $stripe_session_id, $id_pedido)
	{
		$sentencia = "INSERT INTO recibos 
            (id_usuario, numero_factura, nombre_fichero, estado, stripe_session_id, fecha_emision, id_pedido)
            VALUES 
            (:id_usuario, :numero_factura, :nombre_fichero, :estado, :stripe_session_id, NOW(), :id_pedido)";

		$ejecucion = $this->pdo->prepare($sentencia);

		$ejecucion->execute([
			":id_usuario" => $id_usuario,
			":numero_factura" => $numero_factura,
			":nombre_fichero" => $nombre_fichero,
			":estado" => $estado,
			":stripe_session_id" => $stripe_session_id,
			":id_pedido" => $id_pedido
		]);
	}
	public function eliminarcarrito($id_usuario)
	{
		$sentencia = "DELETE FROM carrito_item WHERE id_usuario = :id_usuario";

		$ejecucion = $this->pdo->prepare($sentencia);

		return $ejecucion->execute([
			":id_usuario" => $id_usuario
		]);
	}
	public function getPedidosUsuario($id_usuario)
	{
		$sentencia = "SELECT p.id_pedido, p.fecha, p.metodo_pago,
                   r.numero_factura, r.nombre_fichero, r.estado
            FROM pedido p
            LEFT JOIN recibos r ON p.id_pedido = r.id_pedido
            WHERE p.id_usuario = :id_usuario
            ORDER BY p.fecha DESC";

		$ejecucion = $this->pdo->prepare($sentencia);

		$ejecucion->execute([
			":id_usuario" => $id_usuario
		]);

		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getItemsPedido($id_pedido)
	{
		$sentencia = "SELECT pi.*, j.titulo, j.imagen
            FROM pedido_item pi
            JOIN juegos j ON pi.id_juego = j.id_juego
            WHERE pi.id_pedido = :id_pedido";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([":id_pedido" => $id_pedido]);

		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}
	public function pedidoPerteneceUsuario($id_pedido, $id_usuario)
	{
		$sentencia = "SELECT 1 FROM pedido WHERE id_pedido = :id AND id_usuario = :user";

		$ejecucion = $this->pdo->prepare($sentencia);

		$ejecucion->execute([
			":id" => $id_pedido,
			":user" => $id_usuario
		]);

		return $ejecucion->fetch() !== false;
	}
	public function reciboPerteneceUsuario($id_pedido, $id_usuario)
	{
		$sentencia = "SELECT nombre_fichero 
        FROM recibos 
        WHERE id_pedido = :id AND id_usuario = :user";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id_pedido,
			":user" => $id_usuario
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado['nombre_fichero'];
	}

	public function generarCodigoFactura($longitud = 16)
	{
		$time = microtime(true);
		$random = bin2hex(random_bytes(8));

		$base = $time . $random;

		$hash = hash('sha256', $base);
		$hash = strtoupper($hash);

		$hash = preg_replace('/[^A-Z0-9]/', '', $hash);

		return substr($hash, 0, $longitud);
	}
	public function TieneStock($id_juego)
	{
		$sentencia = "SELECT stock FROM juegos WHERE id_juego = :id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id_juego
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado['stock'];
	}
	public function borrarCuenta($id)
	{
		$sentencia = "DELETE FROM usuarios WHERE id_usuario = :id";

		$ejecucion = $this->pdo->prepare($sentencia);

		$ejecucion->execute([
			":id" => $id
		]);

		// cerrar sesión
		session_unset();
		session_destroy();

		header("location: index.php?cuenta=borrada");
		exit;
	}

	public function cambiarPassword($id_usuario, $nueva_pass)
	{
		$sentencia = "UPDATE usuarios SET password = :password WHERE id_usuario = :id_usuario";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":password" => password_hash($nueva_pass, PASSWORD_DEFAULT),
			":id_usuario" => $id_usuario
		]);
	}

	public function listarAlquileresPorUsuario($id_usuario)
	{
		$sentencia = "SELECT
			a.id_juego,
			MIN(CASE WHEN a.estado = 'activo' THEN 'activo' ELSE 'expirado' END) AS estado,
			j.titulo,
			j.imagen
		FROM alquileres a
		JOIN juegos j ON a.id_juego = j.id_juego
		WHERE a.id_usuario = :id_usuario
		GROUP BY a.id_juego, j.titulo, j.imagen";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([':id_usuario' => $id_usuario]);
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	public function totalEstadisticasUsuario($id_usuario){
		$sentencia = "SELECT 
						SUM(pi.duracion) AS total_horas,
						COUNT(DISTINCT a.id_juego) AS total_juegos
					FROM alquileres a
					JOIN pedido_item pi ON a.id_pedido_item = pi.id_item
					WHERE a.id_usuario = :id_usuario";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([':id_usuario' => $id_usuario]);
		$registro = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $registro;
	}

	public function activarCodigo($codigo, $id_usuario){
		$sentencia = "SELECT pi.id_item 
					FROM pedido_item pi
					JOIN alquileres a ON a.id_pedido_item = pi.id_item
					WHERE pi.codigo = :codigo 
					AND a.id_usuario = :id_usuario
					LIMIT 1";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([':codigo' => $codigo, ':id_usuario' => $id_usuario]);
		$item = $ejecucion->fetch(PDO::FETCH_ASSOC);

		if (!$item) {
			return ['ok' => false, 'error' => 'Código inválido o ya usado.'];
		}

		$update = "UPDATE pedido_item SET canjeado = 1 WHERE id_item = :id_item";
		$ejecucion = $this->pdo->prepare($update);
		$ejecucion->execute([':id_item' => $item['id_item']]);

		return ['ok' => true];
	}

	public function filtrarJuegos($texto = "", $categoria = "", $precio = ""){
		$condiciones = [];
		$params      = [];

		$join = "";
		if ($categoria !== "") {
			$join = "LEFT JOIN juego_categoria ON juegos.id_juego = juego_categoria.id_juego";
			$condiciones[] = "juego_categoria.id_categoria = :categoria";
			$params[":categoria"] = $categoria;
		}

		if ($texto !== "") {
			$condiciones[] = "juegos.titulo LIKE :texto";
			$params[":texto"] = "%" . $texto . "%";
		}

		if ($precio !== "") {
			$condiciones[] = "juegos.precio_alquiler <= :precio";
			$params[":precio"] = $precio;
		}

		$sql = "SELECT juegos.* FROM juegos " . $join;

		if (!empty($condiciones)) {
			$sql .= " WHERE " . implode(" AND ", $condiciones);
		}

		$sql .= " ORDER BY juegos.titulo ASC";

		$ejecucion = $this->pdo->prepare($sql);
		$ejecucion->execute($params);

		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buscarTema($texto = ""){
		if ($texto === "") {
			return $this->listarTemas();
		}
	
		$sentencia = "SELECT id_tema, titulo, id_foro, fecha_creacion
					FROM temas
					WHERE titulo LIKE :texto
					ORDER BY fecha_creacion ASC";
	
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":texto" => "%" . $texto . "%"
		]);
	
		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}

	public function obtenerLogrosUsuario($id_usuario) {
    $sentencia = "SELECT l.id_logro, l.nombre, l.descripcion, l.foto,
                  IF(ul.id_usuario IS NOT NULL, 1, 0) AS completado
                  FROM logros l
                  LEFT JOIN usuarios_logros ul 
                    ON l.id_logro = ul.id_logro AND ul.id_usuario = :id_usuario";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([':id_usuario' => $id_usuario]);
    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

public function otorgarLogro($id_usuario, $id_logro) {
    $sentencia = "INSERT IGNORE INTO usuarios_logros (id_usuario, id_logro) 
                  VALUES (:id_usuario, :id_logro)";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([':id_usuario' => $id_usuario, ':id_logro' => $id_logro]);
}

public function comprobarLogros($id_usuario) {
    // Logro 2: New begining - primera compra
    $s = $this->pdo->prepare("SELECT COUNT(*) FROM pedido WHERE id_usuario = :id");
    $s->execute([':id' => $id_usuario]);
    if ($s->fetchColumn() >= 1) $this->otorgarLogro($id_usuario, 2);

    // Logro 3: Consumista - gastar 50€
	$s = $this->pdo->prepare("SELECT SUM(pi.precio * pi.duracion) FROM pedido_item pi 
							JOIN pedido p ON pi.id_pedido = p.id_pedido 
							WHERE p.id_usuario = :id");
	$s->execute([':id' => $id_usuario]);
	if ($s->fetchColumn() >= 50) $this->otorgarLogro($id_usuario, 3);

    // Logro 4: Comunidad - primer tema en el foro
    $s = $this->pdo->prepare("SELECT COUNT(*) FROM temas WHERE id_usuario = :id");
    $s->execute([':id' => $id_usuario]);
    if ($s->fetchColumn() >= 1) $this->otorgarLogro($id_usuario, 4);

	// Logro 1: Platino - tener todos los demás logros
	$s = $this->pdo->prepare("SELECT COUNT(*) FROM usuarios_logros 
							WHERE id_usuario = :id");
	$s->execute([':id' => $id_usuario]);
	$total_logros = $s->fetchColumn();
	if ($total_logros >= 3) $this->otorgarLogro($id_usuario, 1); // 3 = total de logros sin contar el platino
}
	public function eliminarTema($id_tema)
{
    $sentencia = "DELETE FROM temas WHERE id_tema = :id_tema";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([":id_tema" => $id_tema]);
}

public function modificarTema($modificar, $titulo)
	{
		$sentencia = "UPDATE temas SET titulo=:titulo WHERE id_tema=:id_tema";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":titulo" => $titulo,
				":id_tema" => $modificar
			)
		);
	}

	public function eliminarMensaje($id_respuesta) {
		$stmt = $this->pdo->prepare("DELETE FROM respuestas WHERE id_respuesta = ?");
		return $stmt->execute([$id_respuesta]);
	}
	function obtenerJuegosRecomendados( $carrito, $limite = 4)
	{
		$idsCarrito = array_keys($carrito);

		if (empty($idsCarrito)) {
			$sql = "
            SELECT j.*
            FROM juegos j
            LEFT JOIN pedido_item pi ON pi.id_juego = j.id_juego
            GROUP BY j.id_juego
            ORDER BY COUNT(pi.id_juego) DESC
            LIMIT $limite
        ";

			$stmt = $this->pdo->query($sql);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		$placeholders = implode(',', array_fill(0, count($idsCarrito), '?'));

		$sql = "
        SELECT j.*
        FROM juegos j
        LEFT JOIN pedido_item pi ON pi.id_juego = j.id_juego
        WHERE j.id_juego NOT IN ($placeholders)
        GROUP BY j.id_juego
        ORDER BY COUNT(pi.id_juego) DESC
        LIMIT $limite
    ";

		$stmt =$this->pdo->prepare($sql);
		$stmt->execute($idsCarrito);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>