<?php

namespace App\Http\Livewire\System\BannerOneInformations;

use App\Models\System\BannerOneInformation;
use Livewire\Component;
use Livewire\WithPagination;


class BannerOneInformations extends Component
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

        $list_schools   = BannerOneInformation::getAliveSchools();

        $rows           = BannerOneInformation::getAliveBannerOneInformationsForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.banner-one-informations.view', [
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

        BannerOneInformation::setActiveStatus( $id );

    }

    public function destroy( $id )
    {
        if ($id) {

            $validateStatus = BannerOneInformation::where('id', $id)
                ->where('status', BannerOneInformation::ALIVE)
                ->first();
            
            if ($validateStatus) {

                $this->messageAlert( 'Ups!, El registro está activo','info');

            } else {

                $destroy = BannerOneInformation::destroyItem( $id );

                if ( $destroy ) {

                    $this->messageAlert( 'Información eliminada.','success');

                } else {

                    $this->messageAlert( 'Ups!, ocurrió un error','error');

                }
            
            }        

        }
    }
}
