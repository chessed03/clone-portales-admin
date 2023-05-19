<?php

namespace App\Http\Livewire\System\Sites;

use App\Models\System\Site;
use Livewire\Component;
use Livewire\WithPagination;

class Sites extends Component
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

        $list_schools   = Site::getAliveSchools();

        $rows           = Site::getAliveSitesForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.sites.view', [
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

            $validate = Site::validateDestroy( $id );
            
            if ( $validate ) {

                $this->messageAlert( "el sitio está vinculado en {$validate->located}.",'info');
                
            } else {

                $destroy = Site::destroyItem( $id );

                if ( $destroy ) {

                    $this->messageAlert( 'Sitio eliminado.','success');

                } else {

                    $this->messageAlert( 'Ups!, ocurrió un error','error');

                }
            
            }

        }
    }

}
