<?php

namespace App\Imports;

use App\Models\Store;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class StoreImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /* public function model(array $row)
    {
        // dd($row);

        return new Store([
            'store_name' => $row['store_name'],
            'contact'    => $row['contact'],
            'address'    => $row['address'],
        ]);
    } */

    public function collection(Collection $rows)
    {
        // dd($rows->all());
        foreach ($rows as $row) {
            $store_name = $row['store_name'];
            if($row['store_name'] == ''){// null check
                $store_name = 'no name';
            }

            Store::create([
                'store_name' => $store_name,
                'contact' => $row['contact'],
                'address' => $row['address'],
            ]);
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
