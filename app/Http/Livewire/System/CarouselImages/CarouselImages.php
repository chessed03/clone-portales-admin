<?php

namespace App\Http\Livewire\System\CarouselImages;

use App\Models\System\CarouselImage;
use Livewire\Component;
use Livewire\WithPagination;

class CarouselImages extends Component
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

        $list_schools   = CarouselImage::getAliveSchools();

        $rows           = CarouselImage::getAliveImagesForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.carousel-images.view', [
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

            $destroy = CarouselImage::destroyItem( $id );

            if ( $destroy ) {

                $this->messageAlert( 'Imágen eliminada.','success');

            } else {

                $this->messageAlert( 'Ups!, ocurrió un error','error');

            }        

        }
    }

}
