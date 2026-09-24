@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ $config['title'] }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $config['title'] }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="/admin/{{ $module }}/add" class="btn btn-outline-primary">Yeni {{ $config['singular'] }} Ekle</a>
                </div>
            </div>
            <a href="/admin/{{ $module }}/add" class="btn btn-outline-primary mb-3 d-sm-none">Yeni {{ $config['singular'] }} Ekle</a>
            @if (! empty($config['help']))
                <div class="alert alert-info">{{ $config['help'] }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    @foreach ($config['columns'] as $label)
                                        <th>{{ $label }}</th>
                                    @endforeach
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        @foreach ($config['columns'] as $column => $label)
                                            @php $type = collect($config['fields'])->firstWhere('name', $column)['type'] ?? 'text'; @endphp
                                            <td>
                                                @if ($type === 'image')
                                                    @if ($item->{$column})
                                                        <img src="{{ asset('images/' . $item->{$column}) }}" alt="" style="height:50px">
                                                    @endif
                                                @elseif ($type === 'checkbox')
                                                    {!! $item->{$column} ? '<span class="badge bg-success">Evet</span>' : '<span class="badge bg-secondary">Hayır</span>' !!}
                                                @else
                                                    {{ \Illuminate\Support\Str::limit(strip_tags((string) $item->{$column}), 80) }}
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="text-nowrap">
                                            <a href="/admin/{{ $module }}/add/{{ $item->id }}" class="text-warning" title="Düzenle">
                                                <ion-icon name="pencil-outline"></ion-icon>
                                            </a>
                                            <a href="/admin/{{ $module }}/del/{{ $item->id }}" class="text-danger ms-2" title="Sil"
                                                onclick="return confirm('Bu kaydı silmek istediğinize emin misiniz?')">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
