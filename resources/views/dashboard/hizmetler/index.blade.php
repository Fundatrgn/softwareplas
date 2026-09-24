@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Hizmetler</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Hizmetler</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="/admin/hizmetler/add" class="btn btn-outline-primary">Yeni Ekle</a>
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

                        <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-4">
                            @foreach ($data as $item)
                                <div class="col">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start gap-2">
                                                <div>
                                                    <p class="mb-0 fs-6">{{$item->title ?? ''}}</p>
                                                </div>
                                                <div class="ms-auto widget-icon-small text-white bg-gradient-purple">
                                                    {{-- <ion-icon name="wallet-outline" role="img" class="md hydrated"
                                                        aria-label="wallet outline"></ion-icon> --}}
                                                        @if ($item->image)<img src="{{asset('images/'.$item->image)}}" style="width:35px; height:35px; border-radius:50%" alt="">@endif
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mt-3">
                                                <a href="/admin/hizmetler/add/{{$item->id}}">Düzenle</a>
                                                <a class="ms-auto text-danger" href="/admin/hizmetler/del/{{$item->id}}"
                                                    onclick="return confirm('Bu hizmeti silmek istediğinize emin misiniz?');">
                                                    <ion-icon name="trash-outline"></ion-icon> Sil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dashboard/assets/js/jquery.min.js') }}"></script>

    <!--end row-->
@endsection
