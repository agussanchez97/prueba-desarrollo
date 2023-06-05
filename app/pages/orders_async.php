<?php

require_once '../lib/core.lib.php';

if ($GPC['type'] == 'list-orders') { ?>
    <form class='filter-form' action='orders_async.php' data-target='.filter-results'>
        <input type='hidden' name='type' value='filter-orders'>

        <div class='row mb-3'>
            <div class='col-6'>
                <div class='form-group'>
                    <label>Origen</label>
                    <input type='text' class='form-control' name='origen' placeholder='Buscar'>
                </div>
            </div>
            <div class='col-6'>
                <div class='form-group'>
                    <label>Destino</label>
                    <input type='text' class='form-control' name='destino' placeholder='Buscar'>
                </div>
            </div>
            <div class='col-6'>
                <div class='form-group'>
                    <label>Salida</label>
                    <input type='date' class='form-control' name='salida' placeholder='Buscar'>
                </div>
            </div>
            <div class='col-6'>
                <div class='form-group'>
                    <label>Retorno</label>
                    <input type='date' class='form-control' name='retorno' placeholder='Buscar'>
                </div>
            </div>
            <div class='col-6'>
                <div class='form-group'>
                    <label>Total</label>
                    <input type='text' class='form-control' name='total' placeholder='Buscar'>
                </div>
            </div>
        </div>
        <div class='row mb-3 justify-content-between'>
            <div class='col-2'>
                <button type='submit' class='btn btn-success btn-submit' >Buscar</button>
                <button type='reset' class='btn btn-secondary btn-clear'>Limpiar</button>
            </div>


        </div>
    </form>

    <div class='filter-results'>
    </div>
<?php }

if(isset($_POST['submit'])){
    // Obtener los datos del formulario
    $origen = $_POST['origen']; // Reemplaza 'origen' con el nombre del campo formulario
    $destino = $_POST['destino']; 
    $destino = $_POST['salida']; 
    $destino = $_POST['retorno']; 
    $destino = $_POST['total'];
    $destino = $_POST['fecha'];
    $destino = $_POST['hora'];
    $destino = $_POST['estado']; 
    
    // Realizar la inserción del nuevo registro en la base de datos
    $query = "INSERT INTO orders (origen, destino, salida, retorno, total, fecha, hora,estado) VALUES ('{$GPC['origen']}', '{$GPC['destino']}', '{$GPC['salida']}', '{$GPC['retorno']}', '{$GPC['total']}', '{$GPC['fecha']}', '{$GPC['hora']}','{$GPC['estado']}' )";
    
    $result=Orders::getInstance()->exec($query);
    if ($result) {
        console.log( "Registro exitoso");
    } else {
        console.log("Error al registrar");
    }

}
?>

    <style>
        /* Estilos para el modal */
        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 2% auto 0;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            
        }
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        .btn-cancelar{
            background-color: #800000;
            border-color: #800000;
        }

        .btn-guardar{
            background-color: green;
            border-color: green;
        }

     
    </style>

    <div class='row  justify-content-end'>
        <button onclick="mostrarModal()" class='btn btn-primary'>Agregar</button>
    </div>
    <br>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <form method="post" action="">
                <div class='row mb-3'>
                    <div class='col-md-6'>
                    
                        <div class='form-group'>
                            <label>Origen</label>
                            <input type='text' class='form-control' name='origen' placeholder='Origen'>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label>Destino</label>
                            <input type='text' class='form-control' name='destino' placeholder='Destino'>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class='form-group'>
                            <label>Salida</label>
                            <input type='date' class='form-control' name='salida' placeholder='Salida'>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class='form-group'>
                            <label>Retorno</label>
                            <input type='date' class='form-control' name='retorno' placeholder='Retorno'>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class='form-group'>
                            <label>Total</label>
                            <input type='text' class='form-control' name='total' placeholder='Total'>
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class='form-group'>
                            <label>Fecha</label>
                            <input type='date' class='form-control' name='fecha' value='<?php echo date('Y-m-d'); ?>'>
                        </div>
                    </div>   
                    <div class="col-md-6"> 
                        <div class='form-group'>
                            <label>Hora</label>
                            <input type='time' class='form-control' name='hora' value='<?php echo date('H:i'); ?>'>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6"> 
                        <div class='form-group'>
                            <label>Estado</label>
                            <select class='form-control col-10' name='estado' placeholder='Estado' >
                                <option >Selecciona Estado</option>
                                <option value='0'>Activo</option>
                                <option value='1'>En Proceso</option>
                                <option value='2'>Finalizado</option>
                                <option value='3'>Cancelado</option>
                                <option value='4'>Anulado</option>
                                <option value='4'>Prueba</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <input class="btn btn-primary btn-guardar" type="submit" name="submit" value="Guardar">
                    <button class="btn btn-secondary btn-cancelar" onclick="cerrarModal()"  >Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function mostrarModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'block';
        }

        function cerrarModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }
    </script>

