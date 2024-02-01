@extends('layouts.app')

@vite(['resources/js/persons/persons.js'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
             <div class="card">
                <div class="card-header">{{ __('Személyek') }}</div>

                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert <?= Session::get('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ Session::get('message') }}
                        </div>

                        @if(Session::has('logs') && is_array(Session::get('logs')))
                            <div class="alert alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            @foreach (Session::get('logs') as $log)
                                @if (isset($log['datas']))
                                    <?php $logDatas = json_decode($log['datas'], true); ?>
                                    <p>{{ $logDatas["id"].' - '.$logDatas["teljesnev"].': ' }} <span class="<?= $log['type'] == 1 ? 'text-success' : 'text-danger' ?>">{{ $log['reason'] }}</span></p>
                                    <br>
                                @else
                                    <p>{{ $log['person']->id.' - '.$log['person']->teljesnev.': ' }} <span class="<?= $log['type'] == 1 ? 'text-success' : 'text-danger' ?>">{{ $log['reason'] }}</span></p>
                                    <br>
                                @endif
                            @endforeach
                            </div>
                        @endif

                    @endif

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#fileModal">
                        Importálás
                    </button>

                    <table class="table table-light table-striped text-center mt-3" id="personTable">
                        <thead>
                            <tr>
                                <th>Azonosító</th>
                                <th>Adóazonosító</th>
                                <th>Teljes név</th>
                                <th>Egyéb ID</th>
                                <th>Belépés időpontja</th>
                                <th>Kilépés időpontja</th>
                                <th>E-mail cím</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($persons as $person)
                                <tr>
                                    <td>{{ $person->id }}</td>
                                    <td>{{ $person->adoazonositojel }}</td>
                                    <td>{{ $person->teljesnev }}</td>
                                    <td>{{ $person->egyebid }}</td>
                                    <td>{{ $person->belepes }}</td>
                                    <td>{{ $person->kilepes }}</td>
                                    <td>{{ $person->email }}</td>
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

@include('persons.partials.file-modal')

