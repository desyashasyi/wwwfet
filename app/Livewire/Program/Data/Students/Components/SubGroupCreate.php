<?php

namespace App\Livewire\Program\Data\Students\Components;

use App\Models\FetNet\Student;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class SubGroupCreate extends Component
{
    use Toast;
    public $groupSearchable;
    public $batchSearchable;
    public $group_searchable_id = null ;
    public $batch_searchable_id = null ;
    public $addSubGroup = false;
    public $name = null;
    public $number_of_student = null;
    public $search;
    public $batch_searchable_id_temp = null;
    public function render()
    {
        $batch = null;
        if(!is_null($this->batch_searchable_id)){
            if($this->batch_searchable_id != $this->batch_searchable_id_temp){
                $this->batch_searchable_id_temp = $this->batch_searchable_id;
                $this->groupSelect();
            }
            $batch = Student::find($this->batch_searchable_id);
        }

        return view('livewire.program.data.students.components.sub-group-create', ['batch' => $batch]);
    }



    #[On('ProgramDataStudentsComponentsSubGroupCreate_addSubGroup')]
    public function addSubGroup($groupId){
        $this->addSubGroup = true;
        $this->batch_searchable_id = Student::find($groupId)->parent_id;
        $this->group_searchable_id = $groupId;
        $this->batchSelect();
        $this->groupSelect();
    }


    #[On('ProgramDataStudentsComponentsSubGroupCreate_cancelAddSubGroupOnly')]
    public function cancelAddSubGroupOnly(){
        $this->addSubGroup = false;
    }

    public function cancelAddSubGroup(){
        $this->addSubGroup = false;
        $this->dispatch('ProgramDataStudentsIdx_addStudents');
    }
    public function groupSelect(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = Student::where('id', $this->group_searchable_id)->get();
        //$this->faculties = $selectedOption;
        $this->groupSearchable = Student::query()
            ->where('program_id', auth()->user()->program->id)
            ->where('parent_id', $this->batch_searchable_id)
            ->where('name', 'like', "%$value%")
            ->orderBy('name', 'ASC')
            ->take(5)
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
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
            ->merge($selectedOption);     // <-- Adds selected option
    }

    public function save(){
        $this->validate([
            'batch_searchable_id' => 'required',
            'group_searchable_id' => 'required',
            'name' => 'required',
            'number_of_student' => 'required',
        ]);

        Student::create([
            'parent_id' => $this->group_searchable_id,
            'name' => Student::find($this->group_searchable_id)->name.'-'.$this->name,
            'number_of_student' => $this->number_of_student,
            'program_id' => auth()->user()->program->id,
            'batch' => Student::find($this->batch_searchable_id)->batch,
        ]);
        $this->name = null;
        $this->number_of_student = null;
        $this->dispatch('ProgramDataStudentIdx_refresh');
        $this->success('Student sub-group has been saved.', position: 'toast-top toast-center');

    }
}
