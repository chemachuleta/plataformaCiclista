<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar sesion</title>
  </head>
  <body>
    <main>
      <div>
        <div>
          <h1>Plataforma Ciclista</h1>
        </div>
      </div>

      <form method="post" action="/login">
        <label for="email">Correo</label>
        <input id="email" name="email" type="email" autocomplete="email" required />

        <label for="password">Contrasena</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required />

        <button type="submit">Iniciar sesion</button>
      </form>

    </main>
  </body>
</html>
