<x-app-layout>

    <h1 class="h1Docente">Coordinador: Modificar representantes</h1>

    <button id="open-add-representante" class="agregarData">
        <i class="fas fa-plus mr-2"></i> Agregar representante
    </button>

    <div class="col-lg-8 panel-carga-academica">
        <div class="panel panel-default panel-carga-academica">
            <div class="panel-heading text-table-head">Listado de representantes</div>
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
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">Dirección</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 30px;">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <th scope="row">3655066</th>
                                        <td>MARIA DEL VALLE</td>
                                        <td>ORTIZ</td>
                                        <td>Disgreca</td>
                                        <td>
                                            <button id="open-alert-edit" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">3975584</th>
                                        <td>AMARA MONICA</td>
                                        <td>SALVADOR PEREZ</td>
                                        <td>Las Lomas</td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <th scope="row">14536874</th>
                                        <td>YURIBILEIXIS JOANNYSON</td>
                                        <td>RODRIGUEZ HERNANDEZ</td>
                                        <td>Core 8 sin asfalto</td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">16879365</th>
                                        <td>MARIA ALEJANDRA</td>
                                        <td>PACHECO FUENTES</td>
                                        <td>Unare I</td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <th scope="row">16955789</th>
                                        <td>CARLOS ERNESTO</td>
                                        <td>MILLAN</td>
                                        <td>Las garzas</td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <th scope="row">21008756</th>
                                        <td>JUAN ALMEIDA</td>
                                        <td>MISOGINO ESCONTIGO</td>
                                        <td>Caracas</td>
                                        <td>
                                            <button type="refresh" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <th scope="row">22365791</th>
                                        <td>BLACKPINK INDUSTRIA</td>
                                        <td>MUSICAL POP</td>
                                        <td>Corea</td>
                                        <td>
                                            <button id="open-alert-edit" class="btn bottom-success">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
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
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">Dirección</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr role="row" class="odd">
                                                    <th> <div class="casilla_editora"> <input class="form-control" value="3655066"></div> </th>
                                                    <td> <div class="casilla_editora"> <input class="form-control" value="MARIA DEL VALLE"></div> </td>
                                                    <td> <div class="casilla_editora"> <input class="form-control" value="ORTIZ"></div> </td>
                                                    <td> <div class="casilla_editora"> <input class="form-control" value="Disgreca"></div> </td>
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
                    <p>Estás a punto de agregar en la tabla un nuevo representante, ¿seguro/a que quieres realizar esta acción?</p>
                    <p class="text-black-alert">   Si no deseas realizar los cambios presiona la tecla "Esc" o "Escape"</p>
    
                    <div class="col-lg-8 panel-agregar-datos">
                        <div class="panel panel-default panel-agregar-datos">
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
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">Dirección</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <th> <div class="casilla_editora"> <input class="form-control" value=""></div> </th>
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

            
            
            </div>
        </div>
    </div>

</x-app-layout>