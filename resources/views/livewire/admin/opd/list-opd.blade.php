<div>
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List OPD</h6>
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
                    <a class="btn btn-sm btn-primary text-white mb-2" href="#" data-toggle="modal" data-target="#createModal">
                        Buat OPD Baru
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

            <!--Create Modal-->
            <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="store">
                                <div class="form-group">
                                  <label for="exampleInputEmail1" class=" text-dark">Nama OPD</label>
                                  <input wire:model="nama"  type="text" class="form-control @error('nama') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama">
                                  @error('nama')
                                      <span class="invalid-feedback">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1" class=" text-dark">Singkatan Nama OPD</label>
                                  <input  wire:model="singkatan" type="text" class="form-control @error('singkatan') is-invalid @enderror" id="exampleInputPassword1" placeholder="Masukkan Singkatan">
                                  @error('singkatan')
                                  <span class="invalid-feedback">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                                </div>
                        </div>
                        <div class="modal-footer">
                                <button wire:click="store" type="submit" class="btn btn-primary" data-dismiss="modal" {{ $errors->any()?'':'modal' }} >Submit</button>
                            </form>      
                    </div>
                    </div>
                </div>
            </div>

            <small class=" text-bold text-warning">
                Total ada {{ $dataCount->count() }} hasil
            </small>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Singkatan<th>
                    </tr>     
                </thead>
                <tbody>
                    @foreach ($datas as $opd)   
                    <tr>
                        <td>{{ $opd->nama }}</td>
                        <td>{{ $opd->singkatan }}</td>
                        <td>
                            <a wire:click="showOpd({{ $opd->id }})" class="btn btn-sm btn-info text-white" href="#" data-toggle="modal" data-target="#editModal{{ $opd->id }}">
                                Edit
                            </a>
                            <a class="btn btn-sm btn-danger text-white" href="#" data-toggle="modal" data-target="#deleteModal{{ $opd->id }}">
                                Hapus
                            </a>
                        </td>
                    </tr>   
                    
                    <!--Edit Modal-->
                    <div wire:ignore.self class="modal fade" id="editModal{{ $opd->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Form Edit</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form wire:submit.prevent="update">
                                        <input type="hidden" wire:model='idOpd'>
                                        <div class="form-group">
                                        <label for="exampleInputEmail1" class=" text-dark">Nama OPD</label>
                                        <input wire:model="editNama" type="text" class="form-control @error('nama') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama">
                                        @error('nama')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                        <label for="exampleInputPassword1" class=" text-dark">Singkatan Nama OPD</label>
                                        <input  wire:model="editSingkatan" type="text" class="form-control @error('singkatan') is-invalid @enderror" id="exampleInputPassword1" placeholder="Masukkan Singkatan">
                                        @error('singkatan')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                        </div>
                                </div>
                                <div class="modal-footer">
                                        <button wire:click="update({{ $opd->id }})" type="submit" class="btn btn-primary" data-dismiss="modal">Submit</button>
                                    </form>      
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Delete Modal-->
                    <div class="modal fade" id="deleteModal{{ $opd->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ingin menghapus "{{ $opd->nama }}"?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Pilih "Hapus" dibawah jika ingin menghapus data diatas</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button wire:click="destroy({{ $opd->id }})" class="btn btn-danger text-white" data-dismiss="modal">Hapus</button>
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
