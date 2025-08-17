<?php

namespace App\Livewire\Client\Program;

use App\Models\FetNet\Client;
use App\Models\FetNet\Program;
use Livewire\Attributes\On;
use Livewire\Component;

class Idx extends Component
{

    public $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'w-1/12 hidden'],
        ['key' => 'user', 'label' => 'User', 'class' => 'w-1/12 align-top'],
        ['key' => 'email', 'label' => 'Email', 'class' => 'w-2/12 align-top'],
        ['key' => 'description', 'label' => 'Description', 'class' => 'w-3/12 align-top'],
        ['key' => 'cluster', 'label' => 'Cluster', 'class' => 'w-3/12 align-top'],
        ['key' => 'action', 'label' => 'Action', 'class' => 'w-2/12 align-top text-right'],
    ];
    public $addData = false;
    #[On('clientProgramIdx_refresh')]
    public function render()
    {
        $programs = collect();
        if(!is_null(auth()->user()->client)){
            $programs = Program::where('client_id',auth()->user()->client->id)->paginate(10);
        }
        return view('livewire.client.program.idx',['programs' => $programs]);
    }

    #[On('clientProgramIdx_addProgram')]
    public function enableAddProgram(){
        if($this->addData == true){
            $this->addData = false;
        }else{
            $this->addData = true;
        }
    }

    public function loginAs($programId){
        $program = Program::find($programId);
        $user = $program->user;
        auth()->login($user);
        return redirect()->route('program.idx');
    }
}
