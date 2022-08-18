<?php

namespace App\Imports\Base;

use App\Models\Base\Role;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RoleImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    use Importable;

    /**
     * @return null|\Illuminate\Database\Eloquent\Model
     */
    public function model(array $row)
    {
        return new Role([
            'name' => $row['name'],
            'display_name' => $row['display_name'],
            'description' => $row['description'],
        ]);
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
