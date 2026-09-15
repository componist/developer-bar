<?php

namespace Componist\DeveloperBar\Livewire;

use Componist\DeveloperBar\Application\DeveloperBarService;
use Livewire\Component;

class ComponistDeveloperBar extends Component
{
    public $message = null;

    public function render()
    {
        return view('developer-bar::livewire.componist-developer-bar');
    }

    public function clearCache()
    {
        DeveloperBarService::clearApplicationCache();
        $this->message = 'Cache wurde erfolgreich geleert!';
    }
}