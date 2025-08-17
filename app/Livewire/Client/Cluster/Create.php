<?php

namespace App\Livewire\Client\Cluster;

use App\Models\FetNet\ClusterBase;
use Livewire\Attributes\On;
use Livewire\Component;
use Auth;
use Mary\Traits\Toast;
class Create extends Component
{
    use Toast;
    public $createClusterModal = false;
    public $clusterName;
    public $clusterCode;
    public function render()
    {
        return view('livewire.client.cluster.create');
    }

    #[On('clientCluster_Create')]
    public function clientCluster_Create(){
        $this->createClusterModal = true;
    }
    public function save(){
        $this->validate([
            'clusterName' => 'required|unique:institution_program_cluster_base,name',
            'clusterCode' => 'required|unique:institution_program_cluster_base,code',
        ]);
        ClusterBase::create([
            'client_id' => Auth()->user()->client->id,
            'name' => $this->clusterName,
            'code' => $this->clusterCode,
        ]);
        $this->success('Cluster has been saved.', position: 'toast-top toast-center');
        $this->createClusterModal = false;
        $this->dispatch('clientProgramCreate_Refresh');

    }
}
