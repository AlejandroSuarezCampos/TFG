<?php

class Tienda
{

	private $pdo;

	public function __construct($host, $port, $db, $user, $pass)
	{
		$this->pdo = new PDO("mysql:host=" . $host . ";port=" . $port . ";dbname=" . $db, $user, $pass);
	}

	// Obtiene los 5 juegos con más ventas (el comentario original dice 4, pero el LIMIT es 5)
	public function listarProductosVendidos()
	{
		$sentencia = "SELECT * FROM juegos ORDER BY ventas DESC LIMIT 5";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}

	// Obtiene un juego concreto buscando por su id_juego
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

	// Devuelve todas las categorías existentes
	public function listarCategorias()
	{
		$sentencia = "SELECT * FROM categorias";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	// Devuelve todos los juegos sin ningún filtro
	public function listarProductos()
	{
		$sentencia = "SELECT * FROM juegos";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	// Devuelve los juegos que pertenecen a una categoría concreta mediante JOIN
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

	// Busca juegos cuyo título contenga el texto recibido (búsqueda parcial con LIKE)
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

	// Comprueba si ya existe un usuario registrado con ese email
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

	// Inserta un nuevo usuario con la contraseña hasheada y foto por defecto
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

	// Devuelve los datos del usuario que coincide con el email dado (usado para el login)
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

	// Comprueba si ya existe una categoría con ese nombre
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

	// Inserta una nueva categoría con el nombre recibido
	public function crearCat($nombre)
	{
		$sentencia = "INSERT INTO categorias(nombre) VALUES (:nombre)";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":nombre" => $nombre
		]);
	}

	// Devuelve todos los usuarios registrados
	public function listarUsuarios()
	{
		$sentencia = "SELECT * FROM usuarios";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}

	// Actualiza el nombre de una categoría buscándola por su id
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

	// Comprueba si existe una categoría con ese id
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

	// Elimina la categoría con el id indicado
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



	// Para cada id del carrito, obtiene los datos del juego y añade las horas seleccionadas
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

	// Comprueba si ya existe un juego con ese título (comparación sin distinguir mayúsculas)
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

	// Inserta un nuevo juego (nótese el typo en la tabla: "jeugos" en lugar de "juegos")
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

	// Devuelve el precio de alquiler de un juego por su id
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

	// Carga el carrito guardado en base de datos para un usuario, devolviendo [id_juego => duracion]
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

	// Guarda o actualiza cada ítem del carrito en BD, calculando el precio total por juego
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

	// Actualiza la duración y el precio de un juego concreto en el carrito del usuario
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

