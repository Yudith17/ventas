<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <script>
      const base_url='<?php echo BASE_URL;?>';
    </script>
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg" style="background-color:rgb(217, 171, 221) ">
            <div class="container-fluid row d-block">
                <div class="col-12 row">
                    <a class="navbar-brand col-2" href="#">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLec-cz5LHdEGGmOQfmrY-z3TmxAM6PaeEcg&s" alt="Bootstrap" width="50" height="35">
                      </a>
                    <form class="d-flex col-5" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <div class="row justify-content-end">
                      <div class="col-auto">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGTy6B8GY5_eJcrADDXfpvcFuZvflum5DGbA&s" style="width: 30px;" alt="" class="profile-pic">
                      </div>
                      <div class="col-auto ">
                        <a href="<?php echo BASE_URL?> detalle_carrito">
                          <img src="https://static.vecteezy.com/system/resources/previews/015/018/215/non_2x/shopping-cart-icon-cartoon-style-vector.jpg" style="width: 30px;" alt="carrito.html">
                        </a>                         
                      </div>
                      <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                        style="width: 30px; margin-left: 1400px; margin-top: -30px;">

                          <img src="https://cdn-icons-png.flaticon.com/512/6073/6073873.png " style="width: 30px;" alt="Profile Picture" class="profile-pic">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink row justify-content-end" style="width: 30px; margin-left: 1350px;">
                          <a class="dropdown-item" href="<?php echo BASE_URL?>login">Iniciar Sesión </a>
                          <a class="dropdown-item" href="<?php echo BASE_URL?>usuario ">Usuario </a>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-12 d-flex">
                    <a class="navbar-brand" href="<?php echo BASE_URL?>inicio">Inicio</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Mujer
                              </a>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>conjuntom">Conjuntos</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>polom"> Polos</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>pantalonm">Pantalones </a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>abrigom">Abrigos </a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>vestidom">Vestidos </a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>faldam">Faldas </a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>topsm">Tops</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>sudaderasm">>Sudaderas </a></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hombre
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo BASE_URL?>conjuntoh"> Conjuntos</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASE_URL?>poloh"> Polos</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASE_URL?>pantalonh"> Pantalones</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASE_URL?>abrigoh"> Abrigos</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASE_URL?>chortsh">Chorts </a></li>
                                  </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Niños
                              </a>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>conjunton">Conjuntos niñ@s de 2 a 10 años</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>polon">Polos de niñ@s de 2 a 10 años </a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>pantalonn">>Pantalones niñ@s de 2 a 10 años </a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>abrigosn">Abrigos de niñ@s de 2 a 10 años</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL?>vestidosn">Vestidos niñas de 2 a 10 años</a></li>
                              </ul>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL?>nosotros">Nosotros</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL?>contacto">Contacto</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL?>detallecarrito">Descripcion</a>
                          </li>
                          <li class="nav1"><a onclick ="cerrar_sesion();" > cerrar sesion</a> </li>
                          <li class="nav1"><a> <i class= "fa fa-user"></i> cerrar sesion</a> </li>
                         
                      </ul>
                    </div>
                </div>
            </div>
        </nav>
        </div>