<?php
if ($GPC['type'] == 'list-orders' or $GPC['type'] == 'filter-orders' ) {
    $arrOrders = Orders::getInstance()->getOrders($GPC);
    ?>
    <table class='table table-striped table-border display' style='width:100%; text-align: center; border: 1px solid #ededed;'>
        <thead >
            <tr >
                <th >N°</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Salida</th>
                <th>Retorno</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody >
            <?php if (empty($arrOrders)) : ?>
                <tr>
                    <td class='text-center' colspan='9'>No hay registros</td>
                </tr>
            <?php else : ?>
                <?php foreach ($arrOrders as $order) : ?>
                    <tr >
                        <td ><?= $order['id'] ?></td>
                        
                        <td><?= $order['origen'] ?></td>
                        <td><?= $order['destino'] ?></td>
                        <td><?= $order['salida'] ?></td>
                        <td><?= $order['retorno'] ?></td>
                        <td><?= $order['total'] ?></td>
                        <td><?= $order['fecha'] ?></td>
                        <td><?= $order['hora'] ?></td>
                        <td><?= $order['estado'] ?></td>
                        
                        <td>
                            <button type='button' 
                                    class='btn btn-primary btn-load-async' 
                                    data-action='orders_async.php' 
                                    data-type='record-orders' 
                                    data-params='<?php echo toObject(['id' => $order['id']]); ?>'
                                    data-target='.filter-results'>
                                    Editar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php }


//if ($GPC['type'] == 'record-orders') {
    
    // $order = [];
    //$exists = !empty($GPC['id']);
    //if ($exists) {
    //    $order = Orders::getInstance()->exec("SELECT * FROM orders WHERE id = {$GPC['id']}")[0];
    //}

//    ?>
            
<!--          <div class='row mb-3'>
                <div class='col-12'>
                    <form action='orders_async.php' >

                        <div class='form-group'>
                            <label>Origen</label>
                            <input type='text' class='form-control' name='origen' value='<?= $order['origen'] ?>'>
                        </div>

                        <div class='form-group'>
                            <label>Destino</label>
                            <input type='text' class='form-control' name='destino' value='<?= $order['destino'] ?>'>
                        </div>

                        <div class='form-group'>
                            <label>Salida</label>
                            <input type='date' class='form-control' name='salida' value='<?= $order['salida'] ?>'>
                        </div>

                        <div class='form-group'>
                            <label>Retorno</label>
                            <input type='date' class='form-control' name='retorno' value='<?= $order['retorno'] ?>'>
                        </div>

                        <div class='form-group'>
                            <label>Total</label>
                            <input type='text' class='form-control' name='total' value='<?= $order['total'] ?>'>
                        </div>

                        <div class='form-group'>
                            <label>Fecha</label>
                            <input type='text' class='form-control' name='fecha' value='<?= $order['fecha'] ?>'>
                        </div>
                        
                        <div class='form-group'>
                            <label>Hora</label>
                            <input type='text' class='form-control' name='hora' value='<?= $order['hora'] ?>'>
                        </div>

                        <div class='form-group'>
                            <label>Estado</label>
                            <select class='form-control col-10' name='estado' value='<?= $order['estado'] ?>' >
                                <option >Selecciona Estado</option>
                                <option value='0'>Activo</option>
                                <option value='1'>En Proceso</option>
                                <option value='2'>Finalizado</option>
                                <option value='3'>Cancelado</option>
                                <option value='4'>Anulado</option>
                                <option value='4'>Prueba</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class='row mb-3'>
                <div class='col-3'>
                    <button type='button'
                            class='btn btn-success btn-form-async'
                            data-action='list-orders'
                            data-target='main'>
                        Guardar
                    </button>
                    <button type='button'
                            class='btn btn-dark btn-load-async'
                            data-action='orders_async.php'
                            data-type='list-orders'
                            data-target='main'>
                        Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
    -->    
<?php 

if ($GPC['type'] == 'save-order') {
    if (empty($GPC['id'])) {
        $query = "INSERT INTO orders (origen, destino, salida, retorno, total, fecha, hora) VALUES ('{$GPC['origen']}', '{$GPC['destino']}', '{$GPC['salida']}', '{$GPC['retorno']}', '{$GPC['total']}', '{$GPC['fecha']}', '{$GPC['hora']}')";
    } else {
        $query = "UPDATE orders SET origen = '{$GPC['origen']}', destino = '{$GPC['destino']}', salida = '{$GPC['salida']}', retorno = '{$GPC['retorno']}', total = '{$GPC['total']}', fecha = '{$GPC['fecha']}', hora = '{$GPC['hora']}' WHERE id = {$GPC['id']}";
    }

    Orders::getInstance()->exec($query);

    die(json_encode(['status' => 'OK']));
}