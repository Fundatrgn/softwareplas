@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{$service->title ?? ''}}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{$service->title ?? ''}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="/admin/hizmetler/detay/add/{{$service_id}}" class="btn btn-outline-primary">Yeni Ekle</a>
                    </div>
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
                                    <th>Başlık</th>
                                    <th>Anahtar Kelimeler</th>
                                    <th>Görsel</th>
                                    <th>Sıra</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->title ?? '' }}</td>
                                        <td>{{ $item->keywords ?? '' }}</td>
                                        <td><img src="{{ asset('/images/' . $item['image']) }}" alt=""
                                                style="height: 50px"></td>
                                        <td>{{ $item->position ?? '' }}</td>
                                        <td>{{ $item->created_at ?? '' }}</td>
                                        <td>
                                            <a href="/admin/hizmetler/detay/add/{{ $item->service_id ?? '' }}/{{ $item->id ?? '' }}" class="text-warning"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                                data-bs-original-title="Edit info" aria-label="Edit">
                                                <ion-icon name="pencil-outline" role="img" class="md hydrated"
                                                    aria-label="pencil outline"></ion-icon>
                                            </a>
                                            <a href="/admin/hizmetler/detay/del/{{ $item->id ?? '' }}" class="text-danger"
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
                                    <th>Başlık</th>
                                    <th>Altbaşlık</th>
                                    <th>Görsel</th>
                                    <th>Sıra</th>
                                    <th>Oluşturulma Tarihi</th>
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
