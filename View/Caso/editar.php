<?php

while ($casoSeleccionado = pg_fetch_assoc($casoConsulta)) {

?>
    <div class="card">

        <div class="card-header">
            <div class="card-title">Modificar Caso</div>
        </div>

        <div class="card-body">
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label>Entorno</label>
                    <div class="input-group bg-info">
                        <input type="text" class="form-control" style="color: black;" name="entorno" id="entorno" value="<?php echo $casoSeleccionado['ent_descripcion']; ?>" readonly>
                        <div class="input-group-prepend">
                            <button class="btn btn-default" data-toggle="modal" data-target="#modalEntorno">
                                <span class="btn-label">
                                    <i class="fas fa-street-view"></i>
                                </span>
                                Buscar
                            </button>
                        </div>
                        <input type="hidden" name="entorno_id" id="entorno_id" value="<?php echo $casoSeleccionado['ent_id'];?>">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label>Tramo</label>
                    <div class="input-group bg-info">
                        <input type="text" class="form-control" style="color: black;" name="tramo" id="tramo" value="<?php echo $casoSeleccionado['tra_codigo']; ?>" readonly>
                        <div class="input-group-prepend">
                            <button class="btn btn-default" data-toggle="modal" data-target="#modalTramo">
                                <span class="btn-label">
                                    <i class="fas fa-street-view"></i>
                                </span>
                                Buscar
                            </button>
                        </div>
                        <input class="validacion" type='hidden' name="tramo_id" id="tramo_id" value="<?php echo $casoSeleccionado['tra_id']?>">
                        <input class="validacion" type='hidden' name="tra_ancho_inicio" id="ancho_inicio" value="<?php echo $casoSeleccionado['tra_ancho_inicio']?>">
                        <input class="validacion" type='hidden' name="tra_ancho_fin" id="ancho_fin" value="<?php echo $casoSeleccionado['tra_ancho_fin']?>">
                    </div>
                </div>

            </div>

            <div class="form-row mt-3">

                <div class="form-group form-group-default col-md-3">
                    <label>Seleccione la prioridad</label>
                    <select name="prioridad" class="form-control validacion">
                        <option value="1" <?php if ($casoSeleccionado['cas_prioridad'] <= 2) {
                                                echo "selected";
                                            } ?>>Baja</option>
                        <option value="3" <?php if ($casoSeleccionado['cas_prioridad'] > 2 && $casoSeleccionado['cas_prioridad'] <= 4) {
                                                echo "selected";
                                            } ?>>Media</option>
                        <option value="6" <?php if ($casoSeleccionado['cas_prioridad'] > 4 && $casoSeleccionado['cas_prioridad'] <= 7) {
                                                echo "selected";
                                            } ?>>Alta</option>
                    </select>
                </div>

                <div class="form-group form-group-default col-md-4 ml-3">
                     <label>Actualizar foto Inicial  <!--<button class="btn btn-icon btn-round btn-secondary" type="button"><i class="fas fa-eye"></i></button></label> -->
                    <input type="file" class="form-control validacion" name="cas_fotografia_inicio" id="fotografia_inicio">
                </div>

                <div class="form-group form-group-default col-md-4 ml-3">
                     <label>Actualizar foto Final <!--<button class="btn btn-icon btn-round btn-success" type="button"><i class="fas fa-eye"></i></button></label> -->
                    <input type="file" class="form-control validacion" name="cas_fotografia_inicio" id="fotografia_inicio">
                </div>

                <div class="form-row col-md-12 mt-3">
                    <label>Causa</label>
                    <textarea class="form-control validacion" name="cas_causa" id="cas_causa" rows="4" maxlength="200"><?php echo $casoSeleccionado['cas_causa']; ?></textarea>
                    <small id="ad5" class="form-text text-muted text-danger"></small>
                </div>

            </div>

            <?php
            $contador = 1;
            while ($DeteriorosCaso = pg_fetch_assoc($deteriorosCasoConsulta)) {
            ?>
                <div class="form-row">


                    <div id="d1" class="form-group col-md-5 mt-2">
                        <label>Deterioro</label>
                        <div class="input-group bg-info">
                            <input type="text" class="form-control inputcito text-black" id="inputDeterioro<?php echo $contador; ?>" style="color:black;" name="deterioro" value="<?php echo $DeteriorosCaso['det_nombre'] ?>" readonly>
                            <div class="input-group-prepend">
                                <button class="btn btn-default botonInput" id="<?php echo $contador; ?>" type="button" data-toggle="modal" onclick="enviarID(this.id);" data-target="#modalDeterioroEditar">
                                    <span class="btn-label">
                                        <i class="fas fa-directions"></i>
                                    </span>
                                    Buscar
                                </button>
                            </div>
                            <input type='hidden' class="inputcito_hidden validacion" name="deterioros[]" id="deterioro_id<?php echo $contador; ?>" value="<?php echo $DeteriorosCaso['deterioro_id'] ?>">
                        </div>
                        <small id="ad6" class="form-text text-muted text-danger"></small>
                    </div>

                    <div id="d2" class="form-group col-md-2 mt-2" style="padding: 15px">
                        <label>Gravedad</label>
                        <select name="gravedades[]" class="form-control validacion">
                            <option value="1" <?php if ($DeteriorosCaso['cas_det_gravedad'] == 1) echo "selected"; ?>>1</option>
                            <option value="2" <?php if ($DeteriorosCaso['cas_det_gravedad'] == 2) echo "selected"; ?>>2</option>
                            <option value="3" <?php if ($DeteriorosCaso['cas_det_gravedad'] == 3) echo "selected"; ?>>3</option>
                        </select>
                        <small id="ad7" class="form-text text-muted text-danger"></small>
                    </div>

                    <div id="d3" class="form-group" style="margin-top: 13px;">
                        <label>Area</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="areas[]" aria-label="Area" value="<?php echo $DeteriorosCaso['cas_det_area']; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">mm</span>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($contador == 1) {
                    ?>
                        <div class="col-md-1 col-ms-1 col-xs-12">
                            <button class="btn btn-icon btn-round btn-info" type="button" id="añadirDeterioro" style="margin-top: 52px;"><i class="fas fa-plus-circle"></i></button>
                        </div>
                    <?php

                    } else {

                    ?>
                        <div class="col-md-1 col-ms-1 col-xs-12">
                            <button class="btn btn-icon btn-round btn-danger" type="button" id="quitarDeterioro" style="margin-top: 52px;"><i class="fas fa-minus-circle"></i></button>
                        </div>
                    <?php

                    }
                    ?>

                </div>
            <?php
                $contador++;
            }
            ?>
            <div class="" id="copy">

            </div>
        </div>
        <div class="card-action">
            <div>
                <button type="submit" class="btn btn-danger">Cancelar</button>
                <button type="submit" class="btn btn-success ml-2" id="enviar">Aceptar</button>
            </div>
        </div>
    </div>

    <!--MODAL DEL DETERIORO-->
    <div class="modal fade" id="modalDeterioroEditar" tabindex="-1" aria-labelledby="modalDeterioroEditar" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header btn-danger">
                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar Deterioro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body btn-default">
                    <div>
                        <table class="table table-head-bg-danger table-hover text-center" id="datatable-deterioro-editar">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Clasificacion</th>
                                    <th>Seleccione</th>
                                </tr>
                            </thead>
                            <tbody id="registrosDeterioro">
                                <?php while ($det = pg_fetch_assoc($deterioro)) { ?>
                                    <tr>
                                        <td><?php echo $det['det_nombre']; ?></td>
                                        <td><?php echo $det['det_tipo_deterioro']; ?></td>
                                        <td><?php echo $det['det_clasificacion']; ?></td>
                                        <td>
                                            <button class='btn btn-secondary botonModalDeterioro' id='selectDeterioro' data-id="<?php echo $det['det_id']; ?>" data-name="<?php echo $det['det_nombre'] ?>"><span><i class='fas fa-plus-circle text-light'></i></span></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer btn-default">
                    <input type="hidden" id="inputDestino" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de tramo -->
    <div class="modal fade" id="modalTramo" tabindex="-1" aria-labelledby="ModalTramo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header btn-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar Tramo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body btn-default">
                    <div>
                        <table class="table table-head-bg-warning table-hover" id="datatable-tramo-editar">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Direccion</th>
                                    <th>Nombre Via</th>
                                    <th>Jerarquia Vial</th>
                                    <th>Barrio</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody id="registrosTramo">
                                <?php
                                while ($tramos = pg_fetch_assoc($tramo)) {
                                    if ($tramos['tra_disponibilidad'] == 0 && $tramos['estado_id'] == 1) {
                                        echo "<tr>";
                                        echo "<td>" . $tramos['tra_codigo'] . "</td>";
                                        echo "<td>" . $tramos['tra_nomenclatura'] . "</td>";
                                        echo "<td>" . $tramos['tra_nombre_via'] . "</td>";
                                        echo "<td>" . $tramos['jer_descripcion'] . "</td>";
                                        echo "<td>" . $tramos['bar_descripcion'] . "</td>";
                                        echo "<td><button class='btn btn-secondary' id='selectTramo' data-anchoInicio='" . $tramos['tra_ancho_inicio'] . "' data-anchoFin='" . $tramos['tra_ancho_fin'] . "' value='" . $tramos['tra_id'] . "' data-codigo='" . $tramos['tra_codigo'] . "'><span><i class='fas fa-plus-circle text-light'></i></span></button></td>";
                                        echo "</tr>";
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer btn-default">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de entorno -->
    <div class="modal fade" id="modalEntorno" tabindex="-1" aria-labelledby="ModalEntorno" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header btn-success">
                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar Entorno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body btn-default">
                    <table class="table table-head-bg-success table-hover" style="text-align:center;" id="datatable-entorno-editar">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Seleccion</th>
                            </tr>
                        </thead>
                        <tbody id="registrosEntorno">
                            <?php

                            while ($entorno = pg_fetch_assoc($eject)) {
                            ?>
                                <tr>
                                    <td><?php echo $entorno['ent_descripcion'] ?></td>
                                    <td><button class="btn btn-info" id="seleccionarEntorno" value="<?php echo $entorno['ent_id'] ?>" data-name="<?php echo $entorno['ent_descripcion'] ?>" data-url="<?php echo getUrl("Caso", "Caso", "enviarEntorno", false, "ajax") ?>"><span><i class="fas fa-plus-circle text-light"></i></span></button></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer btn-default">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/core/prubea.js"></script>
<?php

}

?>