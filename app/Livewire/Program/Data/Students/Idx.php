<?php

namespace App\Livewire\Program\Data\Students;

use App\Models\FetNet\Student;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Idx extends Component
{

    public $buttonAddStudents = true;
    use WithPagination;
    public $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'w-1/12 hidden'],
        ['key' => 'batch', 'label' => 'Batch', 'class' => 'w-1/12 align-top text-center'],
        ['key' => 'name', 'label' => 'Name', 'class' => 'w-1/12 align-top text-center'],
        ['key' => 'group', 'label' => 'Group', 'class' => 'w-1/12 align-top'],
        ['key' => 'subgroup', 'label' => 'Sub Group', 'class' => 'w-4/12 align-top'],
    ];

    #[On('ProgramDataStudentIdx_refresh')]
    public function render()
    {
        $students = Student::where('program_id', auth()->user()->program->id)
            ->where('parent_id', null)
            ->orderBy('batch','DESC')
            ->paginate(10);
        return view('livewire.program.data.students.idx',['students'=>$students]);
    }

    #[On('ProgramDataStudentsIdx_addStudents')]
    public function addStudents(){
        if($this->buttonAddStudents){
            $this->buttonAddStudents = false;
        }else{
            $this->buttonAddStudents = true;
        }
    }
}
