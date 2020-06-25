<?php
	session_start();
	require 'database.php';
	$id = $_SESSION['id'];
	$server="localhost";
	$port="1111";
	$localpath = getcwd();
	$path="$localpath/matlab\r\n";
	$funcion="index_recomendacion($id)\r\n";
	$data= $path.$funcion.chr(0);
	try{
		$conexion_matlab = fsockopen($server, $port, $errno, $errstr, 100);
		if (!$conexion_matlab) {} 
		else 
		{
			fwrite($conexion_matlab, $data);
			fclose($conexion_matlab);
		}
	}
	catch(exception $e)
	{
		echo "Hay un problema en la conexión con el servidor de Matlab. Inténtelo más tarde.";
	}

?>

<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	
	<meta name="viewport" content="width=device-width" />
	<title>SearchAffinity - RECOMENDACIÓN</title>
	<link rel="icon" type="image/png" href="logo.png">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="estilo.css" rel="stylesheet">
	<link href="barra_progreso.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>


</head>
<body>
<div id="cabecera" 	style='background-color:rgb(0,84,146);'>
	<a href="index.php"><img style='left:20px; top:10px;' id="image" src="logo_borde.png" alt="Logo web"></a>
	<p id="titulo" style='font-size:400%; color:white; display:inline; position:absolute; left:120px; top:73px; font:bold;'><b><i><span style="color:yellow">&nbsp;Search</span>Affinity</i></b></p>
	<div style='position:absolute; right:20px; top:10px; color:white;' id="accesoUSER" >
		<?php if(!empty($user)):

		if($results['pic'] == ""):
			$results['pic'] = "std_user.png";
		endif;
?>
		<img src='thumbs/<?=$results['pic']?>' style='width:100px; height:100px; display:inline; border-radius: 50%;'>
		<h5 style='display:inline'>Hola <?=$results['name']?>, bienvenid<?=$sexo?>.</h5>
		<h5 style='display:inline'>ID personal:[<?=$results['id']?>]</h5>
		<?php endif; ?>
	</div>
</div>	
<br>
<br>
<center>
<h4><i>Espere mientras se ejecuta el algorítmo de recomendación... </i></h4>
<div class="meter">
    <div class="bar">
        <span></span>
    </div>
    <div class="num"></div>
</div>
 </center>
 
<script>

var contador=75;
 
setTimeout(()=>{
    document.querySelector(".meter .bar span").style.display="block";
    document.querySelector(".meter .bar span").classList.add("start");
    document.querySelector(".meter .num").innerHTML=contador;
    var interval=setInterval(()=>{
        contador = contador - 1;
        document.querySelector(".meter .num").innerHTML=contador;
        if(contador<=0)
        {
            clearInterval(interval);
            redireccionarPagina();
        }
    },1000);
},500);
 
function redireccionarPagina() {
  window.location = "cuenta.php";
}

</script>

</body>
</html>
