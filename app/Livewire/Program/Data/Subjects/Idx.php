<?php

namespace App\Livewire\Program\Data\Subjects;

use App\Models\FetNet\Subject;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Idx extends Component
{

    use WithPagination;
    public $buttonAddSubjects = true;
    public $numberOfSubjects;
    public $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'w-1/12 hidden'],
        ['key' => 'semester', 'label' => 'Semester', 'class' => 'w-1/12 align-top text-center'],
        ['key' => 'credit', 'label' => 'Credit', 'class' => 'w-1/12 align-top text-center'],
        ['key' => 'code', 'label' => 'Code', 'class' => 'w-1/12 align-top'],
        ['key' => 'name', 'label' => 'Name', 'class' => 'w-4/12 align-top'],
        ['key' => 'specialization', 'label' => 'Specialization', 'class' => 'w-1/12 align-top'],
        ['key' => 'type', 'label' => 'Type', 'class' => 'w-1/12 align-top'],
        ['key' => 'year', 'label' => 'Year', 'class' => 'w-1/12 align-top'],
        ['key' => 'action', 'label' => 'Action', 'class' => 'w-1/12 align-top text-right'],
    ];
    public function render()
    {
        $subjects = Subject::where('program_id', auth()->user()->program->id)->paginate($this->numberOfSubjects);
        return view('livewire.program.data.subjects.idx', [ 'subjects' => $subjects ]);
    }

    public function mount(){
        $this->numberOfSubjects = 8;
        if(!Auth()->user()){
            return redirect()->route('login');
        }
    }
    #[On('ProgramDataSubjectsIdx_reduceNumberOfSubjects')]
    public function reduceNumberOfPages(){
        $this->buttonAddSubjects = false;
        $this->numberOfSubjects = 4;
    }

    #[On('ProgramDataSubjectsIdx_increaseNumberOfSubjects')]
    public function increaseNumberOfPages(){
        $this->resetPage();
        $this->buttonAddSubjects = true;
        $this->numberOfSubjects = 8;
    }
}
