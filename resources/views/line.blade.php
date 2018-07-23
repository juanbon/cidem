@extends('backpack::layout')

<style>
    #table-wrapper {
        position:relative;
    }
    #table-scroll {
        height:150px;
        overflow:auto;
        margin-top:20px;
    }
    #table-wrapper table {
        width:50%;
    }

    #table-wrapper table thead th .text {
        position:absolute;
        top:-20px;
        z-index:2;
        height:20px;
        width:35%;
    }
</style>

@section('header')
    <section class="content-header">
        <h1>
            {{ $line->name }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">Fuente</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Convocatoria abierta hasta el: {{ Carbon\Carbon::parse($line->dead_line)->format('d/m/Y') }}</div>
                </div>

                <div class="box-body">
                    <form>
                        Objetivos: {{ $line->description }}<br><br>
                        Modalidad: {{ $line->modality->name }}<br><br>
                        Beneficiarios: <br>
                        <ul>
                            @foreach ($line->recipients as $r)
                                <li>{{ $r->name }}</li>
                            @endforeach
                        </ul>
                        Áreas: <br>
                        <ul>
                            @foreach ($line->areas as $a)
                                <li>{{ $a->name }}</li>
                            @endforeach
                        </ul><br>
                        Tipo de financiamiento: {{ $line->financingType->name }}<br><br>
                        Monto: {{ $line->info }}<br><br>
                        Duración: <br><br>
                        Página web: <a href="{{ $line->web }}">{{ $line->web }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="//www.google.com/jsapi"></script>
@endsection