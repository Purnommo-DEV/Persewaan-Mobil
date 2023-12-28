@extends('Back.layout.master', ['title' => 'Edit Data Mobil'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pemilik.ProsesEditDataMobil') }}" id="formEditDataMobil" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">

                                <input type="hidden" value="{{ $data_mobil->id }}" name="mobil_id" hidden>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col col-form-label" for="kategori">Merek</label>
                                        <input name="merek" value="{{ $data_mobil->merek }}" class="form-control"
                                            placeholder="Merek">
                                    </div>
                                    <div class="input-group has-validation">
                                        <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                            class="text-danger error-text merek_error"></label>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col col-form-label" for="kategori">Model</label>
                                        <input name="model" value="{{ $data_mobil->model }}" class="form-control"
                                            placeholder="Model">
                                    </div>
                                    <div class="input-group has-validation">
                                        <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                            class="text-danger error-text model_error"></label>
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col col-form-label" for="kategori">Nomor Plat</label>
                                        <input name="nomor_plat" value="{{ $data_mobil->nomor_plat }}" class="form-control"
                                            placeholder="Nomor Plat">
                                    </div>
                                    <div class="input-group has-validation">
                                        <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                            class="text-danger error-text nomor_plat_error"></label>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col col-form-label" for="kategori">Tarif Harian</label>
                                        <input name="tarif_harian" value="{{ $data_mobil->tarif_harian }}"
                                            class="form-control" placeholder="Tarif Harian">
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
