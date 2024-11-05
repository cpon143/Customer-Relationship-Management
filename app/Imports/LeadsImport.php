<?php
namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Lead([
            'name' => $row['name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'occupation' => $row['occupation'],
            'status' => $row['status'],
            'amount' => $row['amount'],
        ]);
    }
}