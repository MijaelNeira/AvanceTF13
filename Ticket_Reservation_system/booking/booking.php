<?php session_start() ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema de reserva de entradas</title>

        <link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
        <script src="semantic/jquery.min.js"></script>
        <script src="semantic/semantic.min.js"></script>
        <link href="semantic/datepicker.css" rel="stylesheet" type="text/css">
        <script src="semantic/datepicker.js"></script>
        <script src="nav.js"></script>

        <style>
            body{
                background-color:f1f1f1;
            }
            a{
                cursor:pointer;
            }
        </style>
    </head>
    <!--
        --------------------------------------------------
        MODIFICACION N°1
        -------------------------------------------------
        Obtenemos la fecha actual ,y extraer dia, mes y año
    -->
    <?php
    $fechaEntera = time();
    $anio = date("Y", $fechaEntera);
    $mes = date("m", $fechaEntera);
    $dia = date("d", $fechaEntera);
    ?>
    <body>
        <div class="ui inverted huge borderless fixed fluid menu">
            <a class="header item">SISTEMA DE RESERVA DE ENTRADAS !!!</a>
        </div><br>


        <div class="ui fluid container center aligned" style="cursor:pointer;margin-top:40px">
            <div class="ui unstackable tiny steps">
                <div class="step" onclick="booking()">
                    <i class="plane icon"></i>
                    <div class="content">
                        <div class="title">Detalles de la Reserva</div>
                        <div class="description">Información de reservas y viajes </div>
                    </div>
                </div>
                <div class="step disabled" onclick="contact()" id="contactbtn">
                    <i class="truck icon"></i>
                    <div class="content">
                        <div class="title">Detalles</div>
                        <div class="description">Información del contacto</div>
                    </div>
                </div>
                <div class="disabled step" id="billingbtn" onclick="billing()">
                    <i class="money icon"></i>
                    <div class="content">
                        <div class="title">Facturacion</div>
                        <div class="description">Pago y verificación</div>
                    </div>
                </div>
                <div class="disabled step" onclick="confirmdetails()" id="confimationbtn">
                    <i class="info icon"></i>
                    <div class="content">
                        <div class="title">Confirmar detalles </div>
                        <div class="description">Verificar los detalles del pedido</div>
                    </div>
                </div>
                <div class="disabled step" id="finishbtn">
                    <i class="info icon"></i>
                    <div class="content">
                        <div class="title">terminar e imprimir</div>
                        <div class="description">impresión Ticket</div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div id="dynamic">

            <div class="ui container text" id="booking-page">
                <div class="ui attached message">
                    <div class="header">Informacon de reserva</div>
                    <div class="header">Order pedido  : <span style="color:red;font-size:15px"><?php echo $_SESSION['ORDERREF'] ?> <a href='index.php'>Cancelar pedido</a></span> </div>
                    <p>ingrese la informacion de la reserva de su viaje</p>
                </div>

                <form class="ui form attached fluid loading segment" onsubmit="return contact(this)">
                    <div class="field">
                        <label>Viaje de Destino</label>
                        <div class="field">
                            <select required id="destination">
                                <option value="" selected disabled>--Destino--</option>
                                <!--
                                    --------------------------------------------------
                                     MODIFICACION N°2
                                    -------------------------------------------------
                                Cargar los datos mediante un array.y  obtenemos el nro de mes actual y la condicion a filtrar es
                                si el mes es Agosto[8] , Septiembre[9]  , Octubre[10] y noviembre[11] y el destino es tacna o arica
                                entonces se mostrara los datos en el combo box, casi no se cumple entonces muestra todo.
                                -->
                                <?php
                                $destinos = array("Lima", "Cuzco", "Juliaca", "Tacna", "Arica", "Santiago de chile");
                                foreach ($destinos as $key => $data) {
                                    if (!($mes >= 8 && $mes <= 11 && $data == "Tacna" || $data == "Arica")) {
                                        echo "<option value='.$data.'>" . $data . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label>Clase de Viaje </label><span><a href="https://www.aeropuertos.net/aeropuerto-internacional-rodriguez-ballon/">Mas informacion</a><i> sobre las clases itinerantes</i></span>
                        <div class="field">
                            <select name="viaje" required id="travelclass">
                                <option value="" selected disabled>--Clase de Viaje---</option>
                                <!--
                                    --------------------------------------------------
                                    MODIFICACION N°3
                                    -------------------------------------------------
                                Mostrar en el combo el viiaje que contiene en su defiinicion la palabra Media, como una 
                                mejora para un mejor visualizacion para el uuario
                                -->
                                <?php
                                $viajes = array("Viajes de clase alta", "Viajes de clase Media", "Viajes de clase Baja", "Viajes con Nesesidades Especiales");

                                foreach ($viajes as $key => $data) {
                                    if(strpos($data , "Media") >0){ // Preguntamos si el valor de cada dato del arreglo cotiene la palabra media, si retorna mayor  a cero entonces si contiene caso contrario no contiene
                                        echo "<option value='.$data.' style='background-color: #0099cc;color:white;'>" . $data . "</option>"; // Usamos color y background para darle una mejor presentacion, los colores estan en hexadecimal
                                    }else{
                                        echo "<option value='.$data.'>" . $data . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Numero de asientos</label>
                            <!--
                                --------------------------------------------------
                                MODIFICACION N°4
                                -------------------------------------------------
                            Obtener el numero de asientos minimo por dia en base a la siguiente condicion,
                            si el nro del dia es 1,2,3 el minimo de asientos es 2
                            si el nro de dias es 3,4,6 el minimo de asientos es 3
                             si el nro de dias es 10,15,16 el minimo de asientos es 4
                            cas contrario es 1
                            -->
                            <?php
                            $min_asientos = 1;
                            switch ($dia) {
                                case 1: case 2: case 5:
                                    $min_asientos = 2;
                                    break;
                                case 3: case 4: case 6:
                                    $min_asientos = 3;
                                    break;
                                case 10: case 15: case 20:
                                    $min_asientos = 4;
                                    break;
                            }
                            ?>

                            <input placeholder="Number of Seats" type="number" id="seats" value="<?=$min_asientos?>"    min="<?=$min_asientos?>" max="72"  value="1" required>
                        </div>
                        <div class="field">
                            <label>Fecha de viaje</label>
                            <input type="text" readonly required id="traveldate" class="datepicker-here form-control" placeholder="Seleccione la fecha">
                        </div>
                    </div>
                    <div style="text-align:center">
                        <div><label>Asegúrese de que todos los detalles se hayan completado correctamente</label></div>
                        <button class="ui green submit button">Enviar detalles</button>
                    </div>
                </form>
            </div>


            <div class="ui container text" id="contact-page" style="display:none">
                <div class="ui attached message">
                    <div class="header">¡Ingrese sus datos de cliente! </div>
                    <div class="header">Orden pedido: <span style="color:red;font-size:15px"><?php echo $_SESSION['ORDERREF'] ?> <a href='index.php'> Cancelar pedido</a></span> </div>
                    <p>Complete los campos requeridos</p>
                </div>
                <form class="ui form attached fluid loading segment" onsubmit="return billing(this)">
                    <div class="field">
                        <label>Nombre completo</label>
                        <input placeholder="Nombres completos" type="text" id="fullname" required>
                    </div>

                    <div class="field">
                        <label>Dirección de contacto / móvil o correo electrónico</label>
                        <input placeholder="Telefono/correo electronico" type="text" id="contact" required>
                    </div>

                    <div class="field">
                        <label>Genero</label>
                        <div class="field">
                            <select name="gender" required id="gender">
                                <option value="" selected disabled>--Elija género--</option>

                                <!--
                                    --------------------------------------------------
                                    MODIFICACION N°5
                                    -------------------------------------------------
                            Nuevamente usamos el foreach para recorrer cada elementode la lista en este caso con id='  $sexos '.
                            -->
                                <?php
                                $sexos = array("Masculino", "Femenino");
                                foreach ($sexos as $key => $data) {
                                    ?>
                                    <option value="<?= $data ?>"><?= $data ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div style="text-align:center">
                        <div><label>Asegúrese de que todos los detalles se hayan completado correctamente</label></div>
                        <button class="ui green submit button">Enviar detalles</button>
                    </div>

                </form>
            </div>

            <div class="ui container text" id="billing-page" style="display:none">
                <div class="ui attached message">
                    <div class="header">Validar la información de pago</div>
                    <div class="header">Orden pedido: <span style="color:red;font-size:15px"><?php echo $_SESSION['ORDERREF'] ?> <a href='index.php'>Cancelar pedido</a></span> </div>
                    <p>Ingrese los detalles del pago para continuar</p>
                </div>

                <form class="ui form attached fluid loading segment" onsubmit="return confirmdetails(this)">
                    <div class="field">
                        <label>Pago</label>
                        <select name="gender" required id="paymentmethod">
                            <option value="" selected disabled>Forma de pago</option>
                            <!--
                                --------------------------------------------------
                                MODIFICACION N°6
                                --------------------------------------------------
                            Nuevamente usamos el foreach para recorrer cada elementode la lista en este caso con id='  $pagos '.
                            -->
                            <?php
                            $pagos = array("PayPal", "BCP", "Visa");
                            foreach ($pagos as $key => $data) {
                                ?>
                                <option value="<?= $data ?>"><?= $data ?></option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="field">
                        <label>ID de transacción</label>
                        <div class="ui icon input">
                            <input placeholder="Transaction Code" type="text" required id="codebox">
                            <i class="payment icon"></i>
                        </div>
                    </div>

                    <div class="field">
                        <label>Confirmar monto </label>

                        <div class="ui icon input">
                            <!--
                                --------------------------------------------------
                                MODIFICACION N°7
                                -------------------------------------------------
                            Como incremento en la aplicacion, obtenemos el año actual y si el año es bisiestro
                            se incrementara el costo base de 52.03 en un 20 % adicional,
                            un año es bisiestro si es multiplo de 4 y diferente a 100 o si es multiplo de 400.
                            -->
                            <?php
                            $costo_base = 52.03;
                           if (($anio % 4 == 0 && $anio % 100 != 0) ||$anio  % 400 == 0){
                                $costo_base = $costo_base * 1.20;
                            }
                            ?>
                            <input value="<?=$costo_base?>" type="text" id="amount" readonly>
                        </div></div>
                    <div style="text-align:center">
                        <button class="ui green submit button">Continuar</button>
                    </div>
                </form>
                <div class="ui bottom attached warning message"><i class="icon help"></i><b id="payment-info"></b></div>
            </div>



            <div class="ui text container" id ="confirmdetails-page" style="display:none">
                <div class="ui positive message">
                    <b>Antes de continuar, vuelva a verificar los siguientes detalles que proporcionó</b><br>
                    <i>Es posible que el boleto no se vuelva a imprimir, por lo tanto, los detalles que proporcionó deben ser válidos</i>
                    <br>
                    <div class="ui horizontal divider">Los detalles proporcionados</div>
                    <div id="details"></div>
                    <div class="ui horizontal divider">Confirmar detalles</div>
                    <div class="ui fluid container center aligned">
                        <a class="ui button green" onclick="senddata()">YES|Confirmar</a>
                    </div>
                </div>
            </div>


        </div>
    </body>
</html>