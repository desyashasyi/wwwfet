<?php

namespace App\Livewire\Program\Data\Teachers;

use App\Models\FetNet\Teacher;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Idx extends Component
{
    use WithPagination;
    public $numberOfTeachers;
    public $buttonAddTeachers = true;
    public $expanded;
    public $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'w-1/12 hidden'],
        ['key' => 'code', 'label' => 'Code', 'class' => 'w-1/12 align-top'],
        ['key' => 'univ_code', 'label' => 'Univ code', 'class' => 'w-1/12 align-top'],
        ['key' => 'employee_id', 'label' => 'Employee ID', 'class' => 'w-2/12 align-top'],
        ['key' => 'name', 'label' => 'Name', 'class' => 'w-5/12 align-top'],
        ['key' => 'email', 'label' => 'Email', 'class' => 'w-2/12 align-top'],
        ['key' => 'action', 'label' => 'Action', 'class' => 'w-1/12 align-top text-right'],
    ];

    #[On('ProgramDataTeachersIndex_refresh')]
    public function render()
    {
        $teachers = Teacher::where('program_id', auth()->user()->program->id)->paginate($this->numberOfTeachers);
        return view('livewire.program.data.teachers.idx', ['teachers' => $teachers]);
    }

    public function mount(){
        $this->numberOfTeachers = 12;
        if(!Auth()->user()){
            return redirect()->route('login');
        }
    }

    #[On('ProgramDataTeachersIdx_reduceNumberOfTeachers')]
    public function reduceNumberOfPages(){
        $this->buttonAddTeachers = false;
        $this->numberOfTeachers = 5;
    }

    #[On('ProgramDataTeachersIdx_increaseNumberOfTeachers')]
    public function increaseNumberOfPages(){
        $this->resetPage();
        $this->dispatch('ProgramDataTeachersCreate_showAddTeachers');
        $this->buttonAddTeachers = true;
        $this->numberOfTeachers = 12;

    }


}
