@extends('backpack::layout')

@section('before_styles')
@endsection

@section('header')
    <section class="content-header">
      <h1>
        Balanço
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">Dashboard</a></li>
        <li class="active">Balanço</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Receita</div>
                </div>
                <div class="box-header with-border">
                  <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" />

                  <script type="text/javascript">
                  $(function() {
                      $('input[name="daterange"]').daterangepicker();
                  });
                  </script>
                </div>
                <div class="box-body">
                  <table id="income_table" class="table table-bordered table-striped display">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Valor Unidade</th>
                        <th>Valor Total</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach ($income as $i)
                        <tr>
                          <th>{{ $i['name'] }}</th>
                          <th>{{ $i['qtd'] }}</th>
                          <th>R$ {{ $i['unit_value'] }}</th>
                          <th>R$ {{ $i['value'] }}</th>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Despesas</div>
                </div>
                <div class="box-body">
                  <table id="expenses_table" class="table table-bordered table-striped display">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Valor Unidade</th>
                        <th>Valor Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($expenses as $e)
                        <tr>
                          <th>{{ $e['name'] }}</th>
                          <th>{{ $e['qtd'] }}</th>
                          <th>R$ {{ $e['unit_value'] }}</th>
                          <th>R$ {{ $e['value'] }}</th>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Balanço</div>
                </div>
                <div class="box-body">
                  <table id="expenses_table" class="table table-bordered table-striped display">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Valor</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>Receita</th>
                        <th>R$ {{$total_income}}</th>
                      </tr>
                      <tr>
                        <th>Despesas</th>
                         <th>R$ {{$total_expenses}}</th>
                      </tr>
                      <tr>
                        <th>Total</th>
                        <th>R$ {{$total}}</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')

@endsection
