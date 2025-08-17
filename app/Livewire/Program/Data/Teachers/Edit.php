<?php

namespace App\Livewire\Program\Data\Teachers;

use App\Models\FetNet\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Edit extends Component
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
    public $enableEditTeacherState = false;
    public $teacher;
    public function render()
    {
        return view('livewire.program.data.teachers.edit');
    }

    #[On('ProgramDataTeachersEdit_editTeachers')]
    public function enableEditTeacher($teacherId){
        $this->dispatch('ProgramDataTeachersComponentsImportExcel_disableAddTeachers');
        $this->dispatch('ProgramDataTeachersCreate_disableAddTeachers');
        $this->dispatch('ProgramDataTeachersIdx_reduceNumberOfTeachers');
        $this->enableEditTeacherState = true;
        $this->teacher = Teacher::find($teacherId);
        $this->name = $this->teacher->name;
        $this->email = $this->teacher->user->email;
        $this->phone = $this->teacher->phone;
        $this->frontTitle = $this->teacher->front_title;
        $this->rearTitle = $this->teacher->rear_title;
        $this->employeeId = $this->teacher->employee_id;
        $this->code = $this->teacher->code;
        $this->univCode = $this->teacher->univ_code;
    }

    #[On('ProgramDataTeachersEdit_disableEditTeachers')]
    public function disableEditTeacher(){
        //$this->dispatch('ProgramDataTeachersIdx_increaseNumberOfTeachers');
        $this->enableEditTeacherState = false;
    }
    public function disableEditTeacherInternal(){
        $this->dispatch('ProgramDataTeachersIdx_increaseNumberOfTeachers');
        $this->enableEditTeacherState = false;
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
            'code' => 'required',
            'univCode' =>'required',
            'name' =>'required',
            'email' =>'required',
            'phone' =>'required',
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
                'name' => $this->firstName,
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
