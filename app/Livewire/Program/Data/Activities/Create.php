<?php

namespace App\Livewire\Program\Data\Activities;

use App\Models\FetNet\Subject;
use Livewire\Component;

class Create extends Component
{
    public $subjectSearchable;
    public $subject_searchable_id = null;
    public function render()
    {
        return view('livewire.program.data.activities.create');
    }
    public function clusterSelect(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = Subject::where('id', $this->subject_searchable_id)->get();
        //$this->faculties = $selectedOption;
        $this->subjectSearchable = Subject::query()
            ->where('code', 'like', "%$value%")
            ->orwhere('name', 'like', "%$value%")
            ->take(5)
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
    }
}
