<?php

namespace App\Livewire\Program\Data\Subjects;

use App\Models\FetNet\Specialization;
use App\Models\FetNet\SubjectType;
use App\Models\FetNet\Teacher;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{

    public $enableEditSubjectsState = false;
    public function render()
    {
        $specializations = Specialization::where('program_id', auth()->user()->program->id)->get();
        $types = SubjectType::where('program_id', auth()->user()->program->id)->get();
        return view('livewire.program.data.subjects.edit',['specializations' => $specializations, 'types' => $types]);
    }

    #[On('ProgramDataSubjectsEdit_editSubjects')]
    public function enableEditTeacher($subjectId){
        $this->dispatch('ProgramDataSubjectsComponentsImportExcel_disableAddSubjects');
        $this->dispatch('ProgramDataSubjectsCreate_disableAddSubjects');
        $this->dispatch('ProgramDataSubjectsIdx_reduceNumberOfSubjects');
        $this->enableEditSubjectsState = true;
    }
}
