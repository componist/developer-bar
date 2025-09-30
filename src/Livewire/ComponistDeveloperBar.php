<?php

namespace Componist\DeveloperBar\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;

class ComponistDeveloperBar extends Component
{
    public $message = null;

    public function render()
    {
        return view('developer-bar::livewire.componist-developer-bar');
    }

    public function clearCache()
    {
        Artisan::call('optimize:clear');
        $this->message = 'Cache wurde erfolgreich geleert!';
    }
}