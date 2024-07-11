<x-app-layout>

    <h1 class="h1Docente">Coordinador: Modificar estudiantes</h1>

    <button id="open-add-representante" class="agregarData">
        <i class="fas fa-plus mr-2"></i> Agregar estudiante
    </button>

    <div class="col-lg-8 panel-carga-academica">
        <div class="panel panel-default panel-carga-academica">
            <div class="panel-heading text-table-head">Listado de estudiantes</div>
                    <div class="row">

                        <div class="entradas_search distancia_show"><select class="border_radio" name="entradas">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> entradas por pagina</label>

                        <div class="buscar_pag distancia_left"><label>Buscar por Cedula:</label><input class="border_radio" type="search" id="dt-search-0">
                        </div>
                    </div>

                        <div class="col-sm-12 padding-carga">
                            <table width="100%"
                                class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                                id="dataTables" role="grid" aria-describedby="dataTables_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;">Cedula</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">Nombre</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">Apellido</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 130px;">Fecha de nacimiento</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;">Ult. Grado</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 30px;">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <th scope="row">30293487</th>
                                        <td>FRANCISCO JAVIER</td>
                                        <td>ISEA GARCIA</td>
                                        <td>09-09-2003</td>
                                        <td>5to</td>
                                        <td>
                                            <button id="open-alert-edit" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button id="open-alert-deletedata" class="btn bottom-delete">
                                                <i class="fa-solid fa-box-archive"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">30184084</th>
                                        <td>KEVIN ALEJANDRO</td>
                                        <td>RODRIGUEZ ZANOJA</td>
                                        <td>01-01-2004</td>
                                        <td>4to</td>
                                        <td>
                                            <button id="open-alert-edit" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button id="open-alert-deletedata" class="btn bottom-delete">
                                                <i class="fa-solid fa-box-archive"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <th scope="row">30559875</th>
                                        <td>VALENTÍN ANDRÉS</td>
                                        <td>BRAVO BRITO</td>
                                        <td>06-07-2003</td>
                                        <td>5to</td>
                                        <td>
                                            <button id="open-alert-edit" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button id="open-alert-deletedata" class="btn bottom-delete">
                                                <i class="fa-solid fa-box-archive"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">2487565</th>
                                        <td>CARLOS ALBERTO</td>
                                        <td>HERNANDEZ TORRES</td>
                                        <td>03-04-2005</td>
                                        <td>3ro</td>
                                        <td>
                                            <button id="open-alert-edit" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button id="open-alert-deletedata" class="btn bottom-delete">
                                                <i class="fa-solid fa-box-archive"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <th scope="row">29097581</th>
                                        <td>MARIA ALEJANDRA</td>
                                        <td>MUJICA PEREZ</td>
                                        <td>02-06-2005</td>
                                        <td>4to</td>
                                        <td>
                                            <button id="open-alert-edit" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button id="open-alert-deletedata" class="btn bottom-delete">
                                                <i class="fa-solid fa-box-archive"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">31257895</th>
                                        <td>GREGORY ZIEGLAR</td>
                                        <td>RUIZ VELAZQUEZ</td>
                                        <td>28-06-2005</td>
                                        <td>2do</td>
                                        <td>
                                            <button id="open-alert-edit" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button id="open-alert-deletedata" class="btn bottom-delete">
                                                <i class="fa-solid fa-box-archive"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <th scope="row">30254875</th>
                                        <td>SILVANA YERITZA</td>
                                        <td>URDANETA MENESES</td>
                                        <td>05-08-2006</td>
                                        <td>1ro</td>
                                        <td>
                                            <button id="open-alert-edit" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button id="open-alert-deletedata" class="btn bottom-delete">
                                                <i class="fa-solid fa-box-archive"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 ajust-right">
                                <div class="dataTables_info" id="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 7
                                    entries</div>
                            </div>
                            <div class="col-sm-6 ajust-left">
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTables_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button previous disabled" aria-controls="dataTables" tabindex="0"
                                            id="dataTables_previous"><a href="#">Previous</a></li>
                                        <li class="paginate_button active" aria-controls="dataTables" tabindex="0"><a href="#">1</a></li>
                                        <li class="paginate_button " aria-controls="dataTables" tabindex="0"><a href="#">2</a></li>
                                        <li class="paginate_button " aria-controls="dataTables" tabindex="0"><a href="#">3</a></li>
                                        <li class="paginate_button " aria-controls="dataTables" tabindex="0"><a href="#">4</a></li>
                                        <li class="paginate_button " aria-controls="dataTables" tabindex="0"><a href="#">5</a></li>
                                        <li class="paginate_button disabled" aria-controls="dataTables" tabindex="0" id="dataTables_ellipsis"><a
                                                href="#">…</a></li>
                                        <li class="paginate_button " aria-controls="dataTables" tabindex="0"><a href="#">12</a></li>
                                        <li class="paginate_button next" aria-controls="dataTables" tabindex="0" id="dataTables_next"><a
                                                href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                    </div>
                </div>


                <!---OK AQUI ES MODIFICACION-->
                <dialog id="alert-edit">
                <h1 class="h1Advertencia">¡ADVERTENCIA!</h1>
                <p>Estás a punto de guardar/modificar datos importantes, ¿seguro/a que quieres realizar esta acción?</p>
                <p class="text-black-alert">   Si no deseas realizar los cambios presiona la tecla "Esc" o "Escape"</p>

                <div class="col-lg-8 panel-modificacion-datos">
                    <div class="panel panel-default panel-modificacion-datos">
                        <div class="panel-heading text-table-head">Informacion del representante</div>
                                    <div class="col-sm-12 padding-carga">
                                        <table width="100%"
                                            class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                                            id="dataTables" role="grid" aria-describedby="dataTables_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;">Cedula</th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">Nombre</th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">Apellido</th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 130px;">Fecha de nacimiento</th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;">Ult. Grado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr role="row" class="odd">
                                                    <th> <div class="casilla_editora"> <input class="form-control" value="30293487"></div> </th>
                                                    <td> <div class="casilla_editora"> <input class="form-control" value="FRANCISCO JAVIER"></div> </td>
                                                    <td> <div class="casilla_editora"> <input class="form-control" value="ISEA GARCIA"></div> </td>
                                                    <td> <div class="casilla_editora"> <input class="form-control" value="09-09-2003"></div> </td>
                                                    <td> <div class="casilla_editora"> <input class="form-control" value="5to"></div> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                    </div>
                </div>

                <button id="close-alert-edit" class="btn btn-confirm form-control text-default ajust-btn">Confirmar cambios</button>
                </dialog>

                <!-- FIN MODIFICAR DATOS-->

                <!-- AHORA VAMOS A AGREGARLOS COMO KE NOO0O0O0OO0O0 holis uwu owo nwn nya-->

                <dialog id="add-representante">
                    <h1 class="h1Advertencia">¡ADVERTENCIA!</h1>
                    <p>Estás a punto de agregar en la tabla un nuevo estudiante, ¿seguro/a que quieres realizar esta acción?</p>
                    <p class="text-black-alert">   Si no deseas realizar los cambios presiona la tecla "Esc" o "Escape"</p>
    
                    <div class="col-lg-8 panel-agregar-datos">
                        <div class="panel panel-default panel-agregar-datos">
                            <div class="panel-heading text-table-head">Informacion del estudiante</div>
                                        <div class="col-sm-12 padding-carga">
                                            <table width="100%"
                                                class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                                                id="dataTables" role="grid" aria-describedby="dataTables_info" style="width: 100%;">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;">Cedula</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">Nombre</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">Apellido</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 130px;">Fecha de nacimiento</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;">Ult. Grado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <th> <div class="casilla_editora"> <input class="form-control" value=""></div> </th>
                                                        <td> <div class="casilla_editora"> <input class="form-control" value=""></div> </td>
                                                        <td> <div class="casilla_editora"> <input class="form-control" value=""></div> </td>
                                                        <td> <div class="casilla_editora"> <input class="form-control" value=""></div> </td>
                                                        <td> <div class="casilla_editora"> <input class="form-control" value=""></div> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                        </div>
                    </div>
    
                    <button id="close-add-representante" class="btn btn-confirm form-control text-default ajust-btn">Confirmar</button>
                    </dialog>

                    <!-- FIN AGREGAR -->


                    <!--- ELIMINAR -->
                    <dialog id="alert-deletedata">
                        <h1 class="h1Advertencia" style="color: red">¡IMPORTANTE!</h1>
                        <p>Estás a punto de eliminar datos importantes, ¿seguro/a que quieres realizar esta acción?</p>
                        <p class="text-black-alert" style="color: red">   Si no deseas realizar los cambios presiona la tecla "Esc" o "Escape"</p>
                        <button id="close-alert-deletedata" class="btn btn-confirm form-control text-default">Confirmar cambios</button>
                    </dialog>
                    <!-- FIN ELIMINAR -->

            
            
            </div>
        </div>
    </div>

</x-app-layout>