<?php

namespace App\Imports;

use App\Models\ReferBy;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReferBysImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new ReferBy([
            'name' => $row['name'],
            'email' => $row['email'] ?? null,
            'phone' => $row['phone'] ?? null,
            'address' => $row['address'] ?? null,
            'status' => $row['status'] ?? 1,
        ]);
    }
}