@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Sayfa Sonu</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sayfa Sonu</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="/admin/footer-menu/add" class="btn btn-outline-primary">Yeni Bağlantı Ekle</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card mb-3">
                <div class="card-body">
                    <h6>Bu Menünün Başlığı</h6>
                    <p class="text-muted small">Sitenin sayfa sonu (footer) bölümünde "Hizmetlerimiz" sekmesinin yanında görünecek yeni sütunun başlığı. Örn: "Kurumsal", "Sayfalar".</p>
                    <form method="POST" action="/admin/footer-menu/baslik" class="row g-2">
                        @csrf
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="footer_menu_title" placeholder="Örn: Kurumsal" value="{{ $menuBasligi }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">Başlığı Kaydet</button>
                        </div>
                    </form>
                    <div class="form-text mt-2">Başlık boş bırakılırsa, hiç bağlantı eklenmemiş olsa bile bu sütun sayfa sonunda görünmez.</div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6>Bağlantılar</h6>
                    <p class="text-muted small">Bu listedeki bağlantılar, yukarıdaki başlık altında sırasıyla sayfa sonunda görünür.</p>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Sıra</th>
                                    <th>Bağlantı Metni</th>
                                    <th>Hedef</th>
                                    <th class="text-end">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                    <tr>
                                        <td>{{ $item->order }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td><code>{{ $item->url }}</code>
                                            @isset($sayfaSecenekleri[$item->url])
                                                <span class="text-muted small">({{ $sayfaSecenekleri[$item->url] }})</span>
                                            @endisset
                                        </td>
                                        <td class="text-end">
                                            <a href="/admin/footer-menu/add/{{ $item->id }}" class="text-warning" title="Düzenle">
                                                <ion-icon name="pencil-outline"></ion-icon>
                                            </a>
                                            <a href="/admin/footer-menu/del/{{ $item->id }}" class="text-danger" title="Sil"
                                                onclick="return confirm('Bu bağlantıyı silmek istediğinize emin misiniz?');">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">Henüz bağlantı eklenmedi.</td>
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
