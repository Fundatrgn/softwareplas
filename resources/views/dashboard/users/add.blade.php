@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Admin Ekle</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Admin</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" action="/admin/kullanicilar/add" method="POST" validate
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Ad & Soyad</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="name"
                                        placeholder="Ad & Soyad" required value="{{ $data->name ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="email"
                                        placeholder="Email" required value="{{ $data->email ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Şifre</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="password"
                                        placeholder="Şifre" required >
                                </div>
                               

                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Ekle</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
