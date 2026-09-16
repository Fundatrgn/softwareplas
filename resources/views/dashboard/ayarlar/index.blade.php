@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Site Ayarları</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Site Ayarları</li>
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

                        <table id="example" class="table table-striped table-bordered"
                            style="width:100%; min-height:100%">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Site Başlığı</th>
                                    <th>Renkler</th>
                                    <th>Sosyal Medya</th>
                                    <th>Telefon</th>
                                    <th>Adres</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td><img src="{{ asset('/images/' . $item['image']) }}" alt=""
                                                style="height: 50px"></td>
                                        <td>{{ $item->site_title ?? '' }}</td>
                                        <td>
                                            <span title="Ana Marka Rengi" style="display:inline-block;width:22px;height:22px;border-radius:50%;background:{{ $item->accent_color ?? '#D9784B' }};border:1px solid #ccc;"></span>
                                            <span title="İkincil Renk" style="display:inline-block;width:22px;height:22px;border-radius:50%;background:{{ $item->secondary_color ?? '#7FA36F' }};border:1px solid #ccc;"></span>
                                            <span title="Başlık Rengi" style="display:inline-block;width:22px;height:22px;border-radius:50%;background:{{ $item->heading_color ?? '#FFFFFF' }};border:1px solid #ccc;"></span>
                                            <span title="Gövde Metin Rengi" style="display:inline-block;width:22px;height:22px;border-radius:50%;background:{{ $item->body_text_color ?? '#E7E3D8' }};border:1px solid #ccc;"></span>
                                        </td>
                                        <td>
                                            <a href="{{ $item->instagram ?? '' }}" target="_blank">
                                                <i class="lni lni-instagram"></i>
                                            </a>
                                            <a href="{{ $item->linkedin ?? '' }}" target="_blank">
                                                <i class="lni lni-linkedin-original"></i>
                                            </a>
                                            <a href="{{ $item->youtube ?? '' }}" target="_blank">
                                                <i class="lni lni-youtube"></i>
                                            </a>
                                            <a href="{{ $item->twitter ?? '' }}" target="_blank">
                                                <i class="lni lni-twitter"></i>
                                            </a>
                                            
                                        </td>
                                        <td>{{ $item->phone ?? '' }}</td>
                                        <td>{{ Str::substr($item->address , 0, 10) ?? '' }}...</td>
                                        <td>
                                            <a href="/admin/ayarlar/add/{{ $item->id ?? '' }}" class="btn btn-sm btn-primary">
                                                <ion-icon name="color-palette-outline"></ion-icon> Düzenle / Renkler
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <th>Logo</th>
                                    <th>Site Başlığı</th>
                                    <th>Renkler</th>
                                    <th>Sosyal Medya</th>
                                    <th>Telefon</th>
                                    <th>Adres</th>
                                    <th>#</th>
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
