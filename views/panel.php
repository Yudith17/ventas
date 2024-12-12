<style>
/* Estilo general del cuerpo */
body {
    background-color: #ffeaf4; /* Fondo rosa claro */
    font-family: 'Poppins', sans-serif;
    color: #4a4a4a; /* Gris oscuro para el texto */
    margin: 0;
    padding: 0;
}

/* Título principal */
h1 {
    color: #d63384; /* Rosa fuerte */
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
}

/* Estilo de las tarjetas */
.card {
    border-radius: 15px;
    background-color: #fff5f8; /* Fondo blanco con toque rosa */
    border: none;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

/* Encabezado de las tarjetas */
.card-header {
    background-color: #ffc1e3; /* Rosa pastel */
    color: #d63384; /* Rosa fuerte */
    font-weight: 600;
    text-align: center;
    border-bottom: none;
    border-radius: 15px 15px 0 0;
    padding: 10px;
}

/* Imágenes dentro de las tarjetas */
.card-img-top {
    border-radius: 15px 15px 0 0;
    height: 180px;
    object-fit: cover;
}

/* Cuerpo de las tarjetas */
.card-body {
    padding: 15px;
}

.card-body a {
    display: block;
    text-decoration: none;
    margin: 10px 0;
    padding: 10px 15px;
    color: #d63384; /* Rosa fuerte */
    font-weight: 600;
    background-color: #ffe0f0; /* Fondo rosa claro */
    border-radius: 10px;
    text-align: center;
    transition: background-color 0.3s, transform 0.3s;
}

.card-body a:hover {
    background-color: #ffb3c7; /* Rosa pastel más oscuro */
    transform: scale(1.05);
}

/* Iconos dentro de los enlaces */
.icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-size: 16px;
}

.icon-wrapper i {
    font-size: 20px;
    color: #d63384; /* Color del ícono */
}

/* Estilo del pie de página */
footer {
    background-color: #ffeaf4;
    color: #d63384;
    text-align: center;
    padding: 15px 0;
    font-size: 14px;
    border-top: 1px solid #ffc1e3;
}

/* Ajustes responsivos */
@media (max-width: 768px) {
    .card {
        margin-bottom: 20px;
    }

    .card-body a {
        font-size: 14px;
    }
}

.card-img-top {
    border-radius: 50%; /* Hacerla circular */
    width: 120px; /* Ancho de la imagen */
    height: 120px; /* Altura de la imagen */
    object-fit: cover; /* Asegurar que mantenga proporciones */
    margin: 15px auto; /* Centrar la imagen */
    display: block; /* Asegurar que se centre correctamente */
}
</style>
<div class="admin-container">
    <h1 class="text-center mt-5">Panel de Administración</h1>
    <div class="container-fluid">
        <div class="row">
            <!-- Usuario Panel -->
            <div class="col-md-4">
                <div class="card mb-3 dis-pe">
                    <img src="https://img.freepik.com/vector-premium/icono-circulo-usuario-anonimo-ilustracion-vector-estilo-plano-sombra_520826-1931.jpg" class="card-img-top" alt="Usuario">
                    <div class="card-header">Usuario</div>
                    <div class="card-body">
                        <a href="<?php BASE_URL;?>registrar-persona">
                            <div class="icon-wrapper">
                                <i class="fa fa-user-plus"></i> Registrar Usuario
                            </div>
                        </a>
                        <a href="<?php BASE_URL;?>personas">
                            <div class="icon-wrapper">
                                <i class="fas fa-users"></i> Ver usuarios
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Productos Panel -->
            <div class="col-md-4">
                <div class="card mb-3 dis-pe">
                    <img src="https://cdn-icons-png.flaticon.com/512/1554/1554591.png" class="card-img-top" alt="Productos">
                    <div class="card-header">Productos</div>
                    <div class="card-body">
                        <a href="<?php BASE_URL;?>nuevo-producto">
                            <div class="icon-wrapper">
                                <i class="fa fa-plus-circle"></i> Registrar Producto
                            </div>
                        </a>
                        <a href="<?php BASE_URL;?>productos">
                            <div class="icon-wrapper">
                                <i class="fas fa-boxes"></i> Ver Productos
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Categorias Panel -->
            <div class="col-md-4">
                <div class="card mb-3 dis-pe">
                    <img src="https://www.shutterstock.com/image-vector/inverted-pyramid-divided-into-3-600nw-2507694031.jpg" class="card-img-top" alt="Categorías">
                    <div class="card-header">Categorías</div>
                    <div class="card-body">
                        <a href="<?php BASE_URL;?>registrar-categoria">
                            <div class="icon-wrapper">
                                <i class="fa fa-tags"></i> Registrar Categoría
                            </div>
                        </a>
                        <a href="<?php BASE_URL;?>categorias">
                            <div class="icon-wrapper">
                                <i class="fas fa-list-alt"></i> Ver Categorías
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Compras Panel -->
            <div class="col-md-4">
                <div class="card mb-3 dis-pe">
                    <img src="https://www.shutterstock.com/image-vector/colored-cartoon-couple-doing-shopping-600nw-2318330175.jpg" class="card-img-top" alt="Compras">
                    <div class="card-header">Compras</div>
                    <div class="card-body">
                        <a href="<?php BASE_URL;?>registrar-compras">
                            <div class="icon-wrapper">
                                <i class="fa fa-shopping-cart"></i> Registrar Compra
                            </div>
                        </a>
                        <a href="<?php BASE_URL;?>compra">
                            <div class="icon-wrapper">
                                <i class="fas fa-receipt"></i> Ver Compras
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Placeholder for footer -->
<footer>
    <!-- Your existing footer code -->
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
