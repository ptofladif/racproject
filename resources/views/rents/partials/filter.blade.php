{!! Form::open() !!}

{{--@can('rent_create')--}}
{{--    <div class="card">--}}
{{--        <div class="card-body">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <button class="btn btn-success btn-sm" type="button" onclick="Rent.create()"> {{ trans('global.add') }} {{ trans('global.rent.title_singular') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}

<div class="card">
    <div class="card-header with-border">
        <i class="fa fa-filter"></i>Search
        <div class="box-tools pull-right">
            <button title="Expandir filtros" class="btn btn-sm" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body form-group">
        <div class="col-md-12 row">

            <div class="col-md-6 col-lg-3">
                <label class="text-sm text-nowrap">Plate</label>
                {!! Form::input('text', 'plate', !empty($request['plate'])?$request['plate']:'',['id'=>'plate','class'=>'form-control form-filter']) !!}
            </div>
            <div class="col-md-6 col-lg-3">
                <label class="text-sm text-nowrap">Client</label>
                {!! Form::input('text', 'client', !empty($request['client'])?$request['client']:'',['id'=>'clientId','class'=>'form-control form-filter']) !!}
            </div>
{{--            <div class="col-md-6 col-lg-3">--}}
{{--                <label class="text-sm text-nowrap">Min Daily Price</label>--}}
{{--                {!! Form::input('text', 'minvalue', !empty($request['minvalue'])?$request['minvalue']:'',['id'=>'minvalueId','class'=>'form-control form-filter']) !!}--}}
{{--            </div>--}}
{{--            <div class="col-md-6 col-lg-3">--}}
{{--                <label class="text-sm text-nowrap">Max Daily Price</label>--}}
{{--                {!! Form::input('text', 'maxvalue', !empty($request['maxvalue'])?$request['maxvalue']:'',['id'=>'maxvalueId','class'=>'form-control form-filter']) !!}--}}
{{--            </div>--}}
        </div>
    </div>
    <div class="card-footer">
        <div class="btn-group pull-right">
            <button class="btn btn-secondary btn-sm" type="button" style='margin-right: 10px !important;'
                    onclick="Rent.resetSearchFilters()">Reset
            </button>
            <button class="btn btn-primary btn-sm" type="button" onclick="Rent.setSearchFilters()">Search
            </button>
        </div>
    </div>
</div>

{!! Form::close() !!}
