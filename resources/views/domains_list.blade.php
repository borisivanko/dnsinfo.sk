@extends('layouts.master')
@section('title', 'Domény | DNS info')
@section('content')
    <form class="row g-3">
        <div class="col-md-5">
            <label for="exampleFormControlSelect1">Zoradiť podľa</label>
            <select name="column" class="form-control" id="exampleFormControlSelect1">
                <option value="domain_name">Doména</option>
                <option value="registrant_id">ID držiteľa</option>
                <option value="registrar_id">ID registrátora</option>
                <option value="expiration_date">Dátum expirácie</option>
            </select>
        </div>

        <div class="col-md-5">
            <label for="exampleFormControlSelect1">Test</label>
            <select name="direction" class="form-control" id="exampleFormControlSelect1">
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
                <th data-column="domain_name">Doména
                <th data-column="registrant_id">ID držiteľa</th>
                <th data-column="registrar_id">ID registrátora</th>
                <th data-column="domain_status">Status domény</th>
                <th data-column="expiration_date">Dátum expirácie</th>
            </tr>
            @foreach($domains as $domain)
                <tr>
                    <td>{{$domain->domain_name}}</td>
                    <td>
                        <a href="{{url("/domeny/{$domain->registrant_id}")}}">{{$domain->registrant_id}}</a>
                    </td>
                    <td>
                        <a href="{{url("/registratori/{$domain->registrar_id}")}}">{{$domain->registrar_id}}</a>
                    </td>
                    <td>{{$domain->domain_status}}</td>
                    <td>{{$domain->expiration_date}}</td>
                </tr>
            @endforeach
        </table>
    </div>


    <div class="d-flex justify-content-center">
        {{$domains->appends($_GET)->links()}}
    </div>

    <script>
        // const tableHeader = document.querySelectorAll('th');
        // let column;
        // let direction;

        // tableHeader[0].addEventListener('click', function () {
        //     column = 'domain_name';
        //     direction = 'asc';
        //     window.location.href = `/domains?column=${column}&direction=${direction}`;
        //     console.log('click');
        // });

        // tableHeader.forEach(function (element) {

        // element.addEventListener('click', function () {
        //     let orderParams = new URLSearchParams(window.location.search);

        // console.log(orderParams);
        // column = element.dataset.column;
        // element.dataset.direction === 'asc' ? direction = 'desc' : direction = 'asc';

        // orderParams.set('column', column);

        // window.location.search = orderParams.toString();

        // if (column === element.textContent) {
        //     if (direction === 'asc') {
        //         direction = 'desc';
        //     } else {
        //         direction = 'asc';
        //     }
        // } else {
        //     column = element.textContent;
        //     direction = 'asc';
        // }
        // });
        // });

    </script>
@endsection
