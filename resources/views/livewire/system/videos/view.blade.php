<div class="card card-default">

    <div class="card-header">

        <div class="row">

            <div class="col-6">

                <h6>Lista de Videos</h6>

            </div>

            <div class="col-6 text-right">

                @if( ___getAccessButton( [] ) )

                    <a href="{{ route('video-create') }}">
                        <button class="btn btn-success elevation-2">
                            <i class="bx bx-fw bxs-plus-circle"></i> Nuevo video
                        </button>
                    </a>

                @else

                    <button type="button" class="btn btn-secondary" disabled>
                        <i class="bx bx-fw bxs-plus-circle"></i> Nuevo video
                    </button>

                @endif

            </div>

        </div>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <label for="keyWord">Búsqueda</label>
                <input type="text" wire:model='keyWord' id="keyWord" class="form-control">
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <label for="orderBy">Ordenado</label>
                <select wire:model='orderBy' id="orderBy" class="form-control">
                    <option value="1">De A a la Z</option>
                    <option value="2">De Z a la A</option>
                    <option value="3">Más recientes primero</option>
                    <option value="4">Más antiguos primero</option>
                </select>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
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
                            <th class="text-center">Video</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Institución</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach( $rows as $key => $row )
                                <tr>
                                    <td>
                                        <a href="{{ route('video-update', [ 'id' => $row->id ]) }}" title="Editar elemento"> {{ $row->name }} </a>
                                    </td>
                                    <td class="text-center" wire:key="check-{{ $row->id }}">

                                        <div class="custom-control custom-switch custom-switch-on-success ml-4">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input check-video-{{ $row->id }}"
                                                wire:click="setActiveStatus({{ $row->id  }})"
                                                id="checkBoxStatus{{ $row->id }}"
                                                value="{{ $row->id }}" {{ ( $row->status == 1 ) ? 'checked' : '' }} @if( !___getAccessButton( [ $row->school_id ] ) )  disabled="" @endif
                                            >
                                            <label class="custom-control-label" for="checkBoxStatus{{ $row->id }}">&nbsp;</label>
                                        </div>

                                    </td>
                                    <td class="text-center"><h6><span class="badge badge-pill bg-info ml-1 mr-1">{{ $row->dataSchool->name }}</span></h6></td>
                                    <td class="text-right" wire:key="dropdown-{{ $row->id }}">

                                        @if( ___getAccessButton( [ $row->school_id ] ) )

                                            <a class="btn btn-circle btn-primary elevation-2 mr-2" title="Editar" href="{{ route('video-update', [ 'id' => $row->id ]) }}">

                                                <i class="bx bx-fw bxs-pencil"></i>

                                            </a>

                                            <a class="btn btn-circle btn-danger elevation-2" title="Eliminar" href="#" onclick="destroy('{{ $row->id }}')">

                                                <i class="bx bx-fw bxs-trash-alt"></i>

                                            </a>

                                        @else

                                            <a class="btn btn-circle btn-primary elevation-2 mr-2" title="Editar" href="#" style="opacity: 0.5; cursor: not-allowed;">

                                                <i class="bx bx-fw bxs-pencil"></i>

                                            </a>

                                            <a class="btn btn-circle btn-danger elevation-2" title="Eliminar" href="#" style="opacity: 0.5; cursor: not-allowed;">

                                                <i class="bx bx-fw bxs-trash-alt"></i>

                                            </a>

                                        @endif

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