	// Elimina un juego del carrito de un usuario
	public function eliminarJuegoCarrito($usuarioId, $juegoId)
	{

		$sentencia = "DELETE from carrito_item WHERE id_usuario = :usuario AND id_juego = :id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $juegoId,
			":usuario" => $usuarioId
		]);
	}

	// Devuelve el email (invoker=0) o el nombre (invoker=1) de un usuario por su id
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

	// Inserta un nuevo foro con nombre y descripción
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

	// Devuelve el id y nombre de todos los foros
	public function listarForos()
	{
		$sentencia = "SELECT id_foro, nombre FROM foros";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}

	// Devuelve todos los temas con el nombre de su foro, ordenados del más reciente al más antiguo
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

	// Inserta un nuevo tema en el foro indicado asociado al usuario
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

	// Inserta un nuevo ticket de soporte para el usuario con el asunto indicado
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

	// Devuelve todos los tickets de un usuario ordenados por fecha descendente
	public function listarTicketsUsuario($idUser)
	{
		$sentencia = "SELECT * FROM tickets 
                  WHERE id_usuario = :idUser 
                  ORDER BY fecha DESC";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([":idUser" => $idUser]);

		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}

	// Devuelve las respuestas de un tema con el nombre y foto del autor, del más reciente al más antiguo
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

	// Devuelve los datos de un ticket junto con el nombre del usuario que lo creó
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

	// Devuelve los mensajes de un ticket con el nombre y foto del autor, ordenados de más antiguo a más reciente
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

	// Inserta una nueva respuesta en un tema del foro
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

	// Inserta un nuevo mensaje en un ticket de soporte
	public function crearMensajeTicket($id_usuario, $id_ticket, $mensaje)
	{
		$sentencia = "INSERT INTO msgticket (id_usuario, id_ticket, mensaje, fecha)
                  VALUES (:id_usuario, :id_ticket, :mensaje, NOW())";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id_usuario" => $id_usuario,
			":id_ticket" => $id_ticket,
			":mensaje" => $mensaje
		]);
	}

	// Devuelve los datos de un tema junto con el nombre del usuario que lo creó
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

	// Inserta un nuevo pedido para el usuario y devuelve el id generado
	public function insertarpedido($id_usuario)
	{

		$sentencia = "INSERT INTO pedido (id_usuario, fecha, metodo_pago) VALUES (:id, NOW(),1)";

		$ejecucion = $this->pdo->prepare($sentencia);

		$ejecucion->execute([
			":id" => $id_usuario
		]);
		return $this->pdo->lastInsertId();
	}

	// Inserta un ítem en el pedido y reduce el stock y aumenta las ventas del juego en 1
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

	// Comprueba si ya se generó un recibo para una sesión de Stripe concreta
	public function reciboExiste($stripe_session_id)
	{
		$sentencia = "SELECT id_recibo FROM recibos WHERE stripe_session_id = :session LIMIT 1";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([":session" => $stripe_session_id]);

		return $ejecucion->fetch(PDO::FETCH_ASSOC);
	}

	// Inserta un nuevo recibo/factura PDF asociado al pedido y al usuario
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

	// Elimina todos los ítems del carrito de un usuario (tras completar la compra)
	public function eliminarcarrito($id_usuario)
	{
		$sentencia = "DELETE FROM carrito_item WHERE id_usuario = :id_usuario";

		$ejecucion = $this->pdo->prepare($sentencia);

		return $ejecucion->execute([
			":id_usuario" => $id_usuario
		]);
	}

	// Devuelve los pedidos de un usuario con los datos de su factura asociada, del más reciente al más antiguo
	public function getPedidosUsuario($id_usuario)
	{
		$sentencia = "SELECT p.estado,p.id_pedido, p.fecha, p.metodo_pago,
                   r.numero_factura, r.nombre_fichero
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

	// Devuelve los ítems de un pedido junto con el título e imagen de cada juego
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

	// Verifica que un pedido pertenece al usuario indicado
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

	// Devuelve el nombre del fichero PDF de un recibo comprobando que pertenece al usuario
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

	// Genera un código alfanumérico aleatorio en mayúsculas de la longitud indicada (por defecto 16)
	public function generarCodigoFactura($longitud = 16)
	{ 
			return strtoupper(
				substr(bin2hex(random_bytes(32)), 0, $longitud)
			);
		
	}

	// Devuelve el stock disponible de un juego
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

	// Elimina el usuario, destruye la sesión y redirige a la página de cuenta borrada
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

	// Actualiza la contraseña del usuario guardándola hasheada
	public function cambiarPassword($id_usuario, $nueva_pass)
	{
		$sentencia = "UPDATE usuarios SET password = :password WHERE id_usuario = :id_usuario";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":password" => password_hash($nueva_pass, PASSWORD_DEFAULT),
			":id_usuario" => $id_usuario
		]);
	}

	// Devuelve los alquileres de un usuario agrupados por juego, indicando si alguno sigue activo
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

	// Devuelve el total de horas alquiladas y el número de juegos distintos del usuario
	public function totalEstadisticasUsuario($id_usuario)
	{
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

	// Valida un código de activación del usuario y lo marca como canjeado si es correcto
	public function activarCodigo($codigo, $id_usuario)
	{
		$sentencia = "SELECT pi.id_item 
                  FROM pedido_item pi
                  JOIN pedido p ON p.id_pedido = pi.id_pedido
                  WHERE pi.codigo = :codigo 
                  AND p.id_usuario = :id_usuario
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

	// Filtra juegos dinámicamente por texto, categoría y/o precio máximo combinando condiciones
	public function filtrarJuegos($texto = "", $categoria = "", $precio = "")
	{
		$condiciones = [];
		$params = [];

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

	// Busca temas por título; si no hay texto devuelve todos los temas
	public function buscarTema($texto = "")
	{
		if ($texto === "") {
			return $this->listarTemas();
		}

		$sentencia = "SELECT t.id_tema, t.titulo, t.id_foro, t.fecha_creacion, f.nombre AS nombre_foro
                  FROM temas t
                  JOIN foros f ON t.id_foro = f.id_foro
                  WHERE t.titulo LIKE :texto
                  ORDER BY t.fecha_creacion DESC";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":texto" => "%" . $texto . "%"
		]);

		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}

	// Devuelve todos los logros indicando cuáles ha conseguido ya el usuario
	public function obtenerLogrosUsuario($id_usuario)
	{
		$sentencia = "SELECT l.id_logro, l.nombre, l.descripcion, l.foto,
                  IF(ul.id_usuario IS NOT NULL, 1, 0) AS completado
                  FROM logros l
                  LEFT JOIN usuarios_logros ul 
                    ON l.id_logro = ul.id_logro AND ul.id_usuario = :id_usuario";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([':id_usuario' => $id_usuario]);
		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}

	// Otorga un logro al usuario usando INSERT IGNORE para evitar duplicados
	public function otorgarLogro($id_usuario, $id_logro)
	{
		$sentencia = "INSERT IGNORE INTO usuarios_logros (id_usuario, id_logro) 
                  VALUES (:id_usuario, :id_logro)";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([':id_usuario' => $id_usuario, ':id_logro' => $id_logro]);
	}

	// Evalúa las condiciones de cada logro y los otorga automáticamente si se cumplen
	public function comprobarLogros($id_usuario)
	{
		// Logro 2: New begining - primera compra
		$s = $this->pdo->prepare("SELECT COUNT(*) FROM pedido WHERE id_usuario = :id");
		$s->execute([':id' => $id_usuario]);
		if ($s->fetchColumn() >= 1)
			$this->otorgarLogro($id_usuario, 2);

		// Logro 3: Consumista - gastar 50€
		$s = $this->pdo->prepare("SELECT SUM(pi.precio * pi.duracion) FROM pedido_item pi 
							JOIN pedido p ON pi.id_pedido = p.id_pedido 
							WHERE p.id_usuario = :id");
		$s->execute([':id' => $id_usuario]);
		if ($s->fetchColumn() >= 50)
			$this->otorgarLogro($id_usuario, 3);

		// Logro 4: Comunidad - primer tema en el foro
		$s = $this->pdo->prepare("SELECT COUNT(*) FROM temas WHERE id_usuario = :id");
		$s->execute([':id' => $id_usuario]);
		if ($s->fetchColumn() >= 1)
			$this->otorgarLogro($id_usuario, 4);

		// Logro 1: Platino - tener todos los demás logros
		$s = $this->pdo->prepare("SELECT COUNT(*) FROM usuarios_logros 
							WHERE id_usuario = :id");
		$s->execute([':id' => $id_usuario]);
		$total_logros = $s->fetchColumn();
		if ($total_logros >= 3)
			$this->otorgarLogro($id_usuario, 1); // 3 = total de logros sin contar el platino
	}

	// Elimina un tema del foro por su id
	public function eliminarTema($id_tema)
	{
		$sentencia = "DELETE FROM temas WHERE id_tema = :id_tema";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([":id_tema" => $id_tema]);
	}

	// Actualiza el título de un tema del foro
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

	// Devuelve el título de un tema buscándolo por su id (usado antes de editar)
	public function BuscarTemaModificar($modificar)
	{
		$sentencia = "SELECT titulo from temas WHERE id_tema=:id_tema";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":id_tema" => $modificar
			)
		);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado;
	}

	// Elimina una respuesta del foro por su id
	public function eliminarMensaje($id_respuesta)
	{
		$stmt = $this->pdo->prepare("DELETE FROM respuestas WHERE id_respuesta = ?");
		return $stmt->execute([$id_respuesta]);
	}

	// Devuelve los juegos más comprados excluyendo los que ya están en el carrito; si el carrito está vacío muestra los más populares en general
	function obtenerJuegosRecomendados($carrito, $limite = 4)
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

		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($idsCarrito);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>