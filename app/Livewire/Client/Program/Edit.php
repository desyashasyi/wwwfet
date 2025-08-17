<?php

namespace App\Livewire\Client\Program;

use App\Models\FetNet\Cluster;
use App\Models\FetNet\ClusterBase;
use App\Models\FetNet\Program;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Edit extends Component
{
    use Toast;
    public $programId = null;
    public $clusterSearchable;
    public $cluster_searchable_id = null;
    public $editProgramModal;
    public $name;
    public $code;
    public $abbrev;
    public $email;
    public $program = null;
    public function render()
    {
        return view('livewire.client.program.edit', ['program' => $this->program]);
    }

    public function mount(){
        $this->clusterSelect();
    }
    public function clusterSelect(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = ClusterBase::where('id', $this->cluster_searchable_id)->get();
        //$this->faculties = $selectedOption;
        $this->clusterSearchable = ClusterBase::query()
            ->where('code', 'like', "%$value%")
            ->orwhere('name', 'like', "%$value%")
            ->take(5)
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
    }
    #[On('clientProgram_Create')]
    public function clientProgram_Create($programId){
        $this->editProgramModal = true;
        if(!is_null($programId)) {
            $this->program = Program::find($programId);
            $this->email = $this->program->user->email;
            $this->name = $this->program->name;
            $this->code = $this->program->code;
            $this->abbrev = $this->program->abbrev;
            $this->programId = $programId;
            if(!is_null($this->program->cluster)){
                $this->cluster_searchable_id = $this->program->cluster->cluster_base_id;
            }
        }
        $this->clusterSelect();
    }
    public function update(){
        $this->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'email' => 'required|string',
        ]);


        if(User::where('name', $this->abbrev)->exists()){
            $user = User::where('name', $this->abbrev)->update([
                'email' => $this->email,
            ]);

            $program = Program::find($this->programId)->updated([
                'name' => $this->name,
                'code' => $this->code,
                'abbrev' => $this->abbrev,
            ]);
            if(!is_null($this->cluster_searchable_id) && !Cluster::where('program_id',$this->programId)->exists()){
                Cluster::create([
                    'program_id' => $this->programId,
                    'cluster_base_id' => $this->cluster_searchable_id,
                ]);
            }elseif(!is_null($this->cluster_searchable_id) && Cluster::where('program_id',$this->programId)->exists()){
                Cluster::where('program_id',$this->programId)->update([
                    'program_id' => $this->programId,
                    'cluster_base_id' => $this->cluster_searchable_id,
                ]);
            }
            $this->dispatch('clientProgramIdx_refresh');
            $this->success('Program has been udpated.', position: 'toast-top toast-center');
            $this->editProgramModal = false;

        }


    }
}
