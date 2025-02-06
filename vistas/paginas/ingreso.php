<h2>Iniciar sesión</h2>
<div>
	<form class="" method="post">

		<div class="">

			<label for="email">Correo electrónico:</label>
			<input type="email" class="" id="emailIngreso" name="ingresoEmail">
			

			<label for="pwd">Contraseña:</label>
			<input type="password" class="" id="pwdIngreso" name="ingresoPassword">

			</div>

	

		<?php 

		$ingreso = new ControladorFormularios();
		$ingreso -> ctrIngreso();

		?>
		
		<button type="submit" class="">Ingresar</button>
	</div>
	</form>

</div>
