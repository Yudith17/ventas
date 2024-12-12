<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script >
        const base_url='<?php echo BASE_URL;?>';
    </script>
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo img {
            max-width: 100%;
            height: auto;
        }
        .info-icon {
            cursor: pointer;
        }
        .social-login {
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="logo text-center mb-4">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLec-cz5LHdEGGmOQfmrY-z3TmxAM6PaeEcg&s" alt="Logo">
            </div>
            <h2 class="text-center mb-4">Inicio de sesión</h2>
            <form id="frm_iniciar_sesion">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                    
                </div>
                <button type="submit" class="btn btn-secondary btn-block create-account mt-3">Iniciar Sesión</button>
                
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL;?>views/js/functions_login.js"></script>
</body>
</html>

