<?php

namespace App\Imports;

use App\Models\FetNet\Subject;
use App\Models\FetNet\Teacher;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class SubjectsImport implements WithProgressBar, SkipsOnError, ToCollection, WithHeadingRow
{
    use Importable, SkipsErrors;
    public $programId = null;
    public function __construct(int $programId){
        $this->programId = $programId;
    }

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.nama_matkul' => ['required', 'string'],
            '*.kode_matkul' => ['required', 'string'],
            '*.sks' => ['required', 'integer'],
            '*.semester' => ['required', 'integer'],
        ])->validate();

        foreach ($rows as $row) {
            Subject::firstOrCreate(
                [
                    // Kondisi untuk mencari:
                    'program_id' => $this->programId,
                    'code' => $row['kode_matkul'],
                ],
                [
                    'name' => $row['nama_matkul'],
                    // Data ini HANYA akan digunakan jika record BARU dibuat:
                    'credit' => $row['sks'],
                    'semester' => $row['semester'],
                ]
            );
        }


    }
}
