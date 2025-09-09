<?php

namespace App\Livewire\Program\Data\Activities;

use App\Models\FetNet\Subject;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Idx extends Component
{
    use WithPagination;
    public $subjectNumber = 5;
    public $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'w-1/12 hidden'],
        ['key' => 'semester', 'label' => 'Sem', 'class' => 'w-1/12 align-top text-center'],
        //['key' => 'credit', 'label' => 'Credit', 'class' => 'w-1/12 align-top text-center'],
        // ['key' => 'code', 'label' => 'Code', 'class' => 'w-1/12 align-top'],
        ['key' => 'name', 'label' => 'Name', 'class' => 'w-5/12 align-top'],
        ['key' => 'class', 'label' => 'Classes', 'class' => 'w-4/12 align-top'],
        ['key' => 'action', 'label' => '', 'class' => 'w-1/12 align-top text-right'],
    ];
    #[On('ProgramDataActivitiesIndex_refresh')]
    public function render()
    {
        $subjects = Subject::where('program_id', auth()->user()->program->id)
            ->orderBy('semester', 'asc')
            ->paginate($this->subjectNumber);
        return view('livewire.program.data.activities.idx', ['subjects' => $subjects]);
    }

    #[On('ProgramDataActivitiesIdx_showCreateEditForm')]
    public function showCreateEditForm(){
        $this->subjectNumber = 5;
    }

    public function addActivity($subjectId){
        $this->dispatch('ProgramDataActivitiesEdit_cancelEditActivity');
        $this->dispatch('ProgramDataActivitiesView_cancelViewActivity');
        $this->dispatch('ProgramDataActivitiesCreate_AddActivity', $subjectId);
    }



    public function viewActivity($activityId){
        $this->dispatch('ProgramDataActivitiesCreate_cancelAddActivity');
        $this->dispatch('ProgramDataActivitiesEdit_cancelEditActivity');
        $this->dispatch('ProgramDataActivitiesView_ViewActivity', $activityId);
    }


}
