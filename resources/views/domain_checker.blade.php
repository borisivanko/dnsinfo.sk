@extends('layouts.master')
@section('title', $domain_input ? $domain_input.' | DNS info' : 'DNS info')
@section('content')
    <div class="row my-4 g-1">
        <div class="col-12 col-md-7 col-lg-8 px-md-5 px-3 py-3 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold"> Hľadať doménu</h1>
                <p class="col-md-8 fs-4">Skontrolujte dostupnosť domény</p>
                <form id="domain-checker">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-lg-5 mb-1">
                            <div class="input-group">
                                <input class="form-control" type="text" name='domain' value={{!str_ends_with($domain_input, '.sk') ? $domain_input : substr($domain_input, 0, -3)}}>
                                <span class="input-group-text">.sk</span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2 col-lg-1">
                            <button class="btn btn-primary w-100"><i class="mdi mdi-magnify"></i></button>
                        </div>
                    </div>
                </form>

                <div>
                    @if($domain_input)
                        @if($available)
                            <h4 class="mt-2">{{$domain_input}} je <span class="text-success">volná</span></h4>
                        @else
                            <h4 class="mt-2">{{$domain_input}} je <span class="text-danger">obsadená</span></h4>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="px-md-5 px-3 py-3 bg-light rounded-3 col-12 col-md-5 col-lg-4">
            <h4>Aktuálny počet zaregistrovaných SK domén</h4>

            k {{date('d.m.Y')}}

            <h5>{{$count}}</h5>
        </div>
    </div>


    @if($domain_detail)
        <div class="row">
            <div class="col-12 px-md-5 px-3 py-3 my-4 bg-light rounded-3">
                <h2>Doména</h2>
                {{$domain_detail->domain_name}}
            </div>

            <div class="col-12 px-md-5 px-3 py-3 my-4 bg-light rounded-3">
                <h2>Archív domény</h2>
                <a href="https://web.archive.org/web/{{$domain_detail->domain_name}}">Link <i class="mdi mdi-arrow-right"></i></a>
            </div>

            <div class="row mb-4 g-1">
                <div class="col-md-6">
                    <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                        <h2>Status</h2>
                        {{$domain_detail->domain_status}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                        <h2>Dátum expirácie </h2>
                        {{$domain_detail->expiration_date}}
                    </div>
                </div>
            </div>

            <div class="row mb-4 g-1">
                <div class="col-12 px-md-5 px-3 py-3 bg-light rounded-3">
                    <h2>Nameserver</h2>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                        {{$domain_detail->NS1 ? $domain_detail->NS1 : '-'}}
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                        {{$domain_detail->NS2 ? $domain_detail->NS2 : '-'}}
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                        {{$domain_detail->NS3 ? $domain_detail->NS3 : '-'}}
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                        {{$domain_detail->NS4 ? $domain_detail->NS4 : '-'}}
                    </div>
                </div>
            </div>

            <div class="row mb-4 g-1">
                <div class="col-md-6">
                    <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                        <h2>ID držiteľa</h2>
                        <a href="{{url("/domeny/{$domain_detail->registrant_id}")}}">
                            {{$domain_detail->registrant_id}}
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="px-md-5 px-3 py-3 bg-light rounded-3">
                        <h2>ID registrátora</h2>
                        <a href="{{url("/registratori/{$domain_detail->registrar_id}")}}">
                            {{$domain_detail->registrar_id}}
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection
