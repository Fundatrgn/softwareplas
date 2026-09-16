@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Slider</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Slider</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="/admin/slider/add" class="btn btn-outline-primary">Yeni Ekle</a>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-2">Slayt Geçiş Süresi</h6>
                    <p class="text-muted mb-3">Anasayfadaki slaytlar arası otomatik geçiş kaç saniyede bir olsun? (Birden fazla slider eklediğinizde geçerlidir.)</p>
                    @if (session('hiz_success'))
                        <div class="alert alert-success">{{ session('hiz_success') }}</div>
                    @endif
                    <form action="/admin/slider/hiz" method="POST" class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="number" min="2" max="30" step="1" name="saniye" class="form-control" style="max-width:120px"
                            value="{{ $settings->slider_speed ? round($settings->slider_speed / 1000) : 6 }}">
                        <span>saniye</span>
                        <button type="submit" class="btn btn-primary ms-2">Kaydet</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table id="example" class="table table-striped table-bordered"
                            style="width:100%; min-height:100%">
                            <thead>
                                <tr>
                                    <th>Görsel</th>

                                    <th>Başlık</th>
                                    <th>Sıra</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td><img src="{{ asset('/images/' . $item['image']) }}" alt=""
                                                style="height: 50px"></td>
                                        <td>{{ $item->title ?? '' }}</td>
                                        <td>{{ $item->sira ?? '' }}</td>
                                        <td>{{ $item->created_at ?? '' }}</td>
                                        <td>
                                            <a href="/admin/slider/add/{{ $item->id ?? '' }}" class="text-warning"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                                data-bs-original-title="Edit info" aria-label="Edit">
                                                <ion-icon name="pencil-outline" role="img" class="md hydrated"
                                                    aria-label="pencil outline"></ion-icon>
                                            </a>
                                            <a href="/admin/slider/del/{{ $item->id ?? '' }}" class="text-danger"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                                data-bs-original-title="Delete" aria-label="Delete">
                                                <ion-icon name="trash-outline" role="img" class="md hydrated"
                                                    aria-label="trash outline"></ion-icon>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Görsel</th>

                                    <th>Başlık</th>
                                    <th>Sıra</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>#</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dashboard/assets/js/jquery.min.js') }}"></script>

    <!--end row-->
@endsection
