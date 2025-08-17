<?php

namespace App\Livewire\SuperAdmin\Faculty;

use App\Models\FetNet\Faculty;
use App\Models\FetNet\University;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;
    public $createFacultyModal = false;
    public $university_searchable_id = null;
    public $universitiesSearchable;
    public $abbreviation;
    public $name;
    public function render()
    {
        return view('livewire.super-admin.faculty.create');
    }

    public function mount(){
        $this->universitySelect();
    }
    public function universitySelect(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = University::where('id', $this->university_searchable_id)->get();
        //$this->faculties = $selectedOption;
        $this->universitiesSearchable = University::query()
            ->where('code', 'like', "%$value%")
            ->orwhere('name', 'like', "%$value%")
            ->take(5)
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
    }
    #[On('superAdminFaculty_Create')]
    public function createFaculty($universityId){
        if(is_null($universityId)){
            $this->error(
                'Please select university!',
                position: 'toast-top toast-center'
            );
        }else{
            $this->createFacultyModal = true;
            $this->university_searchable_id = $universityId;
            $this->universitySelect();
        }

    }

    public function save(){
        $this->validate([
            'abbreviation' => 'required|unique:institution_faculty,code',
            'name' => 'required|unique:institution_university,name',
            'university_searchable_id' => 'required',
        ]);
        Faculty::create([
            'code' => $this->abbreviation,
            'name' => $this->name,
            'university_id' => $this->university_searchable_id,
        ]);
        $this->success(
            'The Faculty data has been saved!',
            position: 'toast-top toast-center'
        );
        $this->name = '';
        $this->abbreviation = '';
        $this->dispatch('superAdminClientCreate_refreshChoice');

    }
}
