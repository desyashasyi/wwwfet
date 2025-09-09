<?php

namespace App\Livewire\Program\Data\Teachers;

use App\Models\FetNet\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;
    public $code;
    public $univCode;
    public $name;
    public $email;
    public $phone;
    public $frontTitle;
    public $rearTitle;
    public $employeeId;
    public $enableAddTeacherState = false;
    public function render()
    {
        return view('livewire.program.data.teachers.create');
    }

    #[On('ProgramDataTeachersCreate_addTeachers')]
    public function enableAddTeacher(){
        $this->resetErrorBag();
        if($this->enableAddTeacherState == true){
            $this->dispatch('ProgramDataTeachersIdx_increaseNumberOfTeachers');
            $this->enableAddTeacherState = false;
        }else{
            $this->dispatch('ProgramDataTeachersEdit_disableEditTeachers');
            $this->dispatch('ProgramDataTeachersComponentsImportExcel_disableAddTeachers');
            $this->dispatch('ProgramDataTeachersIdx_reduceNumberOfTeachers');
            $this->enableAddTeacherState = true;
        }
    }

    #[On('ProgramDataTeachersCreate_showAddTeachers')]
    public function showAddTeacher(){
        $this->resetErrorBag();
        $this->enableAddTeacherState = true;
    }

    #[On('ProgramDataTeachersCreate_disableAddTeachers')]
    public function disableAddTeacher(){
        $this->enableAddTeacherState = false;
    }
    public function checkCode(){
        $this->validate([
            'code' => 'required|unique:fetnet_teacher,code',
        ]);
    }

    public function clearFields(){
        $this->code = null;
        $this->univCode = null;
        $this->name = null;
        $this->email = null;
        $this->phone = null;
        $this->password = null;
        $this->frontTitle = null;
        $this->rearTitle = null;
        $this->employeeId = null;
    }
    public function save(){
        $this->validate([
            'code' => 'required|unique:fetnet_teacher,code',
            'univCode' =>'required|unique:fetnet_teacher,univ_code',
            'name' =>'required',
            'email' =>'required|email|unique:users,email',
            'phone' =>'required',
            'employeeId' =>'required',
        ]);

        if(!User::where('email', $this->email)->exists()){
            $user = User::create([
                'name' => $this->code,
                'email' => $this->email,
                'password' => Hash::make($this->code.'1234##'),
            ]);
            $user->assignRole('teacher');

            Teacher::create([
                'user_id' => $user->id,
                'name' => $this->name,
                'phone' => $this->phone,
                'front_title' => $this->frontTitle,
                'rear_title' => $this->rearTitle,
                'employee_id' => $this->employeeId,
                'code' => strtoupper($this->code),
                'univ_code' => $this->univCode,
                'program_id' => auth()->user()->program->id,
            ]);

            $this->clearFields();
            $this->success('Program has been saved.', position: 'toast-top toast-center');
            $this->dispatch('ProgramDataTeachersIdx_refresh');
        }
    }
}
