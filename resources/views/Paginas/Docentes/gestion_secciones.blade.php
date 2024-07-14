<x-app-layout>

    <h1 class="h1Docente">Ver seccion academica</h1>

    <div class="ajuste-tablas">

        <!--TABLA DE BUSQUEDA DE MATERIA Y SECCION-->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading text-table-head">Panel de cargas academicas</div>
                <div class="panel-body">
                    <form class="form-signin" id="settingsform" autocomplete="off">
                        <label class="text-default-black">Buscar asignatura</label>
                        <div class="input-group" style="width:100%">
                            <select class="form-control">
                                <option value="100000">MATEMATICA</option>
                                <option value="100001">FISICA</option>
                                <option value="100002">QUIMICA</option>
                            </select>
                            <span class="input-group-addon"
                                style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                        </div>
                    </form>
                    <form class="form-signin" id="settingsform" autocomplete="off">
                        <label class="text-default-black">Buscar seccion</label>
                        <div class="input-group" style="width:100%">
                            <select name="_search" class="form-control">
                                <option value="1">A</option>
                                <option value="2">B</option>
                                <option value="3">C</option>
                                <option value="4">D</option>
                            </select>
                            <span class="input-group-addon"
                                style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                            <button type="submit" class="btn btn-success form-control text-default">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!---TABLA DE ALUMNOS Y CARGA--->
        <div class="col-lg-8">
            <div class="panel panel-carga-seccion panel-default">
                <div class="panel-heading text-table-head">Listado de alumnos inscritos</div>
                <div class="panel-body">
                    <div id="dataTables_wrapper"
                        class="dataTables_wrapper form-inline dt-bootstrap no-footer text-default">
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table width="100%"
                                class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                                id="dataTables" role="grid" aria-describedby="dataTables_info" style="width: 100%;">
                                <thead>
                                    <tr role="row" class="info-table-head">
                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                            style="width: 100px;">Cedula</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                            style="width: 300px;">Nombres</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                            style="width: 300px;">Apellidos</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                            style="width: 300px;">Observacion</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 30px;">
                                            Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <th scope="row">30293487</th>
                                        <td>FRANCISCO JAVIER</td>
                                        <td>ISEA GARCIA</td>
                                        <td>
                                            <div id="observation"><input class="form-control" value=""></div>
                                        </td>
                                        <td>
                                            <button id="open-alert-changes" class="btn bottom-success">
                                                <i class="fa-solid fa-window-restore"></i> </span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">29906987</th>
                                        <td>JOEY RAYAN</td>
                                        <td>DANIELS RUIZ</td>
                                        <td>
                                            <div id="observation"><input class="form-control" value=""></div>
                                        </td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-window-restore"></i> </span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <th scope="row">30498257</th>
                                        <td>MARIA DEL VALLE</td>
                                        <td>NAVARRO RAMOS</td>
                                        <td>
                                            <div id="observation"><input class="form-control" value=""></div>
                                        </td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-window-restore"></i> </span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">30366096</th>
                                        <td>ANGEL PAUL</td>
                                        <td>GONZALEZ CASTILLO</td>
                                        <td>
                                            <div id="observation"><input class="form-control" value=""></div>
                                        </td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-window-restore"></i> </span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <th scope="row">32059780</th>
                                        <td>KEINER JOSE</td>
                                        <td>FRONTADO FIGUERA</td>
                                        <td>
                                            <div id="observation"><input class="form-control" value=""></div>
                                        </td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-window-restore"></i> </span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">30231978</th>
                                        <td>MIGUEL ANGEL</td>
                                        <td>LINARES AVILA</td>
                                        <td>
                                            <div id="observation"><input class="form-control" value=""></div>
                                        </td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-window-restore"></i> </span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <th scope="row">30664502</th>
                                        <td>JEANNYBETH DALOWTY</td>
                                        <td>HERRERA LALL</td>
                                        <td>
                                            <div id="observation"><input class="form-control" value=""></div>
                                        </td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-window-restore"></i> </span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">30577090</th>
                                        <td>BRAYAN EDUARDO</td>
                                        <td>CASANOVA AGUILERA</td>
                                        <td>
                                            <div id="observation"><input class="form-control" value=""></div>
                                        </td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-window-restore"></i> </span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <th scope="row">29643097</th>
                                        <td>OCTAVIO JOSE</td>
                                        <td>MALAVE RONDON</td>
                                        <td>
                                            <div id="observation"><input class="form-control" value=""></div>
                                        </td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-window-restore"></i> </span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">30857308</th>
                                        <td>ANDREW XANDER</td>
                                        <td>PUERTA VELIZ</td>
                                        <td>
                                            <div id="observation"><input class="form-control" value=""></div>
                                        </td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-window-restore"></i> </span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog id="alert-changes">
        <h1 class="h1Advertencia">¡ADVERTENCIA!</h1>
        <p>Estás a punto de guardar/modificar datos importantes, ¿seguro/a que quieres realizar esta acción?</p>
        <p class="text-black-alert"> Si no deseas realizar los cambios presiona la tecla "Esc" o "Escape"</p>
        <button id="close-alert-changes" class="btn btn-confirm form-control text-default">Confirmar cambios</button>
    </dialog>


    </div>

</x-app-layout>
