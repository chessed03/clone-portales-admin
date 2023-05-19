<?php

namespace App\Http\Livewire\System\BannerTwoInformations;

use App\Models\System\BannerTwoInformation;
use Livewire\Component;
use Livewire\WithPagination;

class BannerTwoInformations extends Component
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

        $list_schools   = BannerTwoInformation::getAliveSchools();

        $rows           = BannerTwoInformation::getAliveBannerTwoInformationsForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.banner-two-informations.view', [
            'rows'         => $rows,
            'list_schools' => $list_schools,
        ]);
    }

    public function messageAlert( $text, $icon )
    {

        $this->emit('message', $text, $icon);

    }

    public function setActiveStatus( $id )
    {

        BannerTwoInformation::setActiveStatus( $id );

    }

    public function destroy( $id )
    {
        if ($id) {

            $validateStatus = BannerTwoInformation::where('id', $id)
                ->where('status', BannerTwoInformation::ALIVE)
                ->first();
            
            if ($validateStatus) {

                $this->messageAlert( 'Ups!, El registro está activo','info');

            } else {

                $destroy = BannerTwoInformation::destroyItem( $id );

                if ( $destroy ) {

                    $this->messageAlert( 'Información eliminada.','success');

                } else {

                    $this->messageAlert( 'Ups!, ocurrió un error','error');

                }
            
            }        

        }
    }
}
