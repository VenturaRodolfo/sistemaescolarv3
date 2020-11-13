<?php
use Illuminate\Database\Capsule\Manager as Capsule;

require_once "data.php";


echo ("
        <title>Actualizar/editar</title>
    </head>
    <body>
");

if ($loggedin) {

    $access = Capsule::table('users')->select(['idaccess'])->where('idaccess', '=', 1)->first();
    //$access = Capsule::table('users')->count();
    $sql = Capsule::table('users')->select('nombre', 'iduser', 'idaccess')->where('idaccess', '=', 2)->get();
    $w = $sql; 
    //$sql = Capsule::table('users')->count();
    $idaccess= $access->idaccess;

    //$sql = queryMysql("SELECT * FROM users WHERE idaccess = '2'") or die(mysqli_error($connection));
    if ($idaccess == 1) {
        require_once "header.php";

    //while ($f = mysqli_fetch_array($sql)) 
    foreach($w as $actu){
    
        echo '
        <div class="columns is-mobile is-centered">
        <div class="column is-three-fifths is-offset-one-fifth">
       <br>
         <div class="card" style="width: 25rem;">
        <div class="card-body">
          <h5 class="card-title">Calificaciones de '. $actu->nombre . '</h5>
          <h6 class="card-subtitle mb-2 text-muted">Materias: </h6>
             <ol>
              <li>
                <p>Español:</p>
                </li>
            <form action="actualizar.php"> 
            <input type="int" class="form-control" name="cal_esp" placeholder="ingrese calificacion de español"> 
            <button type="submit" class="btn btn-dark" name= "id" value="' . $actu->iduser .' ">Enviar</button>
            
            </form>';
                error_reporting(E_ALL ^ E_NOTICE,);
             $calEspa = $_GET ["cal_esp"];

             if($calEspa != 0 ){

                if (!empty($_GET ["id"])) {
                $id = $_GET ["id"];  
                
                /*queryMysql("UPDATE users 
                SET español = '$calEspa'
                WHERE iduser = '$id' ");*/
                $calificaciones = Capsule::table('materias')->insertOrIgnore(['users_iduser' => $id]);
                Capsule::table('materias')->where('users_iduser', $id)
                ->update(['español' => $calEspa]);
                }     
             }
          echo'  <li>
                    <p>Matematicas:</p>
                </li>
                <form action="actualizar.php"> 
                <input type="int" class="form-control" name="cal_mate" placeholder="ingrese calificacion de matematicas"> 
                <button type="submit" class="btn btn-dark" name= "id" value=" '. $actu->iduser .' ">Enviar</button>
            
                </form>';
    
                 $calMate = $_GET["cal_mate"];
    
                   if($calMate != 0 ){
    
                    if (!empty($_GET['id'])) {
                    $id = $_GET['id'];  
                    
                    /*queryMysql("UPDATE users 
                    SET matematicas = '$calMate'
                    WHERE iduser = '$id' ");*/
                    $calificaciones = Capsule::table('materias')->insertOrIgnore(['users_iduser' => $id]);
                    Capsule::table('materias')->where('users_iduser', $id)
                    ->update(['matematicas' => $calMate]);
                    }    
                }
          echo'  <li>
                <p>Historia:</p>
            </li>
            <form action="actualizar.php"> 
            <input type="int" class="form-control" name="cal_histo" placeholder="ingrese calificacion de historia"> 
            <button type="submit" class="btn btn-dark" name= "id" value="' . $actu->iduser .' ">Enviar</button>
            

            </form>';

             $calHisto = $_GET["cal_histo"];

             if($calHisto != 0 ){

                if (!empty($_GET['id'])) {
                $id = $_GET['id'];  
                
               /* queryMysql("UPDATE materias 
                SET historia = '$calHisto'
                WHERE iduser = '$id' ");*/
                $calificaciones = Capsule::table('materias')->insertOrIgnore(['users_iduser' => $id]);
                Capsule::table('materias')->where('users_iduser', $id)
                ->update(['historia' => $calHisto]);
                }    
            }
         echo' </ol>
        
            </div>  
         </div> 
         </div>
         </div> 
      </div>'; 
      
        }
    }
}
?>