@extends('Back.layout.master', ['title' => 'Daftar Peminjaman'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="table-data-daftar">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Model</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Tarif Harian</th>
                                    <th>Durasi</th>
                                    <th>Total Biaya</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftar_peminjaman as $peminjaman)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $peminjaman->mobil_relasi->model }}</td>
                                        <td>{{ help_tanggal_jam($peminjaman->tanggal_mulai) }}</td>
                                        <td>{{ help_tanggal_jam($peminjaman->tanggal_akhir) }}</td>
                                        <td>{{ help_format_rupiah($peminjaman->mobil_relasi->tarif_harian) }}</td>
                                        <td>{{ $peminjaman->durasi }} Hari</td>
                                        <td>{{ help_format_rupiah($peminjaman->total_biaya_sewa) }}</td>
                                        <td>
                                            @if ($peminjaman->status == 1)
                                                <button type="button" class="btn btn-primary btn-sm mt-2 mb-2" href="#"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalPengembalianMobil{{ $peminjaman->id }}">Pengembalian</button>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>

                                    <div class="modal fade text-left" id="modalPengembalianMobil{{ $peminjaman->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel33"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel33">Pengembalian</h4>
                                                    <button type="button" class="close batal" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <form action="{{ route('peminjam.ProsesPengembalianMobil') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="{{ $peminjaman->id }}"
                                                            hidden>

                                                        <div class="row mb-3">
                                                            <div class="col-md-5">
                                                                <label class="col col-form-label" for="kategori">Tanggal
                                                                    Awal</label>
                                                                <input value="{{ $peminjaman->tanggal_mulai }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label class="col col-form-label" for="kategori">Tanggal
                                                                    Akhir</label>
                                                                <input value="{{ $peminjaman->tanggal_akhir }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="col col-form-label"
                                                                    for="kategori">Durasi</label>
                                                                <input value="{{ $peminjaman->durasi }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="col col-form-label" for="kategori">Total
                                                                    Biaya Sewa</label>
                                                                <input class="form-control"
                                                                    value="{{ $peminjaman->total_biaya_sewa }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary batal"
                                                            data-bs-dismiss="modal">
                                                            Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-primary ml-1">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#table-data-daftar').DataTable();
        });
    </script>
@endsection
