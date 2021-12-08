<?php

namespace App\Http\Livewire\Admin\Note;

use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;

class NoteIndex extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $cari;
    
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        return view('livewire.admin.note.note-index', [
            'dataSet' => Note::latest()->paginate($this->paginate),
            'dataCount' => Note::all(),
        ]);
    }
}
