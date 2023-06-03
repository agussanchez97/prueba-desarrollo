<?php

require_once '../lib/core.lib.php';

if ($GPC['type'] == 'list-orders') { ?>
    <form class="filter-form" action="orders_async.php" data-target=".filter-results">
        <input type="hidden" name="type" value="filter-orders">

        <div class="row mb-3">
            <div class="col-6">
                <div class="form-group">
                    <label>Origen</label>
                    <input type="text" class="form-control" name="origen" placeholder="Buscar">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Destino</label>
                    <input type="text" class="form-control" name="destino" placeholder="Buscar">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Salida</label>
                    <input type="date" class="form-control" name="salida" placeholder="Buscar">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Retorno</label>
                    <input type="date" class="form-control" name="retorno" placeholder="Buscar">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Total</label>
                    <input type="text" class="form-control" name="total" placeholder="Buscar">
                </div>
            </div>
        </div>
        <div class="row mb-3 justify-content-between">
            <div class="col-2">
                <button type="submit" class="btn btn-success btn-submit" >Buscar</button>
                <button type="reset" class="btn btn-secondary btn-clear">Limpiar</button>
            </div>

            <div class="col-2 d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-load-async" data-action="orders_async.php" data-type="record-orders" data-target="main">
                Agregar
            </button>
            </div>
        </div>
    </form>

    <div class="filter-results">
    </div>
<?php }

if ($GPC['type'] == 'list-orders' or $GPC['type'] == 'filter-orders' ) {
    $arrOrders = Orders::getInstance()->getOrders($GPC);
    ?>
    <table class="table table-striped table-border display" style="width:100%; text-align: center; border: 1px solid #ededed;">
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

        <tbody class='table table-striped table-border'>
            <?php if (empty($arrOrders)) : ?>
                <tr>
                    <td class="text-center" colspan="9">No hay registros</td>
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
                            <button type="button" 
                                    class="btn btn-primary btn-load-async" 
                                    data-action="orders_async.php" 
                                    data-type="record-orders" 
                                    data-params="<?php echo toObject(['id' => $order['id']]); ?>"
                                    data-target="main">
                                Editar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php }

if ($GPC['type'] == 'record-orders') {
    
    $order = [];
    $exists = !empty($GPC['id']);
    if ($exists) {
        $order = Orders::getInstance()->exec("SELECT * FROM orders WHERE id = {$GPC['id']}")[0];
    }

    ?>

    <div class="container">
        <form action="orders_async.php"> 
            <div class="row">
                <div class="col-12">
                    <h1><?php echo !$exists ? 'Crear' : 'Actualizar'; ?> orden</h1>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-12">
                    <form action="orders_async.php" >
                        <input type="hidden" name="type" value="save-order">
                        <input type="hidden" name="id" value="<?= $order['id'] ?>">

                        <div class="form-group">
                            <label>Origen</label>
                            <input type="text" class="form-control" name="origen" value="<?= $order['origen'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Destino</label>
                            <input type="text" class="form-control" name="destino" value="<?= $order['destino'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Salida</label>
                            <input type="date" class="form-control" name="salida" value="<?= $order['salida'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Retorno</label>
                            <input type="date" class="form-control" name="retorno" value="<?= $order['retorno'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" class="form-control" name="total" value="<?= $order['total'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="text" class="form-control" name="fecha" value="<?= $order['fecha'] ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Hora</label>
                            <input type="text" class="form-control" name="hora" value="<?= $order['hora'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control col-10" name="estado" value="<?= $order['estado'] ?>" >
                                <option >Selecciona Estado</option>
                                <option value="0">Activo</option>
                                <option value="1">En Proceso</option>
                                <option value="2">Finalizado</option>
                                <option value="3">Cancelado</option>
                                <option value="4">Anulado</option>
                                <option value="4">Prueba</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-3">
                    <button type="button"
                            class="btn btn-success btn-form-async"
                            data-action="list-orders"
                            data-target="main">
                        Guardar
                    </button>
                    <button type="button"
                            class="btn btn-dark btn-load-async"
                            data-action="orders_async.php"
                            data-type="list-orders"
                            data-target="main">
                        Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div id="main"></div>
<?php }

if ($GPC['type'] == 'save-order') {
    if (1==1) {
        $query = "INSERT INTO orders (origen, destino, salida, retorno, total, fecha, hora) VALUES ('{$GPC['origen']}', '{$GPC['destino']}', '{$GPC['salida']}', '{$GPC['retorno']}', '{$GPC['total']}', '{$GPC['fecha']}', '{$GPC['hora']}')";
    } else {
        $query = "UPDATE orders SET origen = '{$GPC['origen']}', destino = '{$GPC['destino']}', salida = '{$GPC['salida']}', retorno = '{$GPC['retorno']}', total = '{$GPC['total']}', fecha = '{$GPC['fecha']}', hora = '{$GPC['hora']}' WHERE id = {$GPC['id']}";
    }

    Orders::getInstance()->exec($query);

    die(json_encode(['status' => 'OK']));
}