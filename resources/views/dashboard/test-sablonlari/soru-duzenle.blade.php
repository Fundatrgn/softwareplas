@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Soruyu Düzenle</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/test-sablonlari">Test Şablonları</a></li>
                            <li class="breadcrumb-item"><a href="/admin/test-sablonlari/{{ $question->test_id }}/sorular">{{ $question->test->name }}</a></li>
                            <li class="breadcrumb-item active">Soruyu Düzenle</li>
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
                <div class="col-lg-7 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            @include('dashboard.test-sablonlari._soru-form', [
                                'action' => '/admin/test-sablonlari/soru/' . $question->id,
                                'question' => $question,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
