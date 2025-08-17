<?php

namespace App\Livewire\Program\Data\Activities;

use App\Models\FetNet\Subject;
use Livewire\Component;

class Idx extends Component
{
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
        return view('livewire.program.data.activities.idx',['subjects' => $subjects]);
    }
    public function mount(){
        $this->numberOfSubjects = 10;
        if(!Auth()->user()){
            return redirect()->route('login');
        }
    }
}
