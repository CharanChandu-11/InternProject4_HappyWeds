<?php

namespace App\Exports;

use App\Models\Gotra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GotrasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Gotra::all(['gotra']);
    }

    public function headings(): array
    {
        return ['gotra'];
    }
}