<?php

namespace App\Livewire\SuperAdmin\Client;

use App\Models\FetNet\Client;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
class Idx extends Component
{
    public $addData = false;
    public $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'w-1/12 hidden'],
        ['key' => 'user', 'label' => 'User', 'class' => 'w-1/12 align-top'],
        ['key' => 'email', 'label' => 'Email', 'class' => 'w-2/12 align-top'],
        ['key' => 'description', 'label' => 'Description', 'class' => 'w-4/12 align-top'],
        ['key' => 'level', 'label' => 'Category', 'class' => 'w-2/12 align-top'],
        ['key' => 'action', 'label' => 'Action', 'class' => 'w-2/12 align-top text-right'],
    ];
    public function render()
    {
        $clients = Client::paginate(10);
        return view('livewire.super-admin.client.idx', ['clients' => $clients]);
    }

    #[On('superAdminClientIndex_enableAddClient')]
    public function enableAddClient(){
        if($this->addData == true){
            $this->addData = false;
        }else{
            $this->addData = true;
        }

        //Auth::user()->assignRole('super-admin',['team_id' => null]);
        /*$role = Role::findByName('super-admin');
        $permission = Permission::create(['name' => 'view-super-admin-menu']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);
        */
    }

    public function loginAs($id){
        $client = Client::find($id);
        $user = $client->user;
        auth()->login($user);
        return redirect()->route('client.idx');
    }
}
