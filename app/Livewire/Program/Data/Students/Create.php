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
    public function render()
    {
        return view('livewire.program.data.students.create');
    }



    public function save(){
        $this->validate([
            'batch' => 'required',
        ]);

        if(Student::where('batch', $this->batch)->where('program_id', auth()->user()->program->id)->exists()){
            $this->error('Student batch already in the database.', position: 'toast-top toast-center');
        }else{
            Student::create([
                'batch' => $this->batch,
                'program_id' => auth()->user()->program->id,
                'name' => $this->batch.'-'.auth()->user()->program->abbrev,
            ]);
            $this->success('Student batch has been saved.', position: 'toast-top toast-center');
            $this->dispatch('ProgramDataStudentIdx_refresh');
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
}
