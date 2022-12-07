<h1 class="nombre-pagina">Recuperar Cuenta</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email</p>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<form action="/olvide" method="POST" class="formulario">
    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Email">
    </div>
    <input type="submit" class="boton" value="Enviar Instrucciones">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Crear Cuenta</a>
</div>