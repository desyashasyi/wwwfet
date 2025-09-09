<?php

namespace App\Livewire\Program\Data\Students\Components;

use App\Models\FetNet\Faculty;
use App\Models\FetNet\Student;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class GroupCreate extends Component
{
    use Toast;
    public $addGroup = false;
    public $batchSearchable;
    public $batch_searchable_id = null;
    public $name;
    public $number_of_student;
    public $studentData = null;
    public $search;
    public function render()
    {
        $student  = null;
        if(!is_null($this->batch_searchable_id)){
            $student = Student::find($this->batch_searchable_id);
            $this->studentData = $student;
        }
        return view('livewire.program.data.students.components.group-create', ['student' => $student]);
    }


    #[On('ProgramDataStudentsGroupCreate_addGroup')]
    public function addGroup($studentId){
        //dd($studentId);
        $this->addGroup = true;
        $this->batch_searchable_id = $studentId;
        $this->batchSelect();
    }

    #[On('ProgramDataStudentsGroupCreate_cancelAddGroup')]
    public function cancelAddGroup(){
        $this->addGroup = false;
        $this->dispatch('ProgramDataStudentsIdx_addStudents');
    }


    #[On('ProgramDataStudentsGroupCreate_cancelAddGroupOnly')]
    public function cancelAddGroupOnly(){
        $this->addGroup = false;
    }

    public function save(){
        $this->validate([
            'batch_searchable_id' => 'required',
            'name' => 'required',
            'number_of_student' => 'required',
        ]);

        Student::create([
            'parent_id' => $this->studentData->id,
            'batch' => $this->studentData->batch,
            'name' => $this->studentData->batch.'-'.$this->name,
            'number_of_student' => $this->number_of_student,
            'program_id' => $this->studentData->program_id,
        ]);
        $this->name = null;
        $this->number_of_student = null;
        $this->success('Student group has been saved.', position: 'toast-top toast-center');
        $this->dispatch('ProgramDataStudentIdx_refresh');
    }

    public function batchSelect(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = Student::where('id', $this->batch_searchable_id)->get();
        //$this->faculties = $selectedOption;
        $this->batchSearchable = Student::query()
            ->where('program_id', auth()->user()->program->id)
            ->where('parent_id', null)
            ->where('batch', 'like', "%$value%")
            ->orderBy('name', 'DESC')
            ->take(5)
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option    // <-- Adds selected option
    }
}
