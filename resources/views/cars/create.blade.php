{!! Form::open( ['id' => 'form_create_car'] ) !!}
<div class="modal fade" id="create-car-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Car</h4>
                <button type="button" class="close" aria-label="Close" onclick="Car.closeCreate()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label input-sm">Plate</label>
                            {!! Form::input('text', 'plate', '', ['class' => 'form-control input-sm']) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-sm text-nowrap">Brand</label>
                            {!! Form::select('brand_id',[null=>''] +$brands,'',['id'=>'brandId','class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label input-sm">Daily Price</label>
                            {!! Form::input('text', 'daily_price', '', ['class' => 'form-control input-sm']) !!}
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="Car.closeCreate()">Back</button>
                    <button type="button" class="btn btn-primary"   onclick="Car.store()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

