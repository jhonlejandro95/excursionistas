<?php
    session_start();
    $usuario=$_SESSION['variable'];
 
        include("conexion.php");
        $tcal=0;
        $tpeso=0;
 
         //ingreso de elementos
         if(isset($_POST["enviar"])){
            $peso= $_POST["peso"];
            $calorias= $_POST["calorias"];
            $documento= $_POST['documento'];
            $descripcion= $_POST["descripcion"]; 
         //fase 1
        $sql = "SELECT identidad FROM usuarios WHERE identidad=? ";
        $consulta= $conex->prepare($sql);
        $consulta->execute([$documento]);
        if($consulta->rowCount() ==0){
            $sql2 = "INSERT INTO usuarios (identidad) VALUES (?)";
            $resultado= $conex->prepare($sql2);
            $resultado->execute([$documento]);
            $query="SELECT * FROM usuarios WHERE identidad='$documento'";
            $resultado=$conex->query($query);
            while ($row=$resultado->fetch()){
              echo $_SESSION['variable']= $usuario= $row['idusuarios'];
               $_SESSION['variable2']= $row['identidad'];
            }
            $query="SELECT * FROM elementos WHERE usuario=$usuario";
            $resultado=$conex->query($query);
            while ($row=$resultado->fetch()){
               $tpeso=$tpeso+$row['peso'];
               $tcal=$tcal+$contcal=$row['calorias'];
            }
            if ( $tpeso+$peso <=10 ) {
               $sql4 = "INSERT INTO elementos (nombre,peso,calorias,usuario)VALUES(?,?,?,?)";
               $resultado= $conex->prepare($sql4);
               $resultado->execute([$descripcion,$peso,$calorias,$usuario]);  
               header("location:index.php?user=$usuario");
               $tpeso=0;
            }else{
               echo "
               <!DOCTYPE html>
               <html lang='en'>
               <head>
                   <meta charset='UTF-8'>
                   <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                   <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                   <title>Document</title>
                   <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
               </head>
               <body>
               <!-- modal de boostrap -->
               <div class='modal' tabindex='-1' role='dialog' id='myModal'>
                   <div class='modal-dialog' role='document'>
                       <div class='modal-content'>
                       <div class='modal-header'>
                           <h5 class='modal-title'>ATENCION</h5>
                           <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                           </button>
                       </div>
                       <div class='modal-body'>
                           <p> peso maximo superado</p>
                       </div>
                       <div class='modal-footer'>
                           <a href='index.php?user=$usuario'><button type='button' class='btn btn-secondary'>Cerrar</button></a>
                       </div>
                       </div>
                   </div>
                   </div>
               ";
               $tpeso=0;
             }
        } else{
              //fase 2
            $query="SELECT * FROM usuarios WHERE identidad='$documento'";
            $resultado=$conex->query($query);
            while ($row=$resultado->fetch()){
               $_SESSION['variable']= $usuario= $row['idusuarios'];
               $_SESSION['variable2']= $row['identidad'];
            }
            $query="SELECT * FROM elementos  WHERE usuario=$usuario  ";
            $resultado=$conex->query($query);
            while ($row=$resultado->fetch()){
               $tpeso=$tpeso+$row['peso'];
               $tcal=$tcal+$contcal=$row['calorias'];
            }
            if ( $tpeso+$peso <=10 ) {
               $sql4 = "INSERT INTO elementos (nombre,peso,calorias,usuario) VALUES (?,?,?,?)";
               $resultado= $conex->prepare($sql4);
               $resultado->execute([$descripcion,$peso,$calorias,$usuario]); 
               header("location:index.php?user=$usuario");
               $tpeso=0;
         }else{
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                <title>Document</title>
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
            </head>
            <body>
            <!-- modal de boostrap -->
            <div class='modal' tabindex='-1' role='dialog' id='myModal'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>ATENCION</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <p> peso maximo superado</p>
                    </div>
                    <div class='modal-footer'>
                        <a href='index.php?user=$usuario'><button type='button' class='btn btn-secondary'>Cerrar</button></a>
                    </div>
                    </div>
                </div>
                </div>
            ";
            $tpeso=0;
         }
      }
   }  
