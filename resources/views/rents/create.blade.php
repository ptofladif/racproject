{!! Form::open( ['id' => 'form_create_rent'] ) !!}
<div class="modal fade" id="create-rent-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Rental ({!!  $model->brand->title !!})</h4>
                <button type="button" class="close" aria-label="Close" onclick="Rent.closeCreate()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    {{ Form::hidden('id', $model->id , array('id' => 'id')) }}
                    @if(!empty($model->plate))
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label input-sm">Plate</label>
                                {!! Form::input('text', 'plate', $model->plate, ['class' => 'form-control input-sm','readonly']) !!}
                            </div>
                        </div>
                    @endif
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label input-sm">Brand</label>
                            {!! Form::input('text', 'brand', $model->brand->title, ['class' => 'form-control  input-sm','readonly']) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label input-sm">Date From</label>
                            <div class="input-group">
                                <div class="input-group-addon">

                                </div>
                                {!! Form::input('text', 'date_from', '', ['id'=>'datefromId','class' => 'form-control input-sm','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label input-sm">Date To</label>
                            <div class="input-group">
                                <div class="input-group-addon">

                                </div>
                                {!! Form::input('text', 'date_to', '', ['id'=>'datetoId','class' => 'form-control input-sm','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="Rent.closeCreate()">Voltar</button>
                    <button type="button" class="btn btn-primary"   onclick="Rent.store()">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
