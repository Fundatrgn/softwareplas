@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Statik Alan Yönetimi </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Statik Alan Yönetimi</li>
                        </ol>
                    </nav>
                </div>
                {{-- <div class="ms-auto">
                    <div class="btn-group">
                        <a href="/admin/ayarlar/add" class="btn btn-outline-primary">Yeni Ekle</a>
                    </div>
                </div> --}}
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="d-flex" style="flex-wrap:wrap">
                            <ul class="nav nav-tabs nav-danger" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#danger1" role="tab"
                                        aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><ion-icon name="home-sharp" class="me-1 md hydrated"
                                                    role="img" aria-label="home sharp"></ion-icon>
                                            </div>
                                            <div class="tab-title">Slider</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#danger2" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><ion-icon name="person-sharp" class="me-1 md hydrated"
                                                    role="img" aria-label="person sharp"></ion-icon>
                                            </div>
                                            <div class="tab-title">İletişim</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#danger3" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><ion-icon name="call-sharp" class="me-1 md hydrated"
                                                    role="img" aria-label="call sharp"></ion-icon>
                                            </div>
                                            <div class="tab-title">Hizmetler</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#danger4" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><ion-icon name="call-sharp" class="me-1 md hydrated"
                                                    role="img" aria-label="call sharp"></ion-icon>
                                            </div>
                                            <div class="tab-title">Projeler</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#danger5" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><ion-icon name="call-sharp" class="me-1 md hydrated"
                                                    role="img" aria-label="call sharp"></ion-icon>
                                            </div>
                                            <div class="tab-title">Tarihçe</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#danger6" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><ion-icon name="call-sharp" class="me-1 md hydrated"
                                                    role="img" aria-label="call sharp"></ion-icon>
                                            </div>
                                            <div class="tab-title">Video Slogan</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#danger7" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><ion-icon name="call-sharp" class="me-1 md hydrated"
                                                    role="img" aria-label="call sharp"></ion-icon>
                                            </div>
                                            <div class="tab-title">Takım Slog</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#danger8" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><ion-icon name="call-sharp" class="me-1 md hydrated"
                                                    role="img" aria-label="call sharp"></ion-icon>
                                            </div>
                                            <div class="tab-title">Teklif Alanı</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#danger9" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><ion-icon name="call-sharp" class="me-1 md hydrated"
                                                    role="img" aria-label="call sharp"></ion-icon>
                                            </div>
                                            <div class="tab-title">Slogan</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-3">
                                <div class="tab-pane fade active show" id="danger1" role="tabpanel">
                                    <form class="row g-3 needs-validation" action="/admin/ayarlar/static" method="POST"
                                        validate enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="1">

                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Başlık</label>
                                            <input type="text" class="form-control" id="bsValidation4" name="title"
                                                {{ $data->site_title ?? '' }}>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title1 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan2</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title2 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="danger2" role="tabpanel">
                                    <form class="row g-3 needs-validation" action="/admin/ayarlar/add" method="POST"
                                        validate enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="1">

                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Başlık</label>
                                            <input type="text" class="form-control" id="bsValidation4" name="title"
                                                {{ $data->site_title ?? '' }}>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title1 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan2</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title2 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="danger3" role="tabpanel">
                                    <form class="row g-3 needs-validation" action="/admin/ayarlar/add" method="POST"
                                        validate enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="1">

                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Başlık</label>
                                            <input type="text" class="form-control" id="bsValidation4" name="title"
                                                {{ $data->site_title ?? '' }}>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title1 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan2</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title2 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="danger4" role="tabpanel">
                                    <form class="row g-3 needs-validation" action="/admin/ayarlar/add" method="POST"
                                        validate enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="1">

                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Başlık</label>
                                            <input type="text" class="form-control" id="bsValidation4" name="title"
                                                {{ $data->site_title ?? '' }}>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title1 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan2</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title2 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="danger5" role="tabpanel">
                                    <form class="row g-3 needs-validation" action="/admin/ayarlar/add" method="POST"
                                        validate enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="1">

                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Başlık</label>
                                            <input type="text" class="form-control" id="bsValidation4" name="title"
                                                {{ $data->site_title ?? '' }}>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title1 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan2</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title2 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="danger6" role="tabpanel">
                                    <form class="row g-3 needs-validation" action="/admin/ayarlar/add" method="POST"
                                        validate enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="1">

                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Başlık</label>
                                            <input type="text" class="form-control" id="bsValidation4" name="title"
                                                {{ $data->site_title ?? '' }}>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title1 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan2</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title2 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="danger7" role="tabpanel">
                                    <form class="row g-3 needs-validation" action="/admin/ayarlar/add" method="POST"
                                        validate enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="1">

                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Başlık</label>
                                            <input type="text" class="form-control" id="bsValidation4" name="title"
                                                {{ $data->site_title ?? '' }}>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title1 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan2</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title2 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="danger8" role="tabpanel">
                                    <form class="row g-3 needs-validation" action="/admin/ayarlar/add" method="POST"
                                        validate enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="1">

                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Başlık</label>
                                            <input type="text" class="form-control" id="bsValidation4" name="title"
                                                {{ $data->site_title ?? '' }}>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title1 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan2</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title2 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="danger9" role="tabpanel">
                                    <form class="row g-3 needs-validation" action="/admin/ayarlar/add" method="POST"
                                        validate enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="1">

                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Başlık</label>
                                            <input type="text" class="form-control" id="bsValidation4" name="title"
                                                {{ $data->site_title ?? '' }}>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title1 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bsValidation3" class="form-label">Slogan2</label>
                                            <input type="text" class="form-control" id="bsValidation3" name="title1"
                                                placeholder="Slogan" required value="{{ $data->site_title2 ?? '' }}">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dashboard/assets/js/jquery.min.js') }}"></script>

    <!--end row-->
@endsection
