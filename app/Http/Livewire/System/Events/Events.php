<?php

namespace App\Http\Livewire\System\Events;

use App\Models\System\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Events extends Component
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

        $list_schools   = Event::getAliveSchools();

        $rows           = Event::getAliveEventsForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.events.view', [
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

            $destroy = Event::destroyItem( $id );

            if ( $destroy ) {

                $this->messageAlert( 'Evento eliminado.','success');

            } else {

                $this->messageAlert( 'Ups!, ocurrió un error','error');

            }        

        }
    }

}
