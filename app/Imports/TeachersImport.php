<?php
namespace App\Imports;

use App\Models\FetNet\Teacher;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class TeachersImport implements WithProgressBar, SkipsOnError, ToCollection, WithHeadingRow
{
    use Importable, SkipsErrors;
    public $programId = null;
    public function __construct(int $programId){
        $this->programId = $programId;
    }

    public function collection(Collection $rows)
    {


        foreach ($rows as $row) {

            if (empty($row['kode_dosen']) || empty($row['nama_dosen'])) {
                continue;
            }

            $user = User::updateOrCreate(
                [
                    'name' => $row['kode_dosen'],
                ],
                [
                    'email' => $row['email'],
                    'password' => Hash::make($row['kode_dosen'].'1234##'),
                ]
            );
            $user->assignRole('teacher');

            $teacher = Teacher::updateOrCreate(
                [
                    'code' => $row['kode_dosen'],
                ],
                [
                    // Data yang akan diisi atau diperbarui
                    'univ_code' => $row['kode_univ'] ?? null,
                    'employee_id' => $row['employee_id'] ?? null,
                    'name' => $row['nama_dosen'],
                    'front_title' => $row['title_depan'] ?? null,
                    'rear_title' => $row['title_belakang'] ?? null,
                    'email' => $row['email'] ?? null,
                    'program_id' => $this->programId,
                    'user_id' => $user->id,
                ]
            );

            //echo sprintf('here is the message: %s', $row."\n");
            // Tautkan dosen dengan prodi pengguna yang mengimpor
            /*if ($teacher) {
                $teacher->prodis()->syncWithoutDetaching(auth()->user()->prodi->id);
            }
            */
        }
    }
}
