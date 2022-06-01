@extends('layouts.master')
@section('title', 'Registrátori | DNS info')
@section('content')
    <form class="row g-3">
        <div class="col-md-5">
            <label for="column">Zoradiť podľa</label>
            <select name="column" class="form-control" id="column">
                <option value="registrar_id">ID registrátora</option>
                <option value="company">Firma</option>
                <option value="street_name">Ulica</option>
                <option value="city_name">Mesto</option>
                <option value="contact_phone">Telefón</option>
                <option value="contact_email">E-mail</option>
            </select>
        </div>

        <div class="col-md-5">
            <label for="direction">Test</label>
            <select name="direction" class="form-control" id="direction">
                <option value="asc">Vzostupne</option>
                <option value="desc">Zostupne</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary col-md-2">Zoradiť</button>
    </form>

    <form class="row g-3 mt-2">
        <div class="col-md-10">
            <label for="search">Vyhľadávanie</label>
            <input type="text" name="search" id="search" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary col-md-2"><i class="mdi mdi-magnify"></i></button>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover my-4">
            <tr>
                <th>ID registrátora</th>
                <th>Firma</th>
                <th>Ulica</th>
                <th>Mesto</th>
                <th>Telefón</th>
                <th>E-Mail</th>
            </tr>
            @foreach($registrars as $registrar)
                <tr>
                    <td>
                        <a href="{{url("/registratori/{$registrar->registrar_id}")}}">{{$registrar->registrar_id}}</a>
                    </td>
                    <td>{{$registrar->company}}</td>
                    <td>{{$registrar->street_name}}</td>
                    <td>{{$registrar->city_name}}</td>
                    <td>{{$registrar->contact_phone}}</td>
                    <td>{{$registrar->contact_email}}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{$registrars->appends($_GET)->links()}}
    </div>
@endsection
