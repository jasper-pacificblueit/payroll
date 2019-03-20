<?php

namespace App\Imports;

use App\DateTimeRecord;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DateTimeRecord([
            'user_id' => $row[0],
            'data' => $row[1],
            'comp_id' => $row[2],
        ]);
    }
}
