<div wire:ignore.self id="create-permission-modal" data-backdrop="static" class="modal fade create-modal" role="dialog">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content ">

            <div class="modal-header" style="background-color: #E5E5E5;">

                <h6>Permisos</h6>

                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal"><i class='bx bx-x-circle'></i></button>

            </div>

            <div class="modal-body">

                @error('permissions') <span class="error text-danger">{{ $message }}</span> @enderror

                <div class="row">
                    <div class="col-12">
                        <div class="card card-success card-outline">

                            <div class="card-header">

                                <div class="row">

                                    <div class="col-6">
                                        <label>Usuario: <strong>&nbsp;{{ $name }}</strong></label>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <form>

                    <input type="hidden" wire:model="selected_id">

                    <div class="row">

                        <div class="col-12">

                            <div class="row">

                                @if ( $list_schools )

                                    @foreach( $list_schools as $s => $school)

                                        <div wire:ignore class="col-4">

                                            <div class="card card-success card-outline collapsed-card">

                                                <div class="card-header">

                                                    <label class="card-title">{{ $school->name }}</label>

                                                    <div class="card-tools">

                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="changeIcon('{{ $school->id }}')">

                                                            <i class='bx bx-expand-alt bx-border-circle font-weight-bold' id="headerIconCard{{ $school->id }}"></i>

                                                        </button>

                                                    </div>

                                                </div>

                                                <div class="card-body">

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                                        <div class="row">

                                                            @foreach( $list_modules as $m => $menu )

                                                                @foreach( $menu['modules'] as $k => $module )

                                                                    <div class="col-12">
                                                                        <label><i class='bx bx-fw bx-chevron-right'></i>{{ $module['module_name'] }}</label>
                                                                    </div>

                                                                    <div wire:key="{{ $s . $m . $k . 'read' }}" class="col-12">
                                                                        <div class="custom-control custom-switch custom-switch-on-success ml-4">
                                                                            <input
                                                                                type="checkbox"
                                                                                class="custom-control-input check-permission check-module-{{ $school->id . '-' . $module['module_id'] }}"
                                                                                onclick="checkPermission({{ $school->id }}, {{ $module['module_id']}}, 1, 0)"
                                                                                id="checkBoxRead{{ $school->id . $module['module_id'] }}"
                                                                                value="{{ $school->id . '-' . $module['module_id'] . '-1-0' }}"
                                                                            >
                                                                            <label class="custom-control-label" for="checkBoxRead{{ $school->id . $module['module_id'] }}">Ver</label>
                                                                        </div>
                                                                    </div>
                                                                    <div wire:key="{{ $s . $m . $k . 'write' }}" class="col-12">
                                                                        <div class="custom-control custom-switch custom-switch-on-success ml-5">
                                                                            <input
                                                                                type="checkbox"
                                                                                class="custom-control-input check-permission check-module-{{ $school->id . '-' . $module['module_id'] }}"
                                                                                onclick="checkPermission({{ $school->id }}, {{ $module['module_id'] }}, 1, 1)"
                                                                                id="checkBoxWrite{{ $school->id . $module['module_id'] }}"
                                                                                value="{{ $school->id . '-' . $module['module_id'] . '-1-1' }}"
                                                                            >
                                                                            <label class="custom-control-label" for="checkBoxWrite{{ $school->id . $module['module_id'] }}">Modificar</label>
                                                                        </div>
                                                                    </div>

                                                                @endforeach

                                                            @endforeach

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                @endif

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-danger elevation-2" data-dismiss="modal"><i class='bx-fw bx bx-x-circle'></i> Cerrar</button>
                <button type="button" wire:click.prevent="storePermissions()" class="btn btn-success elevation-2"><i class='bx-fw bx bx-save'></i> Guardar</button>
            </div>

        </div>

    </div>

</div>
