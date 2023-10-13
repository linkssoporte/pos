<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Tester extends Component
{
    public function render()
    {
        return view('livewire.tester')->layout('layouts.theme.app');
    }

    public function probar(){
        $this->dispatchBrowserEvent('ok',['msg'=> 'PROBANDO LAS NOTIFICACIONES Y EVENTOS']);
    }
}
