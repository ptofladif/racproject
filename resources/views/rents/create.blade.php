{!! Form::open( ['id' => 'form_create_rent'] ) !!}
<div class="modal fade" id="create-rent-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Rental</h4>
                <button type="button" class="close" aria-label="Close" onclick="Rent.closeCreate()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    {{ Form::hidden('car_id', $model->id , array('id' => 'id')) }}

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label input-sm">Plate</label>
                            {!! Form::input('text', 'plate', $model->plate, ['class' => 'form-control input-sm','readonly']) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label input-sm">Brand</label>
                            {!! Form::input('text', 'brand', $model->brand->title, ['class' => 'form-control  input-sm','readonly']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Utilizador</label>
                            {!! Form::input('text', 'driver','', ['id'=>'driver','class'=>'form-control','autocomplete'=>'off','data-validation'=>'required not_numeric']) !!}
                            <div class="hidden">
                                {!! Form::input('text', 'user_id','', ['id'=>'clientId','class'=>'form-control','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Schedule Date From</label>
                            <div class="input-group date" id="datetimeFrom">
                                <span class="input-group-addon">
                                    {!! Form::input('text', 'date_from', old('date_from'), ['id'=>'datefromId','class' => 'form-control input-sm','autocomplete'=>'off']) !!}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Schedule Date To</label>
                            <div class="input-group date" id="datetimeTo">
                                <span class="input-group-addon">
                                    {!! Form::input('text', 'date_to', old('date_to') , ['id'=>'datetoId','class' => 'form-control input-sm','autocomplete'=>'off','data-validation'=>'required','data-validation-error-msg-required'=>'Campo obrigatório']) !!}

                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="Rent.closeCreate()">Back</button>
                    <button type="button" class="btn btn-primary"   onclick="Rent.store()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

<script>

    //Client autocomplete
    $inputUser = $('#driver');

    $inputUser.typeahead({
        minLength: 2,
        delay: 200,
        items: 'all',
        source: function (query, process) {
            return $.post('{{ action('Admin\UsersController@searchClientByAjax') }}', {userName: query}, function (result) {
                return process(result);
            });
        },
        displayText: function (item) {
            return item.name + ' | ' + item.nif;
        }
    });

    $inputUser.change(function () {
        var current = $inputUser.typeahead("getActive");
        nome = $inputUser.val().substring(0, $inputUser.val().indexOf(" | "));
        if (current) {
            // Some item from your model is active!
            if (current.name == nome) {
                document.getElementById('clientId').value = current.id;
            } else {
                document.getElementById('clientId').value = 0;
            }
        }
    });

    $(document).ready(function() {
        $('#datetimeFrom').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            locale: 'pt',
            sideBySide: true
        })

        $('#datetimeTo').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            locale: 'pt',
            sideBySide: true
        })

    });


</script>
