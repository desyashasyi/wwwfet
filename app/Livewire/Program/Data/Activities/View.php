<?php

namespace App\Livewire\Program\Data\Activities;

use App\Models\FetNet\Activities;
use App\Models\FetNet\ActivityType;
use App\Models\FetNet\Student;
use App\Models\FetNet\Teacher;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\On;
use Mary\Traits\Toast;


class View extends Component
{
    use Toast;
    public ?array $teachers_multi_searchable_ids = [];
    public Collection $teachersSearchable;
    public ?array $students_multi_searchable_ids = [];
    public Collection $studentsSearchable;

    public $activity_searchable_id = null;
    public $activityTypesSearchable;

    public $viewActivity = false;
    public $activity;

    public $activityId;
    public function render()
    {
        return view('livewire.program.data.activities.view');
    }

    #[On('ProgramDataActivitiesView_ViewActivity')]
    public function viewActivity($activityId){
        $this->dispatch('ProgramDataActivitiesCreate_cancelAddActivity');
        $this->dispatch('ProgramDataActivitiesEdit_cancelviewActivity');
        $this->teachers_multi_searchable_ids = [];
        $this->students_multi_searchable_ids = [];
        $this->viewActivity = true;
        $this->activity = Activities::find($activityId);
        $this->activityId = $activityId;
        foreach($this->activity->teachers as $teacher){
            $this->teachers_multi_searchable_ids[] = $teacher->id;//array
        }

        foreach($this->activity->students as $student){
            $this->students_multi_searchable_ids[] = $student->id;
        }
        $this->activity_searchable_id = $this->activity->type_id;

        $this->teacherSelect();
        $this->studentSelect();
        $this->activityTypeSelect();
    }

    #[On('ProgramDataActivitiesView_cancelViewActivity')]
    public function cancelViewActivity(){
        $this->viewActivity = false;
    }

    public function mount()
    {
        // Fill options when component first renders
        //$this->showAddActivity = true;
        $this->teacherSelect();
        $this->studentSelect();
        $this->activityTypeSelect();
    }

    // Also called as you type
    public function teacherSelect(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = Teacher::whereIn('id', $this->teachers_multi_searchable_ids)->get();

        $this->teachersSearchable = Teacher::query()
            ->whereHas('program', function($queryProgram){
                $queryProgram->whereHas('cluster', function($queryCluster){
                    $queryCluster->where('cluster_base_id', auth()->user()->program->cluster->cluster_base_id);
                });
            })
            ->where('code', 'like', "%$value%")
            ->take(5)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
        // <-- Adds selected option
    }
    public function studentSelect(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = Student::whereIn('id', $this->students_multi_searchable_ids)->get();

        $this->studentsSearchable = Student::query()
            ->where('program_id', auth()->user()->program->id)
            ->where('name', 'like', "%$value%")
            ->take(5)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
    }

    public function activityTypeSelect(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = ActivityType::where('id', $this->activity_searchable_id)->get();
        //$this->faculties = $selectedOption;
        $this->activityTypesSearchable = ActivityType::query()
            ->where('name', 'like', "%$value%")
            ->take(5)
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
    }

    public function editActivity($activityId){
        $this->viewActivity = false;
        $this->dispatch('ProgramDataActivitiesCreate_cancelAddActivity');
        $this->dispatch('ProgramDataActivitiesEdit_EditActivity', $activityId);
    }
}
