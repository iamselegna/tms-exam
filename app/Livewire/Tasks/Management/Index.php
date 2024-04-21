<?php

namespace App\Livewire\Tasks\Management;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $pageSize = 10;
    public $orderBy = 'title';
    public function render()
    {

        return view('livewire.tasks.management.index');
    }
}
