<?php

namespace App\Livewire\Program\Data\Subjects\Components;

use App\Jobs\SubjectsImportJob;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportExcel extends Component
{
    public $enableAddsubjectsState = false;
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.program.data.subjects.components.import-excel');
    }

    #[On('ProgramDataSubjectsComponentImportExcel_enableAddsubjectsState')]
    public function enableAddsubjects(){
        if($this->enableAddsubjectsState == true){
            $this->enableAddsubjectsState = false;
            $this->dispatch('ProgramDataSubjectsIdx_increaseNumberOfSubjects');
        }else{
            $this->enableAddsubjectsState = true;
            $this->dispatch('ProgramDataSubjectsIdx_reduceNumberOfSubjects');
        }
    }

    public function updatedFile()
    {

        $this->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);
        // Dispatch job for import
        try {
            SubjectsImportJob::dispatch($this->file->getRealPath());
        } catch (\Exception $e) {
            // Trigger error toast on catch
            $this->error($e->getMessage());
        }
    }
}
