@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Danışanlar</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item active">Danışanlar</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="/admin/danisanlar/add" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon> Yeni Danışan</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="GET" class="mb-3">
                        <div class="input-group" style="max-width:400px">
                            <input type="text" name="q" class="form-control" placeholder="İsim veya telefon ara..." value="{{ $q }}">
                            <button class="btn btn-outline-secondary" type="submit"><ion-icon name="search-outline"></ion-icon></button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Ad Soyad</th>
                                    <th>Telefon</th>
                                    <th>E-posta</th>
                                    <th>Randevu Sayısı</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                    <tr>
                                        <td><a href="/admin/danisanlar/{{ $item->id }}">{{ $item->name }}</a></td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email ?? '—' }}</td>
                                        <td>{{ $item->appointments_count }}</td>
                                        <td>
                                            <a href="/admin/danisanlar/{{ $item->id }}" class="text-primary" title="Görüntüle">
                                                <ion-icon name="eye-outline"></ion-icon>
                                            </a>
                                            <a href="/admin/danisanlar/add/{{ $item->id }}" class="text-warning" title="Düzenle">
                                                <ion-icon name="pencil-outline"></ion-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted">Kayıt bulunamadı.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
