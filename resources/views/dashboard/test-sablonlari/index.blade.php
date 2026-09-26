@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Test Şablonları</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Test Şablonları</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="/admin/test-sablonlari/add" class="btn btn-outline-primary">Yeni Test Oluştur</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <p class="text-muted small">Burada kendi testlerinizi (öz-değerlendirme anketi, form vb.) oluşturabilir, sorularını ekleyip düzenleyebilirsiniz. Hazır gelen PHQ-9/GAD-7 ölçekleri de burada listelenir; sorularını inceleyip gerekirse düzenleyebilirsiniz.</p>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Test Adı</th>
                                    <th>Açıklama</th>
                                    <th>Soru Sayısı</th>
                                    <th class="text-end">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-muted small">{{ \Illuminate\Support\Str::limit($item->description, 60) }}</td>
                                        <td>{{ $item->questions_count }}</td>
                                        <td class="text-end">
                                            <a href="/admin/test-sablonlari/{{ $item->id }}/sorular" class="text-primary" title="Soruları Yönet">
                                                <ion-icon name="list-outline"></ion-icon>
                                            </a>
                                            <a href="/admin/test-sablonlari/add/{{ $item->id }}" class="text-warning" title="Düzenle">
                                                <ion-icon name="pencil-outline"></ion-icon>
                                            </a>
                                            <a href="/admin/test-sablonlari/del/{{ $item->id }}" class="text-danger" title="Sil"
                                                onclick="return confirm('Bu testi ve TÜM sorularını silmek istediğinize emin misiniz? Bu testle ilişkili danışan atamaları da silinir.');">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">Henüz test tanımlanmadı.</td>
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
