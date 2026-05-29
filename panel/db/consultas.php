<?php

class Tienda
{

	private $pdo;

	public function __construct($host, $port, $db, $user, $pass)
	{
		$this->pdo = new PDO("mysql:host=" . $host . ";port=" . $port . ";dbname=" . $db, $user, $pass);
	}

	// Obtiene los 4 juegos con más ventas
	public function listarProductosVendidos()
	{
		$sentencia = "SELECT * FROM juegos ORDER BY ventas DESC LIMIT 4";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	// Obtiene un juego concreto por su id_juego
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

	// Devuelve todos los juegos para mostrarlos en el panel de administración
	public function listarJuegosPanel()
	{
		$sentencia = "SELECT * FROM juegos";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	// Devuelve los nombres de las categorías asociadas a un juego concreto mediante doble JOIN
	public function listarProductosFiltradosCategoria($id)
	{
		$sentencia = "SELECT NOMBRE FROM CATEGORIAS C JOIN juego_categoria JC ON C.id_categoria=JC.id_categoria JOIN juegos J ON JC.id_juego=J.id_juego where J.id_juego=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;
	}

	// Comprueba si existe un juego con ese id y devuelve su título
	public function existeJuegoId($id)
	{
		$sentencia = "SELECT titulo FROM JUEGOS WHERE id_juego=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
		$registros = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $registros;
	}

	// Elimina un juego por su id
	public function eliminarJuego($id)
	{
		$sentencia = "DELETE FROM JUEGOS WHERE id_juego=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
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

	// Devuelve todos los datos de un juego por su id
	public function getJuego($id)
	{
		$sentencia = "SELECT * FROM juegos WHERE id_juego = :id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(array(
			":id" => $id
		));
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado;
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
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":nombre" => $nombre,
				":email" => $email,
				":password" => password_hash($pass, PASSWORD_DEFAULT),
				":foto" => "/img/foto_usu.png"
			)
		);
	}

	// Devuelve los datos del usuario que coincide con el email dado (usado para el login)
	public function obtenerUsuarioPorEmail($correo)
	{
		$sentencia = "SELECT id_usuario, nombre, email,id_rol, password FROM usuarios WHERE email = :email";
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

	// Devuelve el nombre de una categoría buscándola por su id (usado antes de editar)
	public function BuscarCat($id)
	{
		$sentencia = "SELECT nombre FROM categorias WHERE id_categoria = :id_Cat";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id_Cat" => $id
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado;
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

	// Comprueba si existe un usuario con ese id
	public function comprobarUsuExistePorID($id)
	{
		$sentencia = "SELECT COUNT(*) as total FROM usuarios WHERE id_usuario = :id_usu";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id_usu" => $id
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado['total'] > 0;
	}

	// Devuelve el nombre y email de un usuario por su id (usado antes de editar)
	public function BuscarUsuario($id)
	{
		$sentencia = "SELECT nombre , email FROM usuarios WHERE id_usuario = :id_usu";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id_usu" => $id
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado;
	}

	// Elimina un usuario por su id
	public function eliminarUsu($id)
	{
		$sentencia = "DELETE FROM usuarios where id_usuario = :id_usu";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":id_usu" => $id
			)
		);
	}

	// Actualiza nombre y email del usuario; si se recibe contraseña también la actualiza hasheada
	public function modificarUsu($modificar, $nombre, $email, $contraseña)
	{
		if ($contraseña !== "") {
			$sentencia = "UPDATE usuarios SET nombre=:nombre,email=:email,password=:pass WHERE id_usuario=:id_usu";
			$ejecucion = $this->pdo->prepare($sentencia);
			$ejecucion->execute(
				array(
					":nombre" => $nombre,
					":email" => $email,
					":pass" => password_hash($contraseña, PASSWORD_DEFAULT),
					":id_usu" => $modificar
				)
			);
		} else {
			$sentencia = "UPDATE usuarios SET nombre=:nombre,email=:email WHERE id_usuario=:id_usu";
			$ejecucion = $this->pdo->prepare($sentencia);
			$ejecucion->execute(
				array(
					":nombre" => $nombre,
					":email" => $email,
					":id_usu" => $modificar
				)
			);
		}
	}

	// Comprueba si ya existe un juego con ese título (sin distinguir mayúsculas)
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

	// Comprueba si ya existe otro juego con ese título excluyendo el propio id (usado al editar)
	public function comprobarJuegoExisteEditar($titulo, $id)
	{
		$sentencia = "SELECT COUNT(*) as total FROM juegos WHERE LOWER(titulo) = LOWER(:titulo) and id_juego!=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":titulo" => $titulo,
			":id" => $id
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado['total'] > 0;
	}

	// Inserta un nuevo juego con todos sus campos
	public function registrarJuego($titulo, $descripcion, $precio, $imagen, $ventas, $stock)
	{
		$sentencia = "INSERT INTO juegos(titulo,descripcion,precio_alquiler,imagen,ventas,stock) VALUES (:titulo,:descripcion,:precio,:imagen,:ventas,:stock)";
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

	// Actualiza todos los campos de un juego existente por su id
	public function editarJuego($id, $titulo, $descripcion, $precio, $rutaBD, $ventas, $stock)
	{
		$sentencia = "UPDATE juegos SET titulo=:titulo, descripcion=:descripcion, precio_alquiler=:precio, imagen=:imagen,ventas=:ventas, stock=:stock WHERE id_juego=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":titulo" => $titulo,
				":descripcion" => $descripcion,
				":precio" => $precio,
				":imagen" => $rutaBD,
				":ventas" => $ventas,
				":stock" => $stock,
				":id" => $id
			)
		);
	}

	// Devuelve todos los ítems del carrito de un usuario
	public function obtenerCarritoUsuario($id)
	{
		$sentencia = "SELECT * FROM carrito_item where id_usuario=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(array(
			":id" => $id
		));
		$resultado = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}

	// Devuelve todos los pedidos con el email del usuario, el fichero de factura, el total y el número de ítems
	public function listarPedidos()
	{
		$sentencia = "SELECT p.motivo_reembolso,p.fecha_reembolso,p.estado,p.id_pedido,p.id_usuario,u.email AS email,r.nombre_fichero AS fichero,SUM(pi.precio * pi.duracion) AS total,COUNT(pi.id_item) as totales FROM pedido_item pi inner join pedido p on p.id_pedido=pi.id_pedido inner join usuarios u on u.id_usuario=p.id_usuario
		inner join recibos r on r.id_pedido=p.id_pedido
		GROUP BY p.id_pedido, p.id_usuario,u.email,r.nombre_fichero ORDER BY p.id_pedido DESC";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		$resultado = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}

	// Marca el pedido como reembolsado y su recibo también, luego restaura el stock; usa transacción para garantizar consistencia
	function reembolsarPedido($id, $motivo)
	{
		$this->pdo->beginTransaction();

		try {
			$sentencia = "UPDATE pedido SET estado = 'reembolsado',
            fecha_reembolso = NOW(), motivo_reembolso = :motivo WHERE id_pedido = :id AND estado = 'pagado'";
			$ejecucion = $this->pdo->prepare($sentencia);
			$ejecucion->execute([
				":id" => $id,
				":motivo" => $motivo
			]);
			if ($ejecucion->rowCount() > 0) {
				$sqlRecibo = "UPDATE recibos 
                          SET estado = 'reembolsado'
                          WHERE id_pedido = :id";

				$stmtRecibo = $this->pdo->prepare($sqlRecibo);
				$stmtRecibo->execute([
					":id" => $id
				]);
				$this->EstablecerStock($id);
			}

			$this->pdo->commit();

		} catch (Exception $e) {
			$this->pdo->rollBack();
			throw $e;
		}
	}

	// Obtiene los juegos de un pedido y aumenta su stock en 1 y reduce sus ventas en 1 (usado al reembolsar)
	function EstablecerStock($id)
	{
		$sentencia = "SELECT id_juego
        FROM pedido_item 
        WHERE id_pedido = :id";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);

		$items = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		foreach ($items as $item) {

			$sqlStock = "UPDATE juegos 
                 SET stock = stock + 1,ventas=ventas-1
                 WHERE id_juego = :id_juego";

			$ejecucion = $this->pdo->prepare($sqlStock);
			$ejecucion->execute([
				":id_juego" => $item['id_juego']
			]);
		}
	}

	// Devuelve el email y nombre del usuario asociado a un pedido (usado para enviar correo de reembolso)
	function GetEmail($id)
	{
		$sentencia = "SELECT u.email,u.nombre from usuarios u inner join pedido p on u.id_usuario=p.id_usuario where p.id_pedido=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado;
	}

	// Devuelve todos los tickets de soporte con el nombre del usuario que los creó, ordenados por fecha descendente
	public function listarTickets()
	{
		$sentencia = "SELECT t.*, u.nombre 
                  FROM tickets t
                  JOIN usuarios u ON t.id_usuario = u.id_usuario
                  ORDER BY t.fecha DESC";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}

	// Marca un ticket como cerrado por su id
	public function cerrarTicket($id_ticket)
	{
		$sentencia = "UPDATE tickets SET estado = 'cerrado' WHERE id_ticket = :id_ticket";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([":id_ticket" => $id_ticket]);
	}

	// Devuelve todos los temas del foro
	public function listarTemas()
	{
		$sentencia = "SELECT * FROM temas";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}

	// Elimina un tema del foro por su id
	public function eliminarTema($id)
	{
		$sentencia = "DELETE FROM temas WHERE id_tema=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
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

	// Devuelve el título de un tema por su id (usado antes de editar)
	public function BuscarTema($modificar)
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

	// Comprueba si un pedido ya tiene alquileres generados (es decir, si ya fue canjeado)
	public function pedidoYacanjeado($id)
	{
		$sentencia = "SELECT COUNT(*) as numero from alquileres where id_pedido=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":id" => $id
			)
		);
		$resultado = $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado["numero"];
	}
}
?>