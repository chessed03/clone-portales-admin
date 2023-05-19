<?php

namespace App\Http\Livewire\System\Certifications;

use App\Models\System\Certification;
use Livewire\Component;
use Livewire\WithPagination;

class Certifications extends Component
{
   
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners       = ['destroy'];

    public $paginateNumber     = 5;

    public $orderBy            = 3;

    public $keyWord;

    public function render()
    {

        $keyWord        = '%' . $this->keyWord . '%';

        $paginateNumber = $this->paginateNumber;

        $orderBy        = intval($this->orderBy);

        $list_schools   = Certification::getAliveSchools();

        $rows           = Certification::getAliveCertificationsForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.certifications.view', [
            'rows'         => $rows,
            'list_schools' => $list_schools,
        ]);

    }

    public function messageAlert( $text, $icon )
    {

        $this->emit('message', $text, $icon);

    }

    public function destroy( $id )
    {
        if ($id) {

            $destroy = Certification::destroyItem( $id );

            if ( $destroy ) {

                $this->messageAlert( 'Certificación eliminada.','success');

            } else {

                $this->messageAlert( 'Ups!, ocurrió un error','error');

            }        

        }
    }

}
