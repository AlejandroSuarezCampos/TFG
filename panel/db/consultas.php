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
		$sentencia = "SELECT * FROM juegos ORDER BY ventas DESC LIMIT 4";
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
	public function listarJuegosPanel()
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
		$sentencia = "SELECT NOMBRE FROM CATEGORIAS C JOIN juego_categoria JC ON C.id_categoria=JC.id_categoria JOIN juegos J ON JC.id_juego=J.id_juego where J.id_juego=:id;
";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
		$registros = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
		return $registros;

	}

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
	public function eliminarJuego($id)
	{
		$sentencia = "DELETE FROM JUEGOS WHERE id_juego=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
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

	public function modificarUsu($modificar, $nombre, $email, $contraseña)
	{
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

	public function editarJuego($id, $titulo, $descripcion, $precio, $rutaBD, $ventas, $stock)
	{
		$sentencia = "UPDATE juegos SET titulo=:titulo, descripcion=:descripcion, precio_alquiler=:precio, imagen=:imagen,ventas=:ventas, stock=:stock WHERE id_juego=:id ";
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

	public function cerrarTicket($id_ticket)
	{
		$sentencia = "UPDATE tickets SET estado = 'cerrado' WHERE id_ticket = :id_ticket";

		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([":id_ticket" => $id_ticket]);
	}
	public function listarTemas()
	{
		$sentencia = "SELECT * FROM temas";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute();
		return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
	}

	public function eliminarTema($id)
	{
		$sentencia = "DELETE FROM temas WHERE id_tema=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute([
			":id" => $id
		]);
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

	public function pedidoYacanjeado($id)
	{
		$sentencia = "SELECT COUNT(*) as numero from alquileres where id_pedido=:id";
		$ejecucion = $this->pdo->prepare($sentencia);
		$ejecucion->execute(
			array(
				":id"=>$id
			)
		);
		$resultado= $ejecucion->fetch(PDO::FETCH_ASSOC);
		return $resultado["numero"];
	}

}
?>