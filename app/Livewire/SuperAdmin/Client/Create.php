<?php

namespace App\Livewire\SuperAdmin\Client;

use App\Models\FetNet\Client;
use App\Models\FetNet\ClientConfig;
use App\Models\FetNet\ClientLevel;
use App\Models\FetNet\ClusterBase;
use App\Models\FetNet\Faculty;
use App\Models\FetNet\University;
//use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Create extends Component
{

    public $client_level_searchable_id = null;
    public $clientLevelsSearchable;
    public $faculty_searchable_id = null;
    public $facultiesSearchable;
    public $university_searchable_id = null;
    public $universitiesSearchable;

    public $username;
    public $password;
    public $email;
    public $description;
    public $clusterName;
    public $clusterAbb;

    public function render()
    {
        return view('livewire.super-admin.client.create');
    }
    public function mount()
    {
        // Fill options when component first renders
        $this->universitySelect();
        $this->facultySelect();
        $this->clientLevelsSelect();
    }

    public function clientLevelsSelect(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = ClientLevel::where('id', $this->client_level_searchable_id)->get();
        //$this->faculties = $selectedOption;
        $this->clientLevelsSearchable = ClientLevel::query()
            ->where('code', 'like', "%$value%")
            ->orwhere('level', 'like', "%$value%")
            ->take(5)
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
    }
    public function facultySelect(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = Faculty::where('id', $this->faculty_searchable_id)->get();
        //$this->faculties = $selectedOption;
        $this->facultiesSearchable = Faculty::query()
            ->where('code', 'like', "%$value%")
            ->orwhere('name', 'like', "%$value%")
            ->take(5)
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
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

    #[On('superAdminClientCreate_refreshChoice')]
    public function refreshChoice(){
        $this->universitySelect();
        $this->facultySelect();
    }

    public function save(){
        $this->validate([
            'username' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            //'username' => 'required',
            //'email' => 'required',
            'password' => 'required',
            'description' => 'required',
            'client_level_searchable_id' => 'required',
            'faculty_searchable_id' => 'required',
            'university_searchable_id' => 'required',
        ]);


        if(!User::where('name', $this->username)->exists()){
            if($this->client_level_searchable_id == ClientLevel::where('code', 'CLU')->first()->id){
                $this->validate([
                    'clusterName' => 'required',
                    'clusterAbb' => 'required',
                ]);
            }
            $user = User::create([
                'password' => Hash::make($this->password),
                'name' => $this->username,
                'email' => $this->email,
            ]);
            //$user = User::where('name', $this->username)->first();
            $user->assignRole('client');
            Client::create([
                'user_id' => $user->id,
                'faculty_id' => $this->faculty_searchable_id,
                'university_id' => $this->university_searchable_id,
                'client_level_id' => $this->client_level_searchable_id,
                'description' => $this->description,
            ]);

            ClientConfig::create([
                'client_id' => Client::where('user_id', $user->id)->first()->id,
                'number_of_days' => 0,
                'number_of_hours' => 0,
            ]);
            if($this->client_level_searchable_id == ClientLevel::where('code', 'CLU')->first()->id){
                ClusterBase::create([
                    'client_id' => Client::where('user_id', $user->id)->first()->id,
                    'name' => $this->clusterName,
                    'code' => $this->clusterAbb,
                ]);
            }
            $this->dispatch('superAdminClientIndex_enableAddClient');
        }
        //$user = User::where('name', $this->username)->first();

    }
}
