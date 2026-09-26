@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Kurumsal Sayfalar</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kurumsal Sayfalar</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="/admin/sayfalar/add" class="btn btn-outline-primary">Yeni Sayfa Ekle</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <p class="text-muted small">Buradan eklediğiniz her sayfa, sitenin "Kurumsal" menüsünde (masaüstü ve mobil) otomatik olarak görünür ve <code>/kurumsal/sayfa-adi</code> adresinden erişilebilir.</p>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Sıra</th>
                                    <th>Başlık</th>
                                    <th>Adres</th>
                                    <th class="text-end">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                    <tr>
                                        <td>{{ $item->order }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td><code>/kurumsal/{{ $item->slug }}</code></td>
                                        <td class="text-end">
                                            <a href="/kurumsal/{{ $item->slug }}" target="_blank" class="text-secondary" title="Görüntüle">
                                                <ion-icon name="eye-outline"></ion-icon>
                                            </a>
                                            <a href="/admin/sayfalar/add/{{ $item->id }}" class="text-warning" title="Düzenle">
                                                <ion-icon name="pencil-outline"></ion-icon>
                                            </a>
                                            <a href="/admin/sayfalar/del/{{ $item->id }}" class="text-danger" title="Sil"
                                                onclick="return confirm('Bu sayfayı silmek istediğinize emin misiniz?');">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">Henüz sayfa eklenmedi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
