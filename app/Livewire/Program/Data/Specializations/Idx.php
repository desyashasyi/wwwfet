<?php

namespace App\Livewire\Program\Data\Specializations;

use App\Models\FetNet\Specialization;
use Livewire\Attributes\On;
use Livewire\Component;

class Idx extends Component
{
    public $buttonAddSpecializations = true;
    public $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'w-1/12 hidden'],
        ['key' => 'abbrev', 'label' => 'Abbreviation', 'class' => 'w-2/12 align-top'],
        ['key' => 'code', 'label' => 'code', 'class' => 'w-2/12 align-top'],
        ['key' => 'description', 'label' => 'Description', 'class' => 'w-5/12 align-top'],
        ['key' => 'action', 'label' => 'Action', 'class' => 'w-1/12 align-top text-right'],
    ];
    #[On('ProgramDataSpecializations_refresh')]
    public function render()
    {
        $specializations = Specialization::where('program_id', auth()->user()->program->id)->paginate(10);
        return view('livewire.program.data.specializations.idx',['specializations' => $specializations]);
    }

    #[On('ProgramDataSpecializationsIdx_addSpecialization')]
    public function addSpecialization(){
        if($this->buttonAddSpecializations){
            $this->buttonAddSpecializations = false;
        }else{
            $this->buttonAddSpecializations = true;
        }
    }
}
