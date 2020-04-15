<?php

namespace App\Imports;

use App\Models\Event;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new Event([
            'event_name'     => $row['event_name'],
            'event_description'    => $row['event_description'],
            'event_fname' => $row['event_fname'],
            'event_status' => $row['event_status'],
            'event_scheduled_date' => isset($row['event_scheduled_date']) ? date('Y-m-d',strtotime($row['event_scheduled_date'])) : date('Y-m-d'),
            'event_scheduled' => isset($row['event_scheduled']) ? date('H:i',strtotime($row['event_scheduled'])) : date('H:i'),
        ]);
    }

    public function  rules(): array {
        return [
            '*.event_name' => 'required',
            '*.event_description' => 'required',
            '*.event_fname' => 'required',
            '*.event_status' => 'required',
            '*.event_scheduled_date' => 'required|date_format:d-m-Y',
            '*.event_scheduled' => 'required|date_format:H:i',
        ];
    }
}