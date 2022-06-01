@extends('layouts.master')
@section('title', 'Registrátori | DNS info')
@section('content')
    <div class="row my-4 g-1">
        <div class="col-12 px-md-5 px-3 py-3 bg-light rounded-3">
            <h2>ID registrátora</h2>
            {{ $registrar->registrar_id }}
        </div>
    </div>

    <button class="btn btn-link" data-toggle="collapse" data-target="#registrarDetail">
        Podrobnosti o registrátorovi <i class="mdi mdi-chevron-down"></i>
    </button>

    <div class="collapse mt-4" id="registrarDetail">
        <div class="row mb-4 g-1">
            <div class="col-12 px-md-5 px-3 py-3 bg-light rounded-3">
                <h2>Firma</h2>
                {{ $registrar->company }}
            </div>
        </div>

        <div class="row mb-4 g-1">
            <div class="col-12 col-md-6">
                <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                    <h2>Ulica</h2>
                    {{ $registrar->street_name }}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                    <h2>Mesto</h2>
                    {{ $registrar->city_name }}
                </div>
            </div>
        </div>


        <div class="row mb-4 g-1">
            <div class="col-12 col-md-6">
                <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                    <h2>Telefón</h2>
                    {{ $registrar->contact_phone }}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                    <h2>E-Mail</h2>
                    {{ $registrar->contact_email }}
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover my-4">
            <th>Doména</th>
            <th>ID držiteľa</th>
            <th>Status domény</th>
            <th>Dátum expirácie</th>
            @foreach($domains as $domain)
                <tr>
                    <td>{{ $domain->domain_name }}</td>
                    <td><a href="{{ url("/domeny/{$domain->registrant_id}") }}">{{ $domain->registrant_id }}</a></td>
                    <td>{{ $domain->domain_status }}</td>
                    <td>{{ $domain->expiration_date }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{$domains->appends($_GET)->links()}}
    </div>

    <script>

    </script>
@endsection
