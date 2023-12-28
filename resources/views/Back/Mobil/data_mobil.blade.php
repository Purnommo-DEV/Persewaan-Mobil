@extends('Back.layout.master', ['title' => 'Data Mobil'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalTambahDataMobil"><i class="bi bi-plus"></i> Tambah Mobil</button>

                        <div class="modal fade text-left" id="modalTambahDataMobil" data-bs-backdrop="static"
                            data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Mobil</h4>
                                        <button type="button" class="close batal" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('pemilik.TambahDataMobil') }}" id="formTambahDataMobil"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">


                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="kategori">Merek</label>
                                                    <input name="merek" class="form-control" placeholder="Name merek">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text merek_error"></label>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="kategori">Model</label>
                                                    <input name="model" class="form-control" placeholder="Name model">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text model_error"></label>
                                                </div>
                                            </div>



                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="kategori">nomor_plat</label>
                                                    <input name="nomor_plat" class="form-control"
                                                        placeholder="Name nomor_plat">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text nomor_plat_error"></label>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="kategori">tarif_harian</label>
                                                    <input name="tarif_harian" class="form-control"
                                                        placeholder="Name tarif_harian">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text tarif_harian_error"></label>
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
                        <table class="table table-striped" id="table-data-mobil">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Merek</th>
                                    <th>Model</th>
                                    <th>Nomor Plat</th>
                                    <th>Tarif Harian</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_mobil as $mobil)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $mobil->merek }}</td>
                                        <td>{{ $mobil->model }}</td>
                                        <td>{{ $mobil->nomor_plat }}</td>
                                        <td>{{ help_format_rupiah($mobil->tarif_harian) }}</td>
                                        <td>
                                            @if ($mobil->status == 0)
                                                Tersedia
                                            @elseif($mobil->status == 1)
                                                Tidak Tersedia
                                            @endif
                                        </td>
                                        <td><a href="{{ route('pemilik.HalamanEditDataMobil', $mobil->nomor_plat) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm hapus_mobil"
                                                id-mobil = "{{ $mobil->id }}}" href="#!">Hapus</button>
                                        </td>
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
            $('#table-data-mobil').DataTable();
        });


        $('#formTambahDataMobil').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $(document).find('label.error-text').text('');
                },
                success: function(data) {
                    if (data.status_form_kosong == 1) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                    } else if (data.status_berhasil == 1) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        })
                        location.reload();
                    }
                },
            });
        });

        // $('#formEditDataKategori').on('submit', function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: $(this).attr('action'),
        //         method: $(this).attr('method'),
        //         data: new FormData(this),
        //         processData: false,
        //         dataType: 'json',
        //         contentType: false,
        //         beforeSend: function() {
        //             $(document).find('label.error-text').text('');
        //         },
        //         success: function(data) {
        //             if (data.status == 0) {
        //                 $.each(data.error, function(prefix, val) {
        //                     $('label.' + prefix + '_error').text(val[0]);
        //                     // $('span.'+prefix+'_error').text(val[0]);
        //                 });
        //             } else if (data.status == 1) {
        //                 $("#modalEditDataKategori").modal('hide');
        //                 const Toast = Swal.mixin({
        //                     toast: true,
        //                     position: 'top-end',
        //                     showConfirmButton: false,
        //                     timer: 3000,
        //                     timerProgressBar: true,
        //                     didOpen: (toast) => {
        //                         toast.addEventListener('mouseenter', Swal
        //                             .stopTimer)
        //                         toast.addEventListener('mouseleave', Swal
        //                             .resumeTimer)
        //                     }
        //                 })

        //                 Toast.fire({
        //                     icon: 'success',
        //                     title: data.msg
        //                 })
        //                 table_data_kategori.ajax.reload(null, false);
        //             }
        //         }
        //     });
        // });

        $(document).on('click', '.hapus_kategori', function(event) {
            const id = $(event.currentTarget).attr('id-kategori');

            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-kategori/" + id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 0) {
                                alert("Gagal Hapus")
                            } else if (data.status == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                        icon: 'success',
                                        title: data.msg
                                    }),
                                    table_data_kategori.ajax.reload()
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });
    </script>
@endsection
