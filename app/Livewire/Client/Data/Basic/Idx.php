<?php

namespace App\Livewire\Client\Data\Basic;

use App\Models\FetNet\Client;
use App\Models\FetNet\ClientConfig;
use App\Models\FetNet\Days;
use Livewire\Component;
use Carbon\Carbon;

class Idx extends Component
{
    public $numberOfDays = 0;
    public $numberOfHours = 0;
    public function render()
    {
        $client = Client::where('user_id', auth()->user()->id)->first();
        if(!is_null($client->config)){
            $this->numberOfDays = $client->config->number_of_days;
            $this->numberOfHours = $client->config->number_of_hours;

        }
        return view('livewire.client.data.basic.idx', ['client' => $client]);
    }

    public function daysDecrement()
    {
        if($this->numberOfDays > 0){
            $this->numberOfDays--;
            ClientConfig::where('client_id', auth()->user()->client->id)->update(['number_of_days' => $this->numberOfDays]);
        }
    }
    public function daysIncrement()
    {
        if($this->numberOfDays < 5){
            $this->numberOfDays++;
            ClientConfig::where('client_id', auth()->user()->client->id)->update(['number_of_days' => $this->numberOfDays]);
        }
    }
    public function hoursDecrement()
    {
        if($this->numberOfHours > 0){
            $this->numberOfHours--;
            ClientConfig::where('client_id', auth()->user()->client->id)->update(['number_of_hours' => $this->numberOfHours]);
        }
    }
    public function hoursIncrement()
    {
        if($this->numberOfHours < 12){
            $this->numberOfHours++;
            ClientConfig::where('client_id', auth()->user()->client->id)->update(['number_of_hours' => $this->numberOfHours]);
        }
    }

    public function mount(){
        Carbon::setWeekStartsAt(Carbon::MONDAY);
    }
}
