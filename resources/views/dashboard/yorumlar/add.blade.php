@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Danışan Yorumu</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/yorumlar">Danışan Yorumları</a></li>
                            <li class="breadcrumb-item active">{{ isset($data) ? 'Düzenle' : 'Yeni Yorum' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <form method="POST" action="/admin/yorumlar/add" class="row g-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                <div class="col-md-8">
                                    <label class="form-label">Ad / Rumuz *</label>
                                    <input type="text" class="form-control" name="name" required
                                        placeholder="Örn: A.Y., Danışan" value="{{ old('name', $data->name ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Gösterim Sırası</label>
                                    <input type="number" class="form-control" name="order" min="0" value="{{ old('order', $data->order ?? 0) }}">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Unvan / Açıklama</label>
                                    <input type="text" class="form-control" name="role"
                                        placeholder="Örn: Aile Danışmanlığı Danışanı" value="{{ old('role', $data->role ?? '') }}">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Yorum *</label>
                                    <textarea class="form-control" name="content" rows="5" required
                                        placeholder="Danışanın yorumu">{{ old('content', $data->content ?? '') }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                    <a href="/admin/yorumlar" class="btn btn-outline-secondary px-4">Vazgeç</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
