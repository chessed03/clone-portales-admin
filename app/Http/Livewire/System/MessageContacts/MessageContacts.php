<?php

namespace App\Http\Livewire\System\MessageContacts;

use App\Models\System\MessageContact;
use Livewire\Component;
use Livewire\WithPagination;

class MessageContacts extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners       = ['destroy', 'messageRead'];

    public $paginateNumber     = 5;

    public $orderBy            = 3;

    public $typeMessage        = 3;

    public $keyWord;

    public function render()
    {

        $keyWord        = '%' . $this->keyWord . '%';

        $typeMessage    = intval($this->typeMessage);

        $paginateNumber = $this->paginateNumber;

        $orderBy        = intval($this->orderBy);

        $rows           = MessageContact::getAliveMessageContactsForView( $keyWord, $typeMessage, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.message-contacts.message-contacts', [
            'rows' => $rows
        ]);

    }

    public function messageAlert( $text, $icon )
    {

        $this->emit('message', $text, $icon);

    }

    public function messageRead( $id )
    {

        if ( $id ) {

            $validateMessage = MessageContact::where('id', $id)
                ->where('status', MessageContact::ALIVE)
                ->first();

            if ( $validateMessage ) {

                $markRead = MessageContact::messageReadItem($id);

                if ( $markRead ) {

                    $this->messageAlert( 'El mensaje se marcó como leído.','success');

                } else {

                    $this->messageAlert( 'Ups!, ocurrió un error','error');

                }

            }

        }

    }

}
