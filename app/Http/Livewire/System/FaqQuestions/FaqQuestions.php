<?php

namespace App\Http\Livewire\System\FaqQuestions;

use App\Models\System\FaqQuestion;
use Livewire\Component;
use Livewire\WithPagination;


class FaqQuestions extends Component
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

        $list_schools   = FaqQuestion::getAliveSchools();

        $rows           = FaqQuestion::getAliveFaqQuestionsForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.faq-questions.view', [
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

            $destroy = FaqQuestion::destroyItem( $id );

            if ( $destroy ) {

                $this->messageAlert( 'Pregunta eliminada.','success');

            } else {

                $this->messageAlert( 'Ups!, ocurrió un error','error');

            }        

        }
    }

}
