<?php

namespace App\Http\Livewire\System\Users;

use App\Models\System\User;
use App\Models\System\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners       = ['destroy'];
    
    public $paginateNumber     = 5;

    public $orderBy            = 3;

    public $updateMode         = false;

    public $keyWord, $selected_id, $name, $email, $password, $password_confirmation, $schools, $permissions, $changePassword;

    public function render()
    {

        $keyWord        = '%' . $this->keyWord . '%';

        $paginateNumber = $this->paginateNumber;

        $orderBy        = intval($this->orderBy);

        $list_users     = User::getAliveUsers( $keyWord, $paginateNumber, $orderBy );

        $list_schools   = User::getAliveSchools();

        $list_modules   = User::getAliveSubmodules();

        return view('livewire.system.users.view', [
            'list_users'   => $list_users,
            'list_schools' => $list_schools,
            'list_modules' => $list_modules
        ]);

    }

    public function messageAlert( $text, $icon )
    {

        $this->emit('message', $text, $icon);

    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('select2');
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
        $this->emit('closeCreateModal');
        $this->emit('closeUpdateModal');
        $this->hydrate();
    }

    private function resetInput()
    {

        $this->name                  = null;
        $this->email                 = null;
        $this->password              = null;
        $this->permissions           = null;
        $this->password_confirmation = null;

    }

    public function store()
    {
        $this->validate([
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required|confirmed|min:8'
        ]);

        $data = (object)[
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password
        ];

        $validateUserEmail = User::validateUserEmail( $this->email, null );

        if ( $validateUserEmail ) {

            $this->messageAlert( "Ups!, ya existe un usuario con el correo: $this->email.", 'error');

        } else {

            $result = User::createItem( $data );

            if ( $result ) {

                $this->messageAlert( 'Usuario creado correctamente.','success' );

            } else {

                $this->messageAlert( 'Ups! ocurrio un error.','error' );

            }

        }

        $this->resetInput();
        $this->emit('closeCreateModal');
        $this->hydrate();

    }

    public function permissions( $id, $name )
    {
        $this->selected_id      = $id;

        $this->name             = $name;

        $record                 = Permission::getPermissionsById( $id );

        if ( $record ) {

            $this->emit('permissions', $record->permissions);

        } else {

            $this->emit('permissions', null);

        }

    }

    public function storePermissions()
    {

        $data = (object)[
            'user_id'     => $this->selected_id,
            'permissions' => ( $this->permissions ) ? $this->permissions : []
        ];

        $result = Permission::generatePermissions( $data );

        if ( $result ) {

            $this->messageAlert( 'Permisos asignados correctamente.','success' );

        } else {

            $this->messageAlert( 'Existió un error.','error' );

        }

        $this->resetInput();
        $this->emit('closeCreateModal');
        $this->hydrate();

    }

    public function edit( $id )
    {
        $record            = User::findOrFail($id);

        $this->selected_id = $id;

        $this->name        = $record->name;

        $this->schools     = $record->schools;

        $this->email       = $record->email;

        $this->password    = null;

        $this->updateMode  = true;

        $this->emit('statusChangePassword', false);
    }

    public function update()
    {
        if ( $this->selected_id ) {
            
            if ( $this->changePassword ) {

                $this->validate([
                    'name'     => 'required',
                    'email'    => 'required',
                    'password' => 'required|confirmed|min:8'
                ]);

                $data = (object)[
                    'id'       => $this->selected_id,
                    'name'     => $this->name,
                    'email'    => $this->email,
                    'password' => $this->password
                ];

            } else {

                $this->validate([
                    'name'    => 'required',
                    'email'   => 'required'
                ]);

                $data = (object)[
                    'id'       => $this->selected_id,
                    'name'     => $this->name,
                    'email'    => $this->email,
                    'password' => false
                ];

            }
            
            $validateUserEmail = User::validateUserEmail( $this->email, $this->selected_id );

            if ( $validateUserEmail ) {

                $this->messageAlert( "Ups!, ya existe un usuario con el correo: $this->email.", 'error');
    
            } else {

                $result = User::updateItem( $data );

                if ( $result ) {

                    $this->messageAlert( 'Usuario actualizado correctamente.','success' );

                } else {

                    $this->messageAlert( 'Existió un error.','error' );

                }

            }

            $this->resetInput();
            $this->emit('closeUpdateModal');
            $this->updateMode = false;
            $this->hydrate();

        }

    }

    public function destroy( $id )
    {
        if ($id) {

            $destroy = User::destroyItem( $id );

            if ( $destroy ) {

                $this->messageAlert( 'Usuario eliminado.','success');

            } else {

                $this->messageAlert( 'Ups!, ocurrió un error','error');

            }
            
        }
    }

}
