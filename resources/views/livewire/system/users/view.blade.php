<div class="card card-default">

    <div class="card-header">

        <div class="row">

            <div class="col-6">

                <h6>Lista de usuarios</h6>

            </div>

            <div class="col-6 text-right">

                @if( ___getAccessButton([]) )

                    <button type="button" class="btn btn-success elevation-2" data-toggle="modal" data-target="#createModal">
                        <i class="bx bx-fw bxs-plus-circle"></i> Nuevo usuario
                    </button>

                @else

                    <button type="button" class="btn btn-secondary" disabled>
                        <i class="bx bx-fw bxs-plus-circle"></i> Nuevo usuario
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
                            <th class="text-center">Correo</th>
                            <th class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach( $list_users as $key => $row )
                                <tr>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td wire:key="{{ $row->id }}" class="text-right">

                                        @if( ___getAccessButton([]) )

                                            <div wire:ignore class="btn-group dropdown mb-2">
                                                <button type="button" class="btn btn-primary elevation-2 dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item text-success" href="#" data-toggle="modal" data-target="#create-permission-modal" wire:click="permissions('{{ $row->id }}', '{{ $row->name }}')">
                                                        <i class='bx bx-fw bx-shield-quarter'></i> Permisos
                                                    </a>

                                                    <a class="dropdown-item text-primary" href="#" data-toggle="modal" data-target="#update-modal" wire:click="edit({{ $row->id }})">
                                                        <i class="bx bx-fw bxs-pencil"></i> Editar
                                                    </a>

                                                    <a class="dropdown-item text-danger" href="#" onclick="destroy('{{ $row->id }}')">
                                                        <i class="bx bx-fw bxs-trash-alt"></i> Eliminar
                                                    </a>

                                                </div>
                                            </div>

                                        @else

                                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>
                                                Opciones
                                            </button>

                                        @endif


                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

    @include('livewire.system.users.create')
    @include('livewire.system.users.permissions.create')
    @include('livewire.system.users.update')

</div>

@push('js')
    <script>

        initSelectCustomerSelect();

        $('.select2').on('change', function (e) {

            let item = $(this).attr('id');

            let model = $(this).attr('data-model');

            let data = $('#' + item).select2('val');

            @this.set(model, data);

        });

        window.livewire.on('select2',()=>{

            initSelectCustomerSelect();

        });

        Livewire.on('permissions', permissions => {

            @this.set('permissions', permissions);

            permissionsUser( permissions );

        });

        const permissionsUser = ( permissions ) => {

            $('.check-permission').prop('checked', false);

            if ( permissions ) {

                for ( permission of permissions  ) {

                    for ( checkRead of permission.read ) {

                        $('#checkBoxRead' + checkRead + permission.module_id).prop('checked', true);

                    }

                    for ( checkWrite of permission.write ) {

                        $('#checkBoxWrite' + checkWrite + permission.module_id).prop('checked', true);

                        $('#checkBoxRead' + checkWrite + permission.module_id).prop('checked', true);

                    }

                }

            }

        }

        const checkPermission = ( school_id, module_id, read, write ) => {

            if ( write == 1 ) {

                if ($('#checkBoxWrite' + school_id + module_id).is(':checked')) {

                    $('.check-module-' + school_id + '-' + module_id).prop('checked', true);

                }

            }

            if (!$('#checkBoxRead' + school_id + module_id).is(':checked')) {

                if ($('#checkBoxWrite' + school_id + module_id).is(':checked')) {

                    $('#checkBoxWrite' + school_id + module_id).prop('checked', false);

                }

            }

            let permissions_checked = [];

            $('.check-permission').map(function () {

                this.checked ? permissions_checked.push(this.value) : '';

            });

            for (permissions of permissions_checked) {

                let options = permissions.split('-');

                let deleted = options[0] + '-' + options[1] + '-' + options[2] + '-' + 0;

                if ( options[3] == 1 ) {

                    permissions_checked = jQuery.grep(permissions_checked, function (value) {

                        return value != deleted;

                    });

                }

            }

            let str_array_permission_selected = [];

            for (permissions of permissions_checked) {

                let access = permissions;

                let values = access.split('-');

                str_array_permission_selected.push({
                    'module_id': values[1],
                    'read'     : ( parseInt(values[3]) == 1 ) ? [] : [ values[0] ],
                    'write'    : ( parseInt(values[3]) == 1 ) ? [ values[0] ] : [],
                });

            }

            let result_permissions = str_array_permission_selected.reduce((str_group, permissions) => {

                let item = str_group.find(item => item.module_id == permissions.module_id)

                if (item == undefined) str_group = [...str_group, {...permissions}]

                else {

                    if ( permissions.read[0] ) {

                        item.read.push(permissions.read[0]);

                    }

                    if ( permissions.write[0] ) {

                        item.write.push(permissions.write[0]);

                    }

                }

                return str_group

            }, [])

            @this.set('permissions', '');

            @this.set('permissions', result_permissions);

        }


        Livewire.on('statusChangePassword', statusChangePassword => {

            $('#changePassword').hide();

            $('#checkChangePassword').prop('checked', statusChangePassword);

            @this.set('changePassword', false);

        });

        const changePassword = () => {

            if ( $('#checkChangePassword').is(':checked') ) {

                $('#changePassword').show('fast');

                @this.set('changePassword', true);

            } else {

                $('#changePassword').hide('fast');

                @this.set('changePassword', false);

            }

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

            });

        }

    </script>
@endpush
