<div class="p-0">
    <hr>
        <div class="card-body px-0">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="row">
                <div class="col">
                    <a class="btn btn-sm btn-primary text-white mb-2" href="{{ route('admin.user.create') }}">
                        Buat Note Baru
                    </a>
                </div>
                <div class="col">
                    <div class="row">
                        Per Halaman : 
                        <select wire:model="paginate" name="" id="" class="form-control-sm w-auto sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <input wire:model="cari" type="text" class=" form-control-sm" placeholder="Cari">    
                </div>
            </div>

            <small class=" text-bold text-warning">
                Total ada {{ $dataCount->count() }} hasil
            </small>

            @foreach ($dataSet as $note)   

            <div class="card border-left-secondary mt-3 mb-2">
                <div class="card-body px-2 pt-1">
                    <div>
                        Penulis: {{ $note->user->name }}
                    </div>
                    <hr class="sidebar-divider mt-0 mb-2">
                    <div class="text-bold text-dark font-weight-bold">
                        {{ $note->judul }}
                    </div>
                    <div>
                        Diselenggarakan oleh {{ $note->penyelenggara }}, pada {{ $note->tanggal }}
                    </div>
                    <div class=" small text-primary">
                        Di-share ke : {{ $note->tanggal }}
                    </div>
                    
                    <hr class="sidebar-divider mt-0 mb-2">
                    <a  class="btn btn-sm btn-success text-white" href="{{ route('admin.note.show', ['note' => $note]) }}">
                        Lihat
                    </a>
                    <a  class="btn btn-sm btn-info text-white" href="{{ route('admin.note.edit', ['note' => $note]) }}">
                        Edit
                    </a>
                    <a class="btn btn-sm btn-danger text-white" href="#" data-toggle="modal" data-target="#deleteModal{{ $note->id }}">
                        Hapus
                    </a>
                </div>
            </div>            
                    
             
                              
                    <!-- Delete Modal-->
                    <div class="modal fade" id="deleteModal{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ingin menghapus "{{ $note->judul }}"?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Pilih "Hapus" dibawah jika ingin menghapus data diatas</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button wire:click="destroy({{ $note->id }})" class="btn btn-danger text-white" data-dismiss="modal">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
            {{ $dataSet->links() }}
        </div>

</div>
