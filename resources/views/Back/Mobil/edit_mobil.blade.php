@extends('Back.layout.master', ['title' => 'Edit Data Mobil'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pemilik.TambahDataMobil') }}" id="formTambahDataMobil" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">


                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col col-form-label" for="kategori">merek</label>
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
                                        <input name="nomor_plat" class="form-control" placeholder="Name nomor_plat">
                                    </div>
                                    <div class="input-group has-validation">
                                        <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                            class="text-danger error-text nomor_plat_error"></label>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col col-form-label" for="kategori">tarif_harian</label>
                                        <input name="tarif_harian" class="form-control" placeholder="Name tarif_harian">
                                    </div>
                                    <div class="input-group has-validation">
                                        <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                            class="text-danger error-text tarif_harian_error"></label>
                                    </div>
                                </div>



                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary batal" data-bs-dismiss="modal">
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
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
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
                        })
                    }
                },
            });
        });
    </script>
@endsection
