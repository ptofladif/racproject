{!! Form::open() !!}

<div class="card no-border no-shadow">
    <div class="card-header with-border">
        <i class="fa fa-filter"></i>Pesquisa
        <div class="card-tools pull-right">
            <button title="Expandir filtros" class="btn btn-sm" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body form-group">
        <div class="col-md-4">
            <label class="text-sm text-nowrap">Marca</label>
            {!! Form::select('brandId',[null=>''] +$brands,!empty($request['brandId'])?$request['brandId']:'',['id'=>'brandId','class'=>'form-control form-filter']) !!}
        </div>
        <div class="col-md-4">
            <label class="text-sm text-nowrap">Valor mínimo</label>
            {!! Form::input('text', 'minvalue', !empty($request['minvalue'])?$request['minvalue']:'',['id'=>'minvalueId','class'=>'form-control form-filter']) !!}
        </div>
        <div class="col-md-4">
            <label class="text-sm text-nowrap">Valor máximo</label>
            {!! Form::input('text', 'maxvalue', !empty($request['maxvalue'])?$request['maxvalue']:'',['id'=>'maxvalueId','class'=>'form-control form-filter']) !!}
        </div>
    </div>
    <div class="box-footer">
        <div class="btn-group pull-right">
            <button class="btn btn-secondary btn-sm" type="button" style='margin-right: 10px !important;'
                    onclick="Car.resetSearchFilters()">Limpar
            </button>
            <button class="btn btn-primary btn-sm" type="button" onclick="Car.setSearchFilters()">Filtrar
            </button>
        </div>
    </div>
</div>

{!! Form::close() !!}
