<?php

namespace App\Exports;

use App\Models\System\MessageContact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class MessageContactsExport implements FromCollection, WithHeadings
{

    protected $messageContacts;

    public function __construct($messageContacts)
    {
        $this->messageContacts = $messageContacts;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->messageContacts;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Correo',
            'Teléfono',
            'Estado',
            'Fecha',
            'Institución',
            'Mensaje',
            'Fuente'
        ];
    }

}
