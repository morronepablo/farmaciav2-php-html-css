<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | Morrone</title>
	<link rel="icon" href="img/logo.png" type="image/png">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/farmaciav2/Util/css/login.css">
	<link rel="stylesheet" type="text/css" href="/farmaciav2/Util/css/css/all.min.css">
</head>
<body>
	<img class="wave" src="/farmaciav2/Util/img/login/wave.png" alt="">
	<div class="contenedor">
		<div class="img">
			<img src="/farmaciav2/Util/img/login/bg.svg" alt="">
		</div>
		<div class="contenido-login">
			<form id="form-login">
				<img src="/farmaciav2/Util/img/doctor.png" alt="">
				<h2>Morrone</h2>
				<div class="input-div dni">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>DNI</h5>
						<input type="text" name="dni" id="dni" class="input" required>
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Contraseña</h5>
						<input type="password" name="pass" id="pass" class="input" required>
					</div>
				</div>
				<a href="vista/recuperar.php">Recuperar Contraseña</a>
				<a href="">Created Morrone</a>
				<input type="submit" class="btn" value="Iniciar Sesión">
			</form>
		</div>
	</div>
</body>
<!-- jQuery -->
<script src="/farmaciav2/Util/js/jquery.min.js"></script>
<!-- JS -->
<script src="/farmaciav2/Util/js/login.js"></script>
<script src="/farmaciav2/index.js"></script>
</html>