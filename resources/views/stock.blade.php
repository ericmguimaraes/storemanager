@extends('backpack::layout')

@section('before_styles')
@endsection

@section('header')
    <section class="content-header">
      <h1>
        Estoque
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">Dashboard</a></li>
        <li class="active">Estoque</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Produtos</div>
                </div>
                <div class="box-body">
                  <table id="supplies_table" class="table table-bordered table-striped display">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $product)
                        <tr>
                          <th>{{ $product['name'] }}</th>
                          <th>{{ $product['qtd'] }}</th>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Suprimentos</div>
                </div>
                <div class="box-body">
                  <table id="supplies_table" class="table table-bordered table-striped display">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($supplies as $supply)
                        <tr>
                          <th>{{ $supply['name'] }}</th>
                          <th>{{ $supply['qtd'] }}</th>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
@endsection
