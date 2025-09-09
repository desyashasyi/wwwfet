<?php

namespace App\Livewire\Client\Data\Basic;

use App\Models\FetNet\Semester;
use Livewire\Component;
use Mary\Traits\Toast;

class SetSemester extends Component
{
    use Toast;
    public $buttonAddSemester = true;
    public $semester;
    public $year;
    public $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'w-1/12 hidden'],
        ['key' => 'year', 'label' => 'Year', 'class' => 'w-2/12'],
        ['key' => 'semester', 'label' => 'Semester', 'class' => 'w-1/12 align-top text-center'],
        ['key' => 'action', 'label' => 'Action', 'class' => 'w-1/12 align-top text-right'],
    ];
    public function render()
    {
        $semesters = Semester::where('client_id', auth()->user()->client->id)->paginate(5);
        return view('livewire.client.data.basic.set-semester',['semesters' => $semesters]);
    }
    public function addSemester(){
        if($this->buttonAddSemester){
            $this->buttonAddSemester = false;
        }else{
            $this->buttonAddSemester = true;
        }
    }

    public function save(){
        $this->validate([
            'semester' => 'required',
            'year' => 'required',
        ]);

        $semester = Semester::where('client_id', auth()->user()->client->id)
            ->where('year', $this->year)
            ->where('semester', $this->semester)
            ->first();

        if(is_null($semester)){
            Semester::create([
                'year' => $this->year,
                'semester' => $this->semester,
                'client_id' => auth()->user()->client->id,
            ]);
            $this->success('Semester data has been saved.', position: 'toast-top toast-center');
        }else{
            $this->error('Semester data already in the database.', position: 'toast-top toast-center');
        }
    }
}
