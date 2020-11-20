<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./css/login-styles.css" />
  </head>
  <body>
    <form action="./controllers/UserController/loginn" method="post" id="loginn">
      <a href="./">
        <img src="./assets/logo.png" />
      </a>
      <input type="text" name="Login" id="Login" placeholder="Nome de Usuário" />
      <input
        type="password"
        name="Password" 
        id="Password" 
        placeholder="Senha"
        required  
      />

      <?php
        if(isset($_SESSION["msgError"])){
          ?>
          <div>
            <?= $_SESSION["msgError"] ?>
          </div>

          <?php
          unset($_SESSION["msgError"]);
        }
      ?>

      <button type="submit">ENTRAR</button>

      <p>© Todos os direitos reservados à kairos</p>
    </form>
  </body>
</html>