

<!--
        --------------------------------------------------
        MODIFICACION N°8
        -------------------------------------------------
       Usamos algunas varibles ! 
    -->

<?php

$titulo1 = "¿Que es el N°Reserva ?" ;
$titulo2 = "¿¿Puedo recuperar o volver a imprimir un boleto perdido?" ;
$titulo3 = "¿Es este sitio web real?" ;

?>

<div class="ui accordion">
  <div class="title" onclick="$('#c1').slideToggle();">
    <i class="dropdown icon"></i>
    <?php echo $titulo1 ;?>
  </div>
  <div class="content" id="c1">
    <p class="transition" >Un Número de referencia de pedido es un número único generado por el sistema que identifica su boleto, así como la información de la reserva.</p>
  </div>
  <div class="title" onclick="$('#c2').slideToggle();">
    <i class="dropdown icon"></i>  
    <?php echo $titulo2 ;?>
  </div>
  <div class="content" id="c2">
    <p class="transition">Sí | Es cierto, es posible, solo proporcione el número de referencia #Order arriba y el sistema validará y volverá a imprimir su boleto.</p>
  </div>
  <div class="title" onclick="$('#c3').slideToggle();">
    <i class="dropdown icon"></i>
    <?php echo $titulo3 ;?>
  </div>
  <div class="content" id="c3">
    <p class="transition"> Desafortunadamente, este sitio web no está oficialmente operativo y, por lo tanto,<a>NO</a>imprime ningún tipo de tickets / pedidos que funcionen. </p>
    <p class="transition">Pero, lo bueno es que este sistema se encuentra actualmente en desarrollo y es posible que se utilice pronto..</p>
  </div>
    
</div>