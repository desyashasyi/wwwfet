<?php

namespace App\Livewire\Program\Data\Activities;

use App\Models\FetNet\Activities;
use App\Models\FetNet\ActivityStudent;
use App\Models\FetNet\ActivityTeacher;
use App\Models\FetNet\ActivityType;
use App\Models\FetNet\Semester;
use App\Models\FetNet\Student;
use App\Models\FetNet\Subject;
use App\Models\FetNet\Teacher;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Create extends Component
{
    use WithPagination;
    use Toast;
    public ?array $teachers_multi_searchable_ids = [];
    public Collection $teachersSearchable;
    public ?array $students_multi_searchable_ids = [];
    public Collection $studentsSearchable;

    public $activity_searchable_id = null;
    public $activityTypesSearchable;

    public $subject = null;
    public $createActivity = true;
    public function render()
    {

        return view('livewire.program.data.activities.create');
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


    #[On('ProgramDataActivitiesCreate_cancelAddActivity')]
    public function cancelAssActivities(){
        $this->createActivity = false;
    }

    #[On('ProgramDataActivitiesCreate_AddActivity')]
    public function addAnActivity($subjectId)
    {
        $this->dispatch('ProgramDataActivitiesEdit_cancelEditActivity');
        $this->dispatch('ProgramDataActivitiesView_cancelViewActivity');
        $this->teachers_multi_searchable_ids = [];
        $this->students_multi_searchable_ids = [];
        $this->activity_searchable_id = null;
        $this->subject = Subject::find($subjectId);
        $this->createActivity = true;
        //dd($subjectId);
    }

    public function save(){
        if(is_null($this->subject)){
            $this->error('Your should select a subject.', position: 'toast-top toast-center');
        }else{
            $this->validate([
                'teachers_multi_searchable_ids' => ['required', 'array'],
                'students_multi_searchable_ids' => ['required', 'array'],
                'activity_searchable_id' => ['required'],
            ]);


            $teachers = collect($this->teachers_multi_searchable_ids);
            $students = collect($this->students_multi_searchable_ids);

            $activity = Activities::create([
                'subject_id' => $this->subject->id,
                'program_id' => auth()->user()->program->id,
                'semester_id' => Semester::latest()->first()->id,
                'type_id' => $this->activity_searchable_id,
                'active' => true,
            ]);

            foreach($teachers as $teacher){
                ActivityTeacher::updateOrCreate([
                    'activity_id' => $activity->id,
                    'teacher_id' => $teacher,

                ]);
            }

            foreach($students as $student){
                ActivityStudent::updateOrCreate([
                    'activity_id' => $activity->id,
                    'student_id' => $student,
                ]);
            }
            $this->dispatch('ProgramDataActivitiesIndex_refresh');
            $this->success('Activity has been saved.', position: 'toast-top toast-center');
            $this->teachers_multi_searchable_ids = [];
            $this->students_multi_searchable_ids = [];
            $this->activity_searchable_id = null;
            $this->subject = null;
        }
    }

}
