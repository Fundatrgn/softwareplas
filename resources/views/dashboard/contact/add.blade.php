@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">İletişim Detayı</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">İletişim Detayı </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" action="/admin/ayarlar/add" method="POST" validate
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                <div class="col-md-6">
                                    <label for="bsValidation4" class="form-label">Ad & Soyad</label>
                                    <input type="text" class="form-control" disabled id="bsValidation4" value="{{ $data->name ?? '' }}" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation3" class="form-label">Telefon</label>
                                    <input type="text" class="form-control" disabled id="bsValidation3" name="phone"
                                        placeholder="Başlık" required value="{{ $data->phone ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation3" class="form-label">Email</label>
                                    <input type="text" class="form-control" disabled id="bsValidation3" name="email"
                                        placeholder="Başlık" required value="{{ $data->email ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation3" class="form-label">Proje Tipi</label>
                                    <input type="text" class="form-control" disabled id="bsValidation3" name="type"
                                        placeholder="key1,key2,key3" required value="{{ $data->type ?? '' }}">
                                </div>
                              

                                <div class="col-md-12">
                                    <label for="bsValidation5" class="form-label">Açıklama</label>
                                    <textarea type="text" class="form-control" disabled id="editor" name="content" placeholder="Açıklama">{{ $data->content ?? '' }}</textarea>
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
