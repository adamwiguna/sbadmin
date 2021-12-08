<div>
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List User</h6>
        </div>
        <div class="card-body">
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
                        Buat User Baru
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

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>NIP/Username</th>
                        <th>Nama</th>
                        <th>OPD</th>
                        <th></th>
                    </tr>     
                </thead>
                <tbody>
                    @foreach ($datas as $user)   
                    <tr>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ (!$user->division == null) ? $user->division->nama : 'OPD Tidak Ditemukan' }}</td>
                        <td>
                           <a  class="btn btn-sm btn-info text-white" href="{{ route('admin.user.edit', ['user' => $user]) }}">
                                Edit
                            </a>
                            <a class="btn btn-sm btn-danger text-white" href="#" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                                Hapus
                            </a>
                        </td>
                    </tr>   
                                        
                    <!-- Delete Modal-->
                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ingin menghapus "{{ $user->name }}"?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Pilih "Hapus" dibawah jika ingin menghapus data diatas</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button wire:click="destroy({{ $user->id }})" class="btn btn-danger text-white" data-dismiss="modal">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                </tbody>
            </table>
            {{ $datas->links() }}
        </div>
    </div>
</div>
