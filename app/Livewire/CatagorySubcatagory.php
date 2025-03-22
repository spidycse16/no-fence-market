<?php

namespace App\Livewire;

use App\Models\Subcatagory;
use Livewire\Component;
use App\Models\Catagory;

class CatagorySubcatagory extends Component
{
    public $catagories=[];
    public $selectedCatagory;

    public $subcatagories=[];

    public function mount()
    {
        $this->catagories=Catagory::all();
    }

    public function render()
    {
        return view('livewire.catagory-subcatagory');
    }

    public function updatedSelectedCatagory($catagory_id)
    {
        $this->subcatagories=Subcatagory::where('catagory_id',$catagory_id)->get();
    }
}
