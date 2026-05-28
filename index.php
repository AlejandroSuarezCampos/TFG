<?php
include_once("cabecera.php");
$listaProductosVendidos = $db->listarProductosVendidos();
$categorias = $db->listarCategorias();
?>

<div class="container-fluid">
  <div class="row">
    <main class="col-12 p-4">

      <!-- ===================== HERO ===================== -->
      <section class="hero-section mb-5">
        <div class="hero-content">
          <p class="hero-tag">Acceso instantáneo</p>
          <h1 class="hero-title">Alquila videojuegos<br><span>sin pagar el precio completo.</span></h1>
          <p class="hero-sub">Accede a tus juegos favoritos por horas. Sin compromisos, sin suscripciones.</p>
          <a href="buscador.php" class="btn btn-steam btn-lg">Explorar catálogo</a>
        </div>
        <div class="hero-stats">
          <div class="hero-stat">
            <span class="hero-stat-num">20+</span>
            <span class="hero-stat-label">Juegos</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-num">24/7</span>
            <span class="hero-stat-label">Disponible</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-num">1€</span>
            <span class="hero-stat-label">Desde / hora</span>
          </div>
        </div>
      </section>

      <!-- ===================== CÓMO FUNCIONA ===================== -->
      <section class="mb-5">
        <h3 class="section-heading mb-4">¿Cómo funciona?</h3>
        <div class="row g-3 text-center">
          <div class="col-6 col-md-3">
            <div class="card game-card h-100 p-3">
              <div class="steps-icon mb-2">🔍</div>
              <h6 class="text-white mb-1">1. Elige tu juego</h6>
              <p class="small mb-0 text-white">Explora el catálogo y encuentra lo que quieres jugar.</p>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="card game-card h-100 p-3">
              <div class="steps-icon mb-2">⏱️</div>
              <h6 class="text-white mb-1">2. Selecciona las horas</h6>
              <p class="small mb-0 text-white">Elige cuántas horas necesitas. Sin mínimos ni permanencias.</p>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="card game-card h-100 p-3">
              <div class="steps-icon mb-2">💳</div>
              <h6 class="text-white mb-1">3. Paga solo lo que usas</h6>
              <p class="small mb-0 text-white">Precio justo por hora. Sin suscripciones ni sorpresas.</p>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="card game-card h-100 p-3">
              <div class="steps-icon mb-2">🎮</div>
              <h6 class="text-white mb-1">4. ¡A jugar!</h6>
              <p class="small mb-0 text-white">Acceso instantáneo. Descarga y empieza en minutos.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- ===================== DESTACADOS ===================== -->
      <?php if (!empty($listaProductosVendidos)):
        $primero = $listaProductosVendidos[0];
        $resto   = array_slice($listaProductosVendidos, 1, 4);
      ?>
      <section class="mb-5">
        <h3 class="section-heading mb-4">Destacados</h3>
        <div class="row g-3">

          <!-- Tarjeta grande -->
          <div class="col-12 col-md-6 col-lg-5">
            <a href="producto.php?id=<?= $primero['id_juego'] ?>" class="text-decoration-none">
              <div class="card game-card featured-card h-100"
                   style="background-image: url('<?= htmlspecialchars($primero['imagen']) ?>')">
                <div class="featured-overlay">
                  <span class="featured-badge">⭐ Destacado</span>
                  <h4 class="featured-title"><?= htmlspecialchars($primero['titulo']) ?></h4>
                  <span class="price fs-5">
                    <?= $primero['precio_alquiler'] ?>€
                    <small class="text-secondary fw-normal">/hora</small>
                  </span>
                </div>
              </div>
            </a>
          </div>

          <!-- Lista lateral -->
          <div class="col-12 col-md-6 col-lg-7">
            <div class="d-flex flex-column gap-2 h-100">
              <?php foreach ($resto as $p): ?>
              <a href="producto.php?id=<?= $p['id_juego'] ?>" class="text-decoration-none">
                <div class="card game-card side-item">
                  <img src="<?= htmlspecialchars($p['imagen']) ?>"
                       alt="<?= htmlspecialchars($p['titulo']) ?>"
                       class="side-item-img">
                  <div class="card-body py-2">
                    <h6 class="card-title mb-1"><?= htmlspecialchars($p['titulo']) ?></h6>
                  </div>
                  <div class="side-item-price pe-3">
                    <span class="price"><?= $p['precio_alquiler'] ?>€</span>
                    <small class="text-secondary">/h</small>
                  </div>
                </div>
              </a>
              <?php endforeach; ?>
            </div>
          </div>

        </div>
      </section>
      <?php endif; ?>

      <!-- ===================== BANNER FORO ===================== -->
      <section class="mb-4">
        <div class="hero-section banner-cta">
          <div class="hero-content">
            <h4 class="text-white mb-2 fw-bold">¿Tienes dudas?</h4>
            <p class="hero-sub mb-0">Visita nuestro foro y pregunta a la comunidad.</p>
          </div>
          <a href="foro.php" class="btn btn-outline-steam btn-lg flex-shrink-0">Ir al foro</a>
        </div>
      </section>

    </main>
  </div>
</div>
<?php if (isset($_GET['cuentaBorrada'])): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Cuenta eliminada',
        text: 'Tu cuenta ha sido eliminada correctamente.',
        customClass: { popup: 'steam-popup' }
    });
</script>
<?php endif; ?>
<?php include_once("pie.php"); ?>