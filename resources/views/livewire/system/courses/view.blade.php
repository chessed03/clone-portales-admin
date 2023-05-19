<div class="card card-default">

    <div class="card-header">

        <div class="row">

            <div class="col-6">

                <h6>Lista de Cursos</h6>

            </div>

            <div class="col-6 text-right">

                @if( ___getAccessButton([]) )

                    <a href="{{ route('course-create') }}">
                        <button class="btn btn-success elevation-2">
                            <i class="bx bx-fw bxs-plus-circle"></i> Nuevo curso
                        </button>
                    </a>

                @else

                    <button type="button" class="btn btn-secondary" disabled>
                        <i class="bx bx-fw bxs-plus-circle"></i> Nuevo curso
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
                            <th class="text-center">Nombre</th>
                            <th class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach( $rows as $key => $row )
                                <tr>
                                    <td>{{ $row->name }}</td>
                                    <td wire:key="{{ $row->id }}" class="text-right" wire:ignore>

                                        <div class="btn-group dropdown mb-2">

                                            <button type="button" class="btn btn-primary elevation-2 dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                Opciones

                                            </button>

                                            <div class="dropdown-menu">

                                                <a class="dropdown-item text-primary" href="{{ route('course-update', [ 'id' => $row->id ]) }}">

                                                    <i class="bx bx-fw bxs-pencil"></i> Editar

                                                </a>

                                                <a class="dropdown-item text-danger" href="#" onclick="destroy('{{ $row->id }}')">

                                                    <i class="bx bx-fw bxs-trash-alt"></i> Eliminar

                                                </a>

                                            </div>

                                        </div>

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