<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use App\Models\Paymentgetways;
class YourExportClass implements FromQuery
{
    public function query()
    {
        // Your query to fetch data for export
        return Paymentgetways::query();
    }


}