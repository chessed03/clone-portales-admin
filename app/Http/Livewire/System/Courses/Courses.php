<?php

namespace App\Http\Livewire\System\Courses;

use App\Models\System\Course;
use Livewire\Component;
use Livewire\WithPagination;


class Courses extends Component
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

        $list_schools   = Course::getAliveSchools();

        $rows           = Course::getAliveCoursesForView( $keyWord, $paginateNumber, $orderBy );

        if ( $paginateNumber > count($rows) ) {

            $this->resetPage();

        }

        return view('livewire.system.courses.view', [
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

            $record         = Course::where('id', $id)->first();
            $record->status = 0;
            $record->update();

            $this->messageAlert( 'Curso eliminado.','success');

        }
    }


}
