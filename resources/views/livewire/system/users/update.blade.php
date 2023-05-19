<div wire:ignore.self id="update-modal" data-backdrop="static" class="modal fade update-modal" role="dialog">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content ">

            <div class="modal-header" style="background-color: #E5E5E5;">

                <h6>Editar</h6>

                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal"><i class='bx bx-x-circle'></i></button>

            </div>

            <div class="modal-body">

                <p class="sub-header form-group">
                    *Campos requeridos.
                </p>

                <form>

                    <input type="hidden" wire:model="selected_id">

                    <div class="row">

                        <div class="col-12">
                            <div class="card card-success card-outline">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <label for="name">Nombre: *</label>
                                            <input wire:model="name" type="text" class="form-control form-group">
                                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <label for="email">Correo electronico: *</label>
                                            <input wire:model="email" type="text" class="form-control form-group" autocomplete="off">
                                            @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-12 text-right">
                                            <div class="custom-control custom-switch custom-switch-on-success ml-4">
                                                <input type="checkbox" class="custom-control-input form-control form-group" id="checkChangePassword" onclick="changePassword()">
                                                <label class="custom-control-label" for="checkChangePassword">Cambiar password</label>
                                            </div>
                                        </div>

                                        <div wire:ignore id="changePassword" class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                            <div class="row">

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                    <label for="password">Password: *</label>
                                                    <input wire:model="password" type="password" class="form-control form-group" autocomplete="off">
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                    <label for="password_confirmation">Repetir password: *</label>
                                                    <input wire:model="password_confirmation" type="password" class="form-control form-group">
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-danger elevation-2" data-dismiss="modal"><i class='bx-fw bx bx-x-circle'></i> Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-success elevation-2"><i class='bx-fw bx bx-save'></i> Guardar</button>
            </div>

        </div>

    </div>

</div>
