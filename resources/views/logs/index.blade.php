@extends('layouts.app')

@vite(['resources/js/logs/logs.js'])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Logok') }}</div>

                <div class="card-body">
                    @if(Session::has('success') || Session::has('error'))
                        <div class="alert <?= Session::get('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ Session::get('message') }}
                        </div>
                    @endif

                    <table class="table table-light table-striped text-center mt-3" id="logsTable">
                        <thead>
                            <tr>
                                <th>Típus</th>
                                <th>Adatok</th>
                                <th>Leírás</th>
                                <th>Személy</th>
                                <th>Létrehozva ekkor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $log->type == 1 ? 'Sikeres' : 'Sikertelen' }}</td>
                                    <td>{{ $log->datas }}</td>
                                    <td>{{ $log->reason }}</td>
                                    <td>{{ !empty($log->person) ? $log->person->teljesnev : '' }}</td>
                                    <td>{{ $log->created_at }}</td>
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