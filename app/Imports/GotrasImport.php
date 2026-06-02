<?php

namespace App\Imports;

use App\Models\Gotra;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GotrasImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Gotra([
            'gotra'       => $row['gotra'],
        ]);
    }

    public function rules(): array
    {
        return [
            'gotra'       => 'required|string|max:255',
        ];
    }
}