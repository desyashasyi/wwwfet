<?php

namespace App\Livewire\Program\Data\Subjects;

use App\Models\FetNet\Specialization;
use App\Models\FetNet\SubjectType;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $enableAddSubjectsState = false;

    public $code;
    public $name;
    public $credit;
    public $semester;
    public $year;
    public $specialization_id;

    public function render()
    {
        $specializations = Specialization::where('program_id', auth()->user()->program->id)->get();
        $types = SubjectType::where('program_id', auth()->user()->program->id)->get();
        return view('livewire.program.data.subjects.create', ['specializations' => $specializations, 'types' => $types]);
    }


    #[On('ProgramDataSubjectsCreate_addSubjects')]
    public function enableAddsubject(){
        if($this->enableAddSubjectsState){
            $this->enableAddSubjectsState = false;
            $this->dispatch('ProgramDataSubjectsIdx_increaseNumberOfSubjects');
        }else{
            $this->enableAddSubjectsState = true;
            $this->dispatch('ProgramDataSubjectsIdx_reduceNumberOfSubjects');
        }
    }

    public function save(){
        $this->validate([
            'code' => 'required|unique:subjects,code',
            'name' => 'required',
            'credit' => 'required|integer',
            'semester' => 'required|integer',
            'year' => 'required',
            'specialization_id' => 'required',

        ]);
    }
}
