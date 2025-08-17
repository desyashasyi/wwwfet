<?php

namespace App\Livewire\SuperAdmin\University;

use App\Models\FetNet\University;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;
    public $abbreviation;
    public $name;
    public $createUniversityModal = false;
    public function render()
    {
        return view('livewire.super-admin.university.create');
    }

    public function save(){
        $this->validate([
            'abbreviation' => 'required|unique:institution_university,code',
            'name' => 'required|unique:institution_university,name',
        ]);
        University::create([
            'code' => $this->abbreviation,
            'name' => $this->name,
        ]);
        $this->success(
            'The University data has been saved!',
            position: 'toast-top toast-center'
        );
        $this->name = '';
        $this->abbreviation = '';
        $this->dispatch('superAdminClientCreate_refreshChoice');
    }

    #[On('superAdminUniversity_Create')]
    public function createUniversity(){
        $this->createUniversityModal = true;
        //dd('create University');
    }
}
