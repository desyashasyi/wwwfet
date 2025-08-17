<?php

namespace App\Livewire\Program\Data\Specializations;

use App\Models\FetNet\Specialization;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;
    public $addSpecializationState = false;
    public $code;
    public $name;
    public $abbrev;
    public function render()
    {
        return view('livewire.program.data.specializations.create');
    }

    #[On('ProgramDataSpecializationsCreate_addSpecialization')]
    public function enableAddSpecialization(){
        $this->dispatch('ProgramDataSpecializationsIdx_addSpecialization');
        if(!$this->addSpecializationState){
            $this->addSpecializationState = true;
        }else{
            $this->addSpecializationState = false;
        }

    }

    public function save(){
        $this->validate([
            'code' => 'required',
            'name' =>'required',
            'abbrev' => 'required',
        ]);
        Specialization::create([
            'code' => $this->code,
            'abbrev' => $this->abbrev,
            'name' => $this->name,
            'program_id' => auth()->user()->program->id,
        ]);
        $this->code = '';
        $this->name = '';
        $this->abbrev = '';
        $this->success('Specialization has been saved.', position: 'toast-top toast-center');
        $this->dispatch('ProgramDataSpecializations_refresh');
    }
}
