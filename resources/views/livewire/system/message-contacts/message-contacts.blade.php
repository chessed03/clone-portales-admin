<div class="card card-default">

    <div class="card-header">

        <div class="row">

            <div class="col-6">

                <h6>Lista de mensajes de contactos</h6>

            </div>

            <div class="col-6 text-right">

                <a href="{{ route('messageContact-generateExcel', [ 'typeMessage' => $typeMessage ]) }}" class="btn btn-info elevation-2" title="Exporta a XLS"><i class='bx bx-fw bxs-file-export'></i> Generar excel</a>


            </div>

        </div>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <label for="keyWord">Búsqueda</label>
                <input type="text" wire:model='keyWord' id="keyWord" class="form-control">
            </div>

            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <label for="typeMessage">Tipo</label>
                <select wire:model='typeMessage' id="typeMessage" class="form-control">
                    <option value="1">No Leídos</option>
                    <option value="2">Leídos</option>
                    <option value="3">Todos</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <label for="orderBy">Ordenado</label>
                <select wire:model='orderBy' id="orderBy" class="form-control">
                    <option value="3">Más recientes primero</option>
                    <option value="4">Más antiguos primero</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <label for="paginateNumber">Mostrando</label>
                <select wire:model='paginateNumber' id="paginateNumber" class="form-control">
                    <option value="5" selected>&nbsp;&nbsp;5 Registros</option>
                    <option value="10">&nbsp;10 Registros</option>
                    <option value="25">&nbsp;25 Registros</option>
                    <option value="50">&nbsp;50 Registros</option>
                    <option value="100">100 Registros</option>
                </select>
            </div>

            <div class="col-12 mt-4">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Institución</th>
                            <th class="text-center">Mensaje</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $key => $row)
                                <tr>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td class="text-center">
                                        @if( $row->status != 1 )

                                            <span class="text-success">
                                                <i class='bx bx-fw bx-message-rounded-check'></i> Leído
                                            </span>

                                        @else

                                            <span class="text-secondary">
                                                <i class='bx bxs-message-rounded-detail'></i> No leído
                                            </span>

                                        @endif
                                    </td>
                                    <td class="text-center">{{ \Carbon\Carbon::createFromDate($row->created_at)->isoFormat('LL') }}</td>
                                    <td class="text-center"><h6><span class="badge badge-pill bg-info ml-1 mr-1">{{ $row->dataSchool->name }}</span></h6></td>
                                    <td class="text-right">

                                        <!-- Large modal -->
                                        <button type="button" class="btn btn-circle btn-primary elevation-2 mr-2" data-toggle="modal" data-target=".message-contact-modal{{ $key }}" title="Ver mensaje">
                                            <i class="bx bx-fw bxs-bullseye"></i>
                                        </button>

                                        <div data-backdrop="static" class="modal fade message-contact-modal{{ $key }}" role="dialog">

                                            <div class="modal-dialog modal-xl modal-dialog-centered">

                                                <div class="modal-content ">

                                                    <div class="modal-header" style="background-color: #E5E5E5;">

                                                        <h6>Mensaje</h6>

                                                        <button type="button" class="close" data-dismiss="modal" onclick="checkRead('{{ $row->id }}')"><i class='bx bx-x-circle'></i></button>

                                                    </div>

                                                    <div class="modal-body">


                                                        <div class="row">

                                                            <div class="col-12 text-center">
                                                                <h1>Información del contacto</h1>
                                                            </div>

                                                            <div class="col-4" class="text-center">

                                                                <img src="https://ipes2.s3.us-east-2.amazonaws.com/64236cdfe4f1d-image-1.png" alt="image" title="image" width="320px" height="220px"/>

                                                            </div>

                                                            <div class="col-8">
                                                                <div class="v-text-align v-line-height v-font-size" style="line-height: 170%; text-align: justify; word-wrap: break-word;">
                                                                    <strong><p style="line-height: 170%;">Nombre</p></strong>
                                                                    <p style="line-height: 170%; background-color: #f0f0f0; border-radius: 5px; padding: 15px;">{{ $row->name }}</p>
                                                                    <strong><p style="line-height: 170%;">Correo</p></strong>
                                                                    <p style="line-height: 170%; background-color: #f0f0f0; border-radius: 5px; padding: 15px;">{{ $row->email }}</p>
                                                                    <strong><p style="line-height: 170%;">Telefono</p></strong>
                                                                    <p style="line-height: 170%; background-color: #f0f0f0; border-radius: 5px; padding: 15px;">{{ $row->phone }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="v-text-align v-line-height v-font-size" style="line-height: 170%; text-align: justify; word-wrap: break-word; background-color: #f0f0f0; border-radius: 10px; padding: 20px;">

                                                                    <div class="row">
                                                                        <div class="col-6"><strong><p style="line-height: 170%;">Mensaje</p></strong></div>
                                                                        <div class="col-6 text-right"><strong><p style="line-height: 170%;">Fecha:</strong> {{ \Carbon\Carbon::createFromDate($row->created_at)->isoFormat('LL') }}</p></div>
                                                                    </div>

                                                                    <p style="line-height: 170%;">{{ $row->message }}</p>

                                                                    <p style="line-height: 170%;"><strong>Mensaje proveniente de</strong> <a href="{{ $row->way_access }}">{{ $row->way_access }}</a></p>

                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger elevation-2" data-dismiss="modal" onclick="checkRead('{{ $row->id }}')"><i class='bx bx-fw bx-x-circle'></i> Cerrar</button>
                                                        <button type="button" class="btn btn-success elevation-2" data-dismiss="modal" onclick="checkRead('{{ $row->id }}')"><i class='bx bx-fw bxs-check-circle'></i> Aceptar</button>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        {{--<a class="btn btn-circle btn-danger elevation-2" title="Eliminar" href="#" onclick="destroy('{{ $row->id }}')">

                                            <i class="bx bx-fw bxs-trash-alt"></i>

                                        </a>--}}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div>

                    {!! $rows->links() !!}

                </div>

            </div>

        </div>

    </div>

</div>

@push('js')

    <script>

        const checkRead = ( id ) => {

            window.livewire.emit('messageRead', id);

        }

        const destroy = ( id ) => {

            swalWithBootstrapButtons.fire({
                title:"Estás apunto de eliminar un registro",
                text:"El registro ya no será visible",
                icon:"warning",
                showCancelButton: true,
                confirmButtonText:"<i class='bx bx-fw bxs-check-circle'></i> Aceptar",
                cancelButtonText: "<i class='bx bx-fw bxs-x-circle'></i> Cancelar",
                reverseButtons: true
            }).then(function(option){

                if ( option.value ) {

                    window.livewire.emit('destroy', id);

                }

            })

        }

    </script>

@endpush
