@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ $data ? $config['singular'] . ' Düzenle' : 'Yeni ' . $config['singular'] }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item"><a href="/admin/{{ $module }}">{{ $config['title'] }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
                            <form class="row g-3" action="/admin/{{ $module }}/add" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                @foreach ($config['fields'] as $field)
                                    @php
                                        $name = $field['name'];
                                        $value = old($name, $data ? $data->{$name} : ($field['default'] ?? ''));
                                        $required = ! empty($field['required']);
                                    @endphp
                                    <div class="col-md-{{ $field['col'] ?? 12 }}">
                                        @if ($field['type'] === 'checkbox')
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input" type="checkbox" name="{{ $name }}" id="f-{{ $name }}" value="1" {{ $value ? 'checked' : '' }}>
                                                <label class="form-check-label" for="f-{{ $name }}">{{ $field['label'] }}</label>
                                            </div>
                                        @else
                                            <label for="f-{{ $name }}" class="form-label">{{ $field['label'] }}@if ($required) <span class="text-danger">*</span>@endif</label>
                                            @switch($field['type'])
                                                @case('textarea')
                                                    <textarea class="form-control" id="f-{{ $name }}" name="{{ $name }}" rows="4" @required($required)>{{ $value }}</textarea>
                                                @break
                                                @case('editor')
                                                    <textarea class="form-control js-editor" id="f-{{ $name }}" name="{{ $name }}">{{ $value }}</textarea>
                                                @break
                                                @case('image')
                                                    <input type="file" class="form-control" id="f-{{ $name }}" name="{{ $name }}" accept="image/*">
                                                    @if ($data && $data->{$name})
                                                        <div class="mt-2 d-flex align-items-center gap-3">
                                                            <img src="{{ asset('images/' . $data->{$name}) }}" alt="" style="max-height:90px" class="rounded border">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="{{ $name }}_remove" value="1" id="f-{{ $name }}-rm">
                                                                <label class="form-check-label" for="f-{{ $name }}-rm">Görseli kaldır</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @break
                                                @case('number')
                                                    <input type="number" class="form-control" id="f-{{ $name }}" name="{{ $name }}" value="{{ $value }}">
                                                @break
                                                @case('url')
                                                    <input type="url" class="form-control" id="f-{{ $name }}" name="{{ $name }}" value="{{ $value }}" placeholder="https://">
                                                @break
                                                @default
                                                    <input type="text" class="form-control" id="f-{{ $name }}" name="{{ $name }}" value="{{ $value }}" @required($required)>
                                            @endswitch
                                        @endif
                                    </div>
                                @endforeach
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                    <a href="/admin/{{ $module }}" class="btn btn-light px-4">Vazgeç</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
