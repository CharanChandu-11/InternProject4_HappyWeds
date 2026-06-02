<?php

namespace App\Exports;

use App\Models\ReferBy;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReferBysExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ReferBy::all(['name', 'email', 'phone', 'address', 'status', 'created_at']);
    }

    public function headings(): array
    {
        return ['name', 'email', 'phone', 'address', 'status', 'created_at'];
    }
}