<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Functions extends Component
{

    public $listeners = [
        'getLocation', 'showLocation'
    ];

    public $userLocation;

//    public function getLocation()
//    {
//        $this->emit('getUserLocation');
//        public function showLocation($data = null)
//        {
//            $this->userLocation = $data->location;
//            dd($this->userLocation);
//        }
//        dd($this->userLocation);
//
//
//    }

    public function render()
    {
        return view('livewire.functions');
    }
}
