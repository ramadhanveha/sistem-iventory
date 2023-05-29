@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Barang Masuk</h1>
        <!-- Button trigger modal -->
        @hasanyrole('Admin|Kepala Lab')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
            </button>
        @endhasanyrole
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('barang_masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="barang">Nama Barang :</label>
                            <select style="width:100%" name="barang_id" id="barang" class="form-control select" required>
                                @foreach ($barangs as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_barang">Jumlah Barang :</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah_barang">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Barang :</label>
                            <input type="file" name="image" class="form-control" id="foto" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                        <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                    </div>
            </div>
            </form>


        </div>
    </div>



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Kode Barang</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Foto Barang Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang_masuk as $bk)
                            <tr align="center">
                                <td>{{ $bk->barang->kode_barang }}</td>
                                <td>{{ $bk->created_at->format('d-m-Y') }}</td>
                                <td>{{ $bk->barang->nama_barang }}</td>
                                <td>{{ $bk->jumlah }}</td>
                                <td><img src="/storage/{{ $bk->image }}" alt="barang masuk foto" width="150"
                                        height="150"></td>

                                <td align="center" width="10%">
                                    @hasanyrole('Admin|Kepala Lab')

                                        <a href="{{ route('barang_masuk.edit', [$bk->id]) }}" data-toggle="tooltip"
                                            title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/barang_masuk/hapus/{{ $bk->id }}" data-toggle="tooltip" title="Hapus"
                                            onclick="return confirm('Yakin Ingin menghapus data?')"
                                            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i>
                                        </a>
                                    @endhasanyrole
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select').select2({
                tags: true,
                width: 'resolve'
            });
        });
    </script>
@endsection
