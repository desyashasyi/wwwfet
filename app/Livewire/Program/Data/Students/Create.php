<?php

namespace App\Livewire\Program\Data\Students;

use App\Models\FetNet\Student;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{

    use Toast;
    public $addStudent = false;
    public $batch;
    public $number_of_student;
    public function render()
    {
        return view('livewire.program.data.students.create');
    }



    public function save(){
        $this->validate([
            'batch' => 'required',
            'number_of_student' => 'required',
        ]);

        if(Student::where('batch', $this->batch)->where('program_id', auth()->user()->program->id)->exists()){
            $this->error('Student batch already in the database.', position: 'toast-top toast-center');
        }else{
            Student::create([
                'batch' => $this->batch,
                'program_id' => auth()->user()->program->id,
                'name' => $this->batch.'-'.auth()->user()->program->abbrev,
                'number_of_student' => $this->number_of_student,
            ]);
            $this->success('Student batch has been saved.', position: 'toast-top toast-center');
            $this->dispatch('ProgramDataStudentIdx_refresh');
            $this->batch = null;
            $this->number_of_student = null;
        }
    }
    #[On('ProgramDataStudentsCreate_addStudents')]
    public function addStudents(){
        $this->dispatch('ProgramDataStudentsIdx_addStudents');
        if($this->addStudent == true){
            $this->addStudent = false;
        }else{
            $this->addStudent = true;
        }
    }

    #[On('ProgramDataStudentsCreate_cancelAddStudents')]
    public function cancelAddStudents(){
        $this->addStudent = false;
    }
}
