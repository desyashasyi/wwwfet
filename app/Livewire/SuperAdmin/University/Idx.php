<?php

namespace App\Livewire\SuperAdmin\University;

use App\Models\FetNet\University;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Idx extends Component
{
    use WithPagination;
    public $addData = false;
    public $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'w-1/12 hidden'],
        ['key' => 'code', 'label' => 'Code', 'class' => 'w-1/12 align-top'],
        ['key' => 'name', 'label' => 'Name', 'class' => 'w-5/12 align-top'],
        ['key' => 'name_eng', 'label' => 'Name (English)', 'class' => 'w-5/12 align-top'],
    ];
    public function render()
    {
        $universities = null;
        $universities = University::paginate(10);
        return view('livewire.super-admin.university.idx', ['universities' => $universities]);
    }
    #[On('enableAddUniversity')]
    public function enableAddUniversity(){
        if($this->addData == true){
            $this->addData = false;
        }else{
            $this->addData = true;
        }
    }
}
