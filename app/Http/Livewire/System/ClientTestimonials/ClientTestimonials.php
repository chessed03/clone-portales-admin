<?php

namespace App\Http\Livewire\System\ClientTestimonials;

use App\Models\System\ClientTestimonial;
use Livewire\Component;
use Livewire\WithPagination;

class ClientTestimonials extends Component
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

        $list_schools   = ClientTestimonial::getAliveSchools();

        $rows           = ClientTestimonial::getAliveClientTestimonialsForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.client-testimonials.view', [
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

            $destroy = ClientTestimonial::destroyItem( $id );

            if ( $destroy ) {

                $this->messageAlert( 'Enlace eliminado.','success');

            } else {

                $this->messageAlert( 'Ups!, ocurrió un error','error');

            }

        }
    }
}
