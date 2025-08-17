<?php

namespace App\Livewire\Program\Data\Teachers\Components;

use App\Jobs\TeachersImportJob;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;
use App\Events\TeachersImportEvent;

class ImportExcel extends Component
{
    use WithFileUploads;
    use Toast;
    public $enableAddTeacherState = false;
    public $file;
    public function render()
    {
        return view('livewire.program.data.teachers.components.import-excel');
    }


    #[On('ProgramDataTeachersComponentsImportExcel_addTeachers')]
    public function importExcelTeachers(){
        if($this->enableAddTeacherState == true){
            $this->dispatch('ProgramDataTeachersIdx_increaseNumberOfTeachers');
            $this->enableAddTeacherState = false;
        }else{
            $this->dispatch('ProgramDataTeachersEdit_disableEditTeachers');
            $this->dispatch('ProgramDataTeachersCreate_disableAddTeachers');
            $this->dispatch('ProgramDataTeachersIdx_reduceNumberOfTeachers');
            $this->enableAddTeacherState = true;
        }
    }
    #[On('ProgramDataTeachersComponentsImportExcel_disableAddTeachers')]
    public function disableAddTeacher(){
        $this->enableAddTeacherState = false;
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);
        // Dispatch job for import
        try {
            TeachersImportJob::dispatch($this->file->getRealPath());
        } catch (\Exception $e) {
            // Trigger error toast on catch
            $this->error($e->getMessage());
        }
    }

    protected function getListeners()
    {
        return [
            'echo:teachersImport,TeachersImportEvent' => 'handleImportEvent',
        ];
    }
    public function handleImportEvent($payload)
    {
        // Emit toast event untuk MaryUI Toast
        $type = $payload['status'];
        $message = $payload['message'];
        $this->success($message, position: 'toast-top toast-center');
        $this->dispatch('ProgramDataTeachersIndex_refresh');
    }
}
