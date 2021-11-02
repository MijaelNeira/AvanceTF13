<?php require ("session.php")?>
<!DOCTYPE html>
 <!--
      --------------------------------------------------
      MODIFICACION N°9
      -------------------------------------------------
      Agregue variables a los titulos
      Agregue algunos arreglos                     
-->
<?php
$tituloHacer = "¿POR QUE VISITAR CAYLLOMA?-" ;
$botones= array("Reservaciones.","Transacciones.","Clases Itinerantes.","Exportar.","Acerca del desarrollador.");
$numero = 940942359 ;
?>

<html>
  <head>
    <meta charset="utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <meta content="Semantic-UI-Forest, collection of design, themes and templates for Semantic-UI." name="description" />
    <meta content="Semantic-UI, Theme, Design, Template" name="keywords" />
    <meta content="PPType" name="author" />
    <meta content="#ffffff" name="theme-color" />
    <title>About Developer</title>
    <link href="static/dist/semantic-ui/semantic.min.css" rel="stylesheet" type="text/css" />
    <link href="static/stylesheets/default.css" rel="stylesheet" type="text/css" />
    <link href="static/stylesheets/pandoc-code-highlight.css" rel="stylesheet" type="text/css" />
    <script src="static/dist/jquery/jquery.min.js"></script>
	<script src="admin.js"></script>
  </head>
  <body>
    <div class="ui inverted huge borderless fixed fluid menu">
      <a class="header item">TICKET RESERVATION SYSTEM</a>
      <div class="right menu">
        <div class="item">
          <div class="ui small input">
		  <form>
            <input placeholder="Search order.." name="search" />
			</form>
          </div>
        </div>
        <a class="item" href="logout.php">Log out</a>
      </div>
    </div>
	
    <div class="ui grid">
      <div class="row">
        <div class="column" id="sidebar">
          <div class="ui secondary vertical fluid menu">
            <a class="item" href="bookings.php"><?php echo $botones [0] ;?></a><a class="item " href="transactions.php"><?php echo $botones [1]  ;?></a><a class=" item" href="travelclass.php"><?php echo $botones [2]  ;?></a><a class="item"><?php echo $botones [3]  ;?></a>
			<a class="item active" href="developer.php"><?php echo $botones [4] ;?></a>
          </div>
        </div>
		
        <div class="column" id="content" style="display:none">
	<div class="ui grid">
            <div class="row">
         <h1 class="ui huge header">Acerca del desarrollador</h1>
         </div>
        <div class="ui horizontal divider"> Peru/Arequipa</div>      
		<div class="row">
        <div class="ui segment">
  <img class="ui centered medium circular image" src=""><br>
  <div class="ui horizontal divider">Sobre mí</div>
		<p>¡Hola!. Me llamo Mijael, estudiante de la univeridad Tecnologica del Peru. Me encanta programar, de verdad, es mi hobby.</p> 
		<div class="ui horizontal divider">Contacts Details</div>
		<p>¿Se pregunta dónde encontrarme? Comuníquese conmigo en;<br> Email: <a>u19220908@utp.edu.pe</a> <br>Personal Contact : <a><?php echo $numero ;?></a><br> Estoy dispuesta a enseñar nuevas programadoras</p>
		</div>		
        </div>
			</div>	
		</div>
      
	  </div>
    </div>
    <style type="text/css">
      body {
        display: relative;
      }
      
      #sidebar {
        position: fixed;
        top: 51.8px;
        left: 0;
        bottom: 0;
        width: 18%;
        background-color: #f5f5f5;
        padding: 0px;
      }
      #sidebar .ui.menu {
        margin: 2em 0 0;
        font-size: 16px;
      }
      #sidebar .ui.menu > a.item {
        color: #337ab7;
        border-radius: 0 !important;
      }
      #sidebar .ui.menu > a.item.active {
        background-color: #337ab7;
        color: white;
        border: none !important;
      }
      #sidebar .ui.menu > a.item:hover {
        background-color: #4f93ce;
        color: white;
      }
      
      #content {
        margin-left: 19%;
        width: 81%;
        margin-top: 3em;
        padding-left: 3em;
        float: left;
      }
      #content > .ui.grid {
        padding-right: 4em;
        padding-bottom: 3em;
      }
      #content h1 {
        font-size: 36px;
      }
      #content .ui.divider:not(.hidden) {
        margin: 0;
      }
      #content table.ui.table {
        border: none;
      }
      #content table.ui.table thead th {
        border-bottom: 2px solid #eee !important;
      }
    </style>
  </body>
</html>