//eliminacion de elementos
   if(isset($_POST["eliminar"])){
      $idElemento=$_GET['id'];
      $sql = "SELECT * FROM elementos WHERE idelemento=? ";
      $consulta= $conex->prepare($sql);
      $consulta->execute([ $idElemento]);
      if($consulta->rowCount() >0){
      $query="DELETE  FROM elementos WHERE idelemento ='$idElemento'";
      $resultado=$conex->query($query);
      header("location:index.php?user=$usuario");
      }
      else{
         echo "
         <!DOCTYPE html>
         <html lang='en'>
         <head>
             <meta charset='UTF-8'>
             <meta name='viewport' content='width=device-width, initial-scale=1.0'>
             <meta http-equiv='X-UA-Compatible' content='ie=edge'>
             <title>Document</title>
             <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
         </head>
         <body>
         <!-- modal de boostrap -->
         <div class='modal' tabindex='-1' role='dialog' id='myModal'>
             <div class='modal-dialog' role='document'>
                 <div class='modal-content'>
                 <div class='modal-header'>
                     <h5 class='modal-title'>ATENCION</h5>
                     <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                     <span aria-hidden='true'>&times;</span>
                     </button>
                 </div>
                 <div class='modal-body'>
                     <p> el elemento no existe</p>
                 </div>
                 <div class='modal-footer'>
                     <a href='index.php?user=$usuario'><button type='button' class='btn btn-secondary'>Cerrar</button></a>
                 </div>
                 </div>
             </div>
             </div>
         ";
         $tpeso=0;
      }
   }
   // editar elementos 
   if(isset($_POST["editar"])){
   
    $tpeso=0;
    $peso= $_POST["peso"];
    $calorias= $_POST["calorias"];
    $usuario=$_SESSION['variable'];
      $descripcion= $_POST['descripcion'];
      $idElemento=$_GET['id']; 
      $query="SELECT * FROM elementos  WHERE usuario=$usuario ";
         $resultado=$conex->query($query);
         while ($row=$resultado->fetch()){
            echo $tpeso=$tpeso+$row['peso'];
           
         }
         
      if ( $peso >10 ){
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>Document</title>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
        </head>
        <body>
        <!-- modal de boostrap -->
        <div class='modal' tabindex='-1' role='dialog' id='myModal'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>ATENCION</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <p>  peso maximo superado</p>
                </div>
                <div class='modal-footer'>
                    <a href='index.php?user=$usuario'><button type='button' class='btn btn-secondary'>Cerrar</button></a>
                </div>
                </div>
            </div>
            </div>
        ";
     }else if($tpeso <=10) {
        $sql = "UPDATE elementos SET nombre = ?, peso =?, calorias =?  WHERE idelemento='$idElemento'";
        $stmt= $conex->prepare($sql);
        $stmt->execute([$descripcion, $peso, $calorias]);
        header("location:index.php?user=$usuario");

     }else{
      echo "
      <!DOCTYPE html>
      <html lang='en'>
      <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <meta http-equiv='X-UA-Compatible' content='ie=edge'>
          <title>Document</title>
          <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
      </head>
      <body>
      <!-- modal de boostrap -->
      <div class='modal' tabindex='-1' role='dialog' id='myModal'>
          <div class='modal-dialog' role='document'>
              <div class='modal-content'>
              <div class='modal-header'>
                  <h5 class='modal-title'>ATENCION</h5>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
              </div>
              <div class='modal-body'>
                  <p>  peso maximo superado</p>
              </div>
              <div class='modal-footer'>
                  <a href='index.php'><button type='button' class='btn btn-secondary'>Cerrar</button></a>
              </div>
              </div>
          </div>
          </div>
      ";
      $tpeso=0;
     }
    }
    // eliminar usuario
    if(isset($_POST["eliminarUss"])){
        $idus=$_GET['idus'];
        $query="SELECT * FROM elementos e JOIN usuarios u ON e.usuario=u.idusuarios WHERE idusuarios='$idus'";
        $resultado=$conex->query($query);
        if($resultado->rowCount() >0){
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                <title>Document</title>
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
            </head>
            <body>
            <!-- modal de boostrap -->
            <div class='modal' tabindex='-1' role='dialog' id='myModal'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>ATENCION</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <p>  el usuario tiene elementos asociados</p>
                    </div>
                    <div class='modal-footer'>
                        <a href='index.php?user=$usuario'><button type='button' class='btn btn-secondary'>Cerrar</button></a>
                    </div>
                    </div>
                </div>
                </div>
            ";
        }else{
        $query="DELETE  FROM usuarios WHERE idusuarios ='$idus'";
        $resultado=$conex->query($query);
        header("location:index.php");
        }
    }
   ?>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- mostrar el modal al cargar la página-->
<script type="text/javascript">
        $(window).on('load',function(){
        $('#myModal').modal('show');
        });
</script>
