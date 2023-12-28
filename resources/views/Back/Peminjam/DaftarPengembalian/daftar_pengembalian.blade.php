@extends('Back.layout.master', ['title' => 'Daftar Pengembalian'])
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_pengembalian as $pengembalian)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $pengembalian->mobil_relasi->model }}</td>
                                        <td>{{ help_tanggal_jam($pengembalian->tanggal_mulai) }}</td>
                                        <td>{{ help_tanggal_jam($pengembalian->tanggal_akhir) }}</td>
                                        <td>{{ help_format_rupiah($pengembalian->mobil_relasi->tarif_harian) }}</td>
                                        <td>{{ $pengembalian->durasi }} Hari</td>
                                        <td>{{ help_format_rupiah($pengembalian->total_biaya_sewa) }}</td>
                                    </tr>
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
