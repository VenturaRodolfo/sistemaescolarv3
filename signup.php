<?php // Example 26-5: signup.php
   use Illuminate\Database\Capsule\Manager as Capsule;
   require_once "data.php";
   require_once 'header.php';
 

  $error = $apellido = $nombre = $pass = "";
  if (isset($_SESSION['user'])) destroySession();

  if (isset($_POST['user']))
  {
    $nombre = ($_POST['user']);
    $apellido = ($_POST['apellido']);
    $pass = ($_POST['pass']);

    if ($nombre == "" || $apellido == "" || $pass == "")
      $error = 'Not all fields were entered<br><br>';
    else
    {
      $result = Capsule::table('users')->select(['nombre'])->where('nombre', $nombre)->first();

      //$result = Capsule::table('users')->find($nombre);
     // $result = Capsule::table('users')->count();

      //$result = queryMysql("SELECT * FROM users WHERE 'user' ='$nombre' ");
      
      if ($result==$nombre)
        $error = 'That username already exists<br><br>';
      else
      {

        Capsule::table('users')->insert(['nombre' => $nombre, 'apellido' => $apellido, 'contra' => $pass, 'idaccess'=> '2', ]);
        //Capsule::table('materias')->insert(['español'=>'0', 'matematicas'=>'0', 'historia'=>'0' ]); 
        //queryMysql("INSERT INTO users(nombre, apellido, contra, idaccess, español, matematicas, historia) VALUES('$nombre', '$apellido', '$pass', '2', '', '', '')");
        die('<h4>Account created</h4>Please Log in.   <a data-role="button" data-inline="true" data-icon="user"
        data-transition="slide" href="login.php">iniciar sesion</a></div></body></html>');
      }
    }
  }

echo <<<_END
<div class="col-10 offset 1 col-md-10 offset-md-1 mt-1">
      <form method='post' action='signup.php'>$error
      <div data-role='fieldcontain'>
        <label></label>
        Please enter your details to sign up
      </div>
      <div data-role='fieldcontain'>
        <label>Nombre</label>
        <input type='text' class="form-control" maxlength='16' placeholder="Nombre" name='user' value='$nombre'>
      </div>
      <div data-role='fieldcontain'>
        <label>Apellido</label>
        <input type='text' class="form-control" maxlength='16' placeholder="Apellido" name='apellido' value='$apellido'>
      </div>
      <div data-role='fieldcontain'>
        <label>Password</label>
        <input type='password'class="form-control"  maxlength='16' placeholder="Contraseña" name='pass' value='$pass'>
      </div>
      <div data-role='fieldcontain'>
        <label></label>
        <input data-transition='slide' class="form-control" type='submit' value='Sign Up'>
      </div>
    </div>
    </div>
  </body>
</html>
_END;
?>
