<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use App\Models\Division;
use Livewire\WithPagination;

class ListUser extends Component
{

    use WithPagination;


    public $paginate = 10;
    public $cari;
    
    protected $paginationTheme = 'bootstrap';
    
    
    protected $listeners = [
        'dataStored' => 'handleStored',
        'dataUpdated' => 'handleUpdated',
    ];

    public function render()
    {
        return view('livewire.admin.user.list-user', [
            'datas' => $this->cari === null ?
                        User::where('is_admin', false)->latest()->paginate($this->paginate)
                        :
                        User::where('is_admin', false)
                                    ->where(function ($query) {
                                        $query->where('name', 'like', '%'. $this->cari.'%')
                                            ->orWhere('email', 'like', '%'. $this->cari.'%');
                                    })
                                    ->latest()
                                    ->paginate($this->paginate),
            'dataCount' => $this->cari === null ?
                        User::where('is_admin', false)->latest()
                        :
                        User::where('is_admin', false)
                                    ->where(function ($query) {
                                        $query->where('name', 'like', '%'. $this->cari.'%')
                                            ->orWhere('email', 'like', '%'. $this->cari.'%');
                                    })
                                    ->latest(),
            
        ]);
    }

    public function destroy($id)
    {
        if ($id) {
            $data = User::find($id);
            session()->flash('message' , $data['name'].' berhasil dihapus');
            $data->delete();
        }
    }

}
