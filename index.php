<div  style=" display: none" >
<?php session_start();
if($_GET['user']==false){
$_GET['user']=0;
$us=0;
$usuario=0;
}else{
  $_GET['user']; 
  $us=$_SESSION['variable2'];
  $usuario=$_SESSION['variable'];
}
?>
</div>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CALORIAS</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
<div class="container" >
    <span class="d-block p-2 bg-dark text-white">
        <P>-El peso maximo  sera de 10 kilogramos. <br> -el minimo de calorias de cada elemento  sera de 15 calorías. <br>
          -para eliminar los usuarios asegurese de que no tenga elementos asociasdos.</P>
    </span>
    <div id="formulario">
        <form  method="POST" action="consultas.php">
            <div class="form-group">
                <label for="documento">documeto del usuario</label>
                <input type="documento" name="documento" class="form-control border-dark" id="documento" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción o nombre del elemento</label>
                <input type="text" name="descripcion"class="form-control border-dark" id="descripcion">
            </div>
            <div class="form-group">
                <label for="peso">peso del elemento</label>
                <input type="number" name="peso" class="form-control border-dark" id="peso" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="calorias">calorías del elemento</label>
                <input type="number" name="calorias" class="form-control border-dark" id="exampleInputPassword1">
            </div>
            <button  name="enviar" type="enviar" id="enviar" class="btn btn-primary">Enviar</button>
        </form>
        <form action="index.php" method='POST'>
        <div class="form-group">
                <label for="documento">Buscar elementos del usuario </label>
                <input type="number" name="documento" class="form-control border-dark" id="documento" aria-describedby="emailHelp">
            </div>
            <button  name="buscar" type="sumbit" id="buscar" class="btn btn-primary">Buscar</button>
        </form>
      
    </div>
    <?php 

    $tpeso=0;
    $tcal=0;  

    if($usuario!=0){

        include("conexion.php");
            $query="SELECT * FROM elementos WHERE usuario=$usuario";
            $resultado=$conex->query($query);
            while ($row=$resultado->fetch()){
            $tpeso=$tpeso+$row['peso'];
            $tcal=$tcal+$contcal=$row['calorias'];
            
        }
    }
    if ($tcal<15) {
        ?>
            <style>
            #estcalorias{
                position: relative;
                background-color: red;
            }
            </style>
        <?php 
        }
        else{
            ?>
            <style>
            #estcalorias,#estpeso{
                position: relative;
                background-color:rgb(77, 238, 147);
            }
            </style>
        <?php
        }

        if ($tpeso > 10) {
            ?>
                <style>
                #estpeso{
                    position: relative;
                    background-color: red;
                }
                </style>
            <?php 
            }
            else{
                ?>
                <style>
                #estpeso{
                    position: relative;
                    background-color:rgb(77, 238, 147);
                }
                </style>
            <?php
            }
        
        if(isset($_POST["buscar"])){
            $documento=$_POST["documento"];
            include("conexion.php");
            if($documento>0){
            $documento=$_POST["documento"];
            $us=$documento;
            $documento=$_POST["documento"];
            $query="SELECT * FROM usuarios WHERE identidad=$documento";
            $resultado=$conex->query($query);
            while ($row=$resultado->fetch()){
                $usuario= $row['idusuarios'] ; 
            }
            $query="SELECT * FROM elementos e JOIN usuarios u ON e.usuario=u.idusuarios WHERE idusuarios=' $usuario'";
            $resultado=$conex->query($query);
            while ($row=$resultado->fetch()){
                $tpeso=$tpeso+$row['peso'];
                $tcal=$tcal+$contcal=$row['calorias'];
            
            }
        }
      }

       ?>
    <div id="tabla">
        <table class="table">
            <thead class="thead-dark">
       <span  > numero de identificacionidentificacion: <?php echo $us?>
       <br>
    <span id='estpeso'>  peso en maleta: <?php echo $tpeso ?> kilos.</span>
       <br>
       <span id="estcalorias">   calorías proporcionadas:  <?php echo  $tcal ?> calorías.</span>
       </span>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>ELEMENTO</th>
                <th scope='col'>PESO</th>
                <th scope='col'>CALORIAS</th>
                <th scope='col'>ACCION</th>
                <th scope='col'></th>
            </tr>
          </thead>
        <tbody> 
         <tr>
           <?php  
            $cont=1;
            include("conexion.php");
            if(isset($_POST["buscar"])){
                if($documento>0){
                $query="SELECT * FROM usuarios WHERE identidad=$documento";
                $resultado=$conex->query($query);
                while ($row=$resultado->fetch()){
                 $usuario= $row['idusuarios'] ; 
                }
            }
            }
            $query="SELECT * FROM elementos e JOIN usuarios u ON e.usuario=u.idusuarios WHERE idusuarios='$usuario'";
            $resultado=$conex->query($query);
            while ($row=$resultado->fetch()){  
                $idelemento=$row['idelemento'];
                $identidad=$row['identidad'] ;
                $idUser= $row['idusuarios'] ;
                $peso= $row['peso'] ;
                $calorias= $row['calorias'] ;
                $descripcion=$row['nombre'] ;
                ?> 
                <th scope="row"><?php echo $cont?></th>
                <td><?php echo $descripcion?></td>
                <td><?php echo $peso?> kilos</td>
                <td><?php echo $calorias?> Calorias</td>
                <?php echo "
                <td>
                <form action='consultas.php?id=$idelemento, user=$idUser' method='POST'><button name='eliminar' type='enviar' id='eliminar' class='btn btn-primary' >Eliminar</button></form>
                <td> <button type='button' id='actmodel' name='actmodel' class='btn btn-primary' data-toggle='modal' data-target='#modelmod$idelemento'> Modificar</button>
                </td>
                </tr>
                <!-- Modal -->
                <div class='modal fade' id='modelmod$idelemento' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Editar elementos de usuario: $identidad  </h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <form  method='POST' action='consultas.php?id=$idelemento'>
                    <div class='modal-body'>
                            <div class='form-group'>
                                <label for='descricion'>Nombre del elemento</label>
                                <input type='text' name='descripcion' class='form-control border-dark' id='descricion'   value=' $descripcion'   required> 
                            </div>
                            <div class='form-group'>
                                <label for='peso'>Peso</label>
                                <input type='number' name='peso' class='form-control border-dark' id='peso' aria-describedby='emailHelp'  value='$peso' required>
                            </div>
                            <div class='form-group'>
                                <label for='calorias'>Calorias</label>
                                <input type='number' name='calorias' class='form-control border-dark' id='calorias' aria-describedby='emailHelp' value='$calorias'  required>
                            </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        <button  id='editar' name='editar' type='submit' class='btn btn-primary'>Guarar cambios</button>
                    </div>
                    </form>
                </div>
                </div>
            ";
            $cont=$cont+$cont;
        } 
    
        ?>
        </tbody>
        </table>
         </div>
            <table class="table" id="tabus">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">identidad</th>
                <th scope="col">accion</th>
                </tr>
            </thead>
            <tbody>   
             <?php
             $cont=1;
                $query="SELECT * FROM usuarios";
                $resultado=$conex->query($query);
                while ($row=$resultado->fetch()){
                    $idUss=$row['idusuarios'];
                    ?>
                <tr>
                <th scope="row"><?php echo $cont?></th>
                <td><?php echo $row['identidad']?></td>
                <td><?php echo "  <form action='consultas.php?idus=$idUss' method='POST'><button name='eliminarUss' type='enviar' id='eliminarUss' class='btn btn-primary' >Eliminar</button></form>   "?></td>
                </tr>
                <?php
                  $cont=$cont+$cont;
                }
             ?>
            </tbody>
        </table>
    </div>
<script src="js/js.js"></script>
</body>
</html>
