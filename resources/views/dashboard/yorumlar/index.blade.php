@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Danışan Yorumları</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danışan Yorumları</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="/admin/yorumlar/add" class="btn btn-outline-primary">Yeni Yorum Ekle</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <p class="text-muted small">Buradan eklediğiniz yorumlar anasayfadaki "Danışan Yorumları" bölümünde gösterilir. Danışan izni olmadan gerçek isim/soyisim kullanmamanızı, gerekirse "A.Y., Danışan" gibi kısaltmalar tercih etmenizi öneririz.</p>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Sıra</th>
                                    <th>Ad / Unvan</th>
                                    <th>Yorum</th>
                                    <th class="text-end">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                    <tr>
                                        <td>{{ $item->order }}</td>
                                        <td>
                                            <strong>{{ $item->name }}</strong>
                                            @if ($item->role)
                                                <br><span class="text-muted small">{{ $item->role }}</span>
                                            @endif
                                        </td>
                                        <td>{{ \Illuminate\Support\Str::limit($item->content, 90) }}</td>
                                        <td class="text-end">
                                            <a href="/admin/yorumlar/add/{{ $item->id }}" class="text-warning" title="Düzenle">
                                                <ion-icon name="pencil-outline"></ion-icon>
                                            </a>
                                            <a href="/admin/yorumlar/del/{{ $item->id }}" class="text-danger" title="Sil"
                                                onclick="return confirm('Bu yorumu silmek istediğinize emin misiniz?');">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">Henüz yorum eklenmedi.</td>
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
