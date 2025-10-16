<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ActionPanel extends Component
{
    public $activeTab = 'dashboard'; // Tab default saat halaman dibuka

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.admin.action-panel');
    }
}