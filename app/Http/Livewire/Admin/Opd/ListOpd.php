<?php

namespace App\Http\Livewire\Admin\Opd;

use Livewire\Component;
use App\Models\Division;
use Livewire\WithPagination;

class ListOpd extends Component
{
    use WithPagination;

    public $statusUpdate = false;

    public $data;
    public $nama;
    public $singkatan;
    public $paginate = 10;
    public $cari;
    
    public $editNama;
    public $editSingkatan;
    public $idOpd;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'dataStored' => 'handleStored',
        'dataUpdated' => 'handleUpdated',
    ];

    public function render()
    {
        // $this->data = Division::latest()->paginate(5);
        return view('livewire.admin.opd.list-opd', [
            'datas' => $this->cari === null ?
                        Division::latest()->paginate($this->paginate)
                        :
                        Division::where('nama', 'like', '%'. $this->cari.'%')
                                    ->orWhere('singkatan', 'like', '%'. $this->cari.'%')
                                    ->latest()
                                    ->paginate($this->paginate),
            'dataCount' => $this->cari === null ?
                        Division::latest()
                        :
                        Division::where('nama', 'like', '%'. $this->cari.'%')
                                    ->orWhere('singkatan', 'like', '%'. $this->cari.'%')
                                    ->latest(),
            
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'singkatan' => 'required'
        ]);

        $data = Division::create([
            'nama' => $this->nama,
            'singkatan' => $this->singkatan,
        ]);

        $this->resetInput();

        $this->emit('dataStored', $data);
    }

    public function showOpd($id)
    {
        $data = Division::find($id);
        $this->editNama = $data['nama'];
        $this->editSingkatan = $data['singkatan'];
        $this->idOpd = $data['id'];
    }

    public function update()
    {
        $this->validate([
            'editNama' => 'required',
            'editSingkatan' => 'required'
        ]);

        if ($this->idOpd) {
            $data = Division::find($this->idOpd);
            $data->update([
                'nama' => $this->editNama,
                'singkatan' => $this->editSingkatan,
            ]);

            // dd($data);

            $this->resetEditInput();

            $this->emit('dataUpdated', $data);
        }
    }

    private function resetInput()
    {
        $this->nama = null;
        $this->singkatan = null;
    }
    
    private function resetEditInput()
    {
        $this->idOpd = null;
        $this->editNama = null;
        $this->editSingkatan = null;
    }

    public function getOpd($id)     
    {
        $this->statusUpdate = true;
        $data = Division::find($id);
        $this->emit('getOpd', $data);
    }

    public function destroy($id)
    {
        if ($id) {
            $data = Division::find($id);
            session()->flash('message' , $data['nama'].' ('.$data['singkatan'].') berhasil dihapus');
            $data->delete();
        }
    }

    public function handleStored($data)
    {
        // dd($data);
        session()->flash('message' , $data['nama'].' ('.$data['singkatan'].') berhasil disimpan');
    }
    
    public function handleUpdated($data)
    {
        // dd($data);
        $this->statusUpdate = false;
        session()->flash('message' , $data['nama'].' ('.$data['singkatan'].') berhasil diupdate');
    }

}
