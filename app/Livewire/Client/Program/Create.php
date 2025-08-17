<?php

namespace App\Livewire\Client\Program;

use App\Models\FetNet\ClientLevel;
use App\Models\FetNet\Cluster;
use App\Models\FetNet\ClusterBase;
use App\Models\FetNet\Program;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{

    use Toast;
    public $clusterSearchable;
    public $cluster_searchable_id = null;
    public $name;
    public $code;
    public $abbrev;
    public $password;
    public $email;
    public $description;
    public  $createProgramEnableState = false;
    #[On('clientProgramCreate_Refresh')]
    public function render()
    {
        $this->clusterSelect();
        return view('livewire.client.program.create');
    }

    public function mount()
    {
        $this->clusterSelect();
        if(auth()->user()->client->level->code == 'CLU'){
            $this->cluster_searchable_id = auth()->user()->client->cluster->id;
        }
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
    public function save(){
        $this->validate([
            'name' => 'required|string|unique:institution_program,name',
            'code' => 'required|string|unique:institution_program,code',
            'abbrev' =>'required|string|unique:institution_program,abbrev',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $this->abbrev,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole('program');
        //$user = User::where('email', $this->email)->first();
        $program = Program::create([
            'name' => $this->name,
            'code' => $this->code,
            'abbrev' => $this->abbrev,
            'client_id' => Auth()->user()->client->id,
            'user_id' => $user->id,
        ]);
        if(!is_null($this->cluster_searchable_id)){
            Cluster::create([
                'program_id' => $program->id,
                'cluster_base_id' => $this->cluster_searchable_id,
            ]);
        }
        $this->name = null;
        $this->code = null;
        $this->abbrev = null;
        $this->description = null;
        $this->password = null;
        $this->email = null;
        $this->success('Program has been saved.', position: 'toast-top toast-center');
    }
    #[On('adminDataProgramIdx_createProgramEnable')]
    public function createProgramEnable(){
        if($this->createProgramEnableState == true){
            $this->createProgramEnableState = false;
        }else{
            $this->createProgramEnableState = true;
        }
    }
}


