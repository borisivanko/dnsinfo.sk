@extends('layouts.master')
@section('title', 'Registrátori | DNS info')
@section('content')
    <div class="px-md-5 px-3 py-3 my-4 bg-light rounded-3">
        <h2>ID držiteľa</h2>
        {{ $registrant }}
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover my-4">
            <th>Doména</th>
            <th>ID registrátora</th>
            <th>Status domény</th>
            <th>Dátum expirácie</th>
            @foreach($domains as $domain)
                <tr>
                    <td>{{ $domain->domain_name }}</td>
                    <td>
                        <a href="{{ url("/registratori/{$domain->registrar_id}") }}">{{ $domain->registrar_id }}</a>
                    </td>
                    <td>{{ $domain->domain_status }}</td>
                    <td>{{ $domain->expiration_date }}</td>
                </tr>
            @endforeach
        </table>
    </div>


    <div class="d-flex justify-content-center">
        {{$domains->appends($_GET)->links()}}
    </div>
@endsection
