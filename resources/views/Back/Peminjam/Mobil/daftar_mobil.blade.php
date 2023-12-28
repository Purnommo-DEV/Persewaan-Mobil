@extends('Back.layout.master', ['title' => 'Daftar Mobil'])
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
                                    <th>Merek</th>
                                    <th>Model</th>
                                    <th>Nomor Plat</th>
                                    <th>Tarif Harian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_mobil as $mobil)
                                    @if ($mobil->status == 0)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $mobil->merek }}</td>
                                            <td>{{ $mobil->model }}</td>
                                            <td>{{ $mobil->nomor_plat }}</td>
                                            <td>{{ help_format_rupiah($mobil->tarif_harian) }}</td>
                                            <td><button type="button" class="btn btn-success btn-sm mt-2 mb-2" href="#"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalPesanMobil{{ $mobil->nomor_plat }}">Sewa</button>
                                            </td>
                                        </tr>

                                        <div class="modal fade text-left" id="modalPesanMobil{{ $mobil->nomor_plat }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false"
                                            aria-labelledby="myModalLabel33" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel33">Pesan Mobil</h4>
                                                        <button type="button" class="close batal" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('peminjam.ProsesPesanMobil') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="nomor_plat"
                                                                value="{{ $mobil->nomor_plat }}" class="form-control"
                                                                placeholder="Name tanggal_mulai" hidden>

                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <label class="col col-form-label" for="kategori">Tanggal
                                                                        Mulai</label>
                                                                    <input type="datetime-local" name="tanggal_mulai"
                                                                        class="form-control"
                                                                        placeholder="Name tanggal_mulai" required>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <label class="col col-form-label" for="kategori">Tanggal
                                                                        Akhir</label>
                                                                    <input type="datetime-local" name="tanggal_akhir"
                                                                        class="form-control"
                                                                        placeholder="Name tanggal_akhir" required>
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
                                    @endif
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
