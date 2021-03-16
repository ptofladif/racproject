<script id="details-template" type="text/x-handlebars-template">
    @verbatim
    <div class="label label-default">Car Rents</div>
    <table class="table details-table" id="car_{{id}}">
        <thead>
        <tr class="">
            <th>Client</th>
            <th>Date From</th>
            <th>Date To</th>
            <th>Total</th>
        </tr>
        </thead>
    </table>
    @endverbatim
</script>

<script>
    // const Handlebars = require("handlebars");

{{--    @include("handlebars")--}}

    let template = Handlebars.compile($("#details-template").html());

    let dataTableInstance = null;

    let Car = function () {

        let ajaxParams = {};

        let displaySpinner = function (status) {
            status = status === undefined ? true : status;
            let spinner = $('.loading');
            status ? spinner.removeClass('hidden') : spinner.addClass('hidden')
        };

        let handleSearch = function () {

            dataTableInstance = $('#carstable').DataTable({
                autoWidth: false,
                processing: false,
                serverSide: true,
                ajax: {
                    url: '{!! route('cars.search') !!}',
                    data: function (data) {
                        $.each(ajaxParams, function (key, value) {
                            data[key] = value;
                        });
                        displaySpinner();
                    },
                },
                drawCallback: function (oSettings) { // run some code on table redraw
                    let api = this.api();
                    api.columns([5]).visible(false);
                    displaySpinner(false);
                },
                initComplete: function(settings, json){

                },
                columnDefs: [
                    {
                        targets:[1],
                        createdCell: function (td, cellData, rowData, row, col) {
                            switch(rowData["rented"] )
                            {
                                case 0:
                                    $(td).addClass('startrentcontrol');
                                    $(td).html('<a href="#"><i class="fas fa-car" title="Marcar Aluguer" style="color:green;"></i></a>');
                                    break;
                                case 1:
                                    $(td).html('<i class="fas fa-car" title="Alugado" style="color:red;"></i>');
                                    break;
                            }
                        }
                    },
                    {
                        targets:[2],
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).html('<span style="align-content: center"><img src="'+cellData+'" height="30"></span>');
                        }
                    },
                    { targets: 4, "width": "10%", render: $.fn.dataTable.render.number(' ',',', 2 , '',' €') },
                ],
                fnRowCallback: function(nRow , aData, iDisplayIndex, iDisplayIndexFull ) {

                },
                order: [
                ],
                columns: [
                    {data: null, className: 'details-control', orderable: false, defaultContent: '', searchable: false, width: '1%'},
                    {data: 'action', className: 'create-rent', orderable: false, searchable: false, width: '1%'},
                    {data: 'brand', name: 'brands.title', title: 'Brand', className:'input-sm text-nowrap', width: '5%'},
                    {data: 'plate', name: 'plate', title: 'Plate', className:'text-center', width: '8%'},
                    {data: 'daily_price', name: 'daily_price', title: 'Daily price', className:'text-right text-nowrap',width: '5%'},
                    {data: 'rented', name: 'rented', title: 'Estado', className:'text-right text-nowrap',width: '5%'},

                ],
                language: {
                    thousands: ".",
                },
                buttons: [
                ],
                scrollX: "100%",
                scrollXInner: "100%",
                scrollCollapse: false,
                // fixedColumns:   {
                //     leftColumns: 2,
                // },
            });
        };

        let handleSetSearchFilters = function () {
            $('select.form-filter, input.form-filter').each(function () {
                setAjaxParam($(this).attr("name"), $(this).val());
            });

            dataTableInstance.ajax.reload();
        };

        let handleResetSearchFilters = function () {
            $('select.form-filter, input.form-filter').each(function () {
                $(this).val("");
            });

            ajaxParams = {};
            handleSetSearchFilters();
        };

        let setAjaxParam = function (name, value) {
            ajaxParams[name] = value;
        };

        return {
            initSearch: function () {
                handleSearch();
            },
            setSearchFilters: function () {
                handleSetSearchFilters();
            },
            resetSearchFilters: function () {
                handleResetSearchFilters();
            },
        }
    }();

    $(document).ready(function () {

        Car.initSearch();

        // Add event listener for opening and closing details
        $('#carstable tbody').on('click', 'td.details-control', function () {

            var tr = $(this).closest('tr');
            var row = dataTableInstance.row(tr);

            var tableId = 'car_' + row.data().id;

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(template(row.data())).show();
                initTable(tableId, row.data());
                tr.addClass('shown');
                tr.next().find('td').addClass('no-padding bg-gray');
            }
        });

        $("#carstable tbody").on("click", "td.create-rent", function(){

            let tr = $(this).closest('tr');

            let row = dataTableInstance.row(tr).data();

            if(row.rented===0){
                let route = '{!! route('rents.create') !!}';

                route = route + '?id=' + row['id'];
                $('#modal-rent-create').load(route, function (result) {
                    $('#create-rent-modal').modal('show');
                })
            }
        });


    });

    function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            sDom: 't',
            bFilter: false,
            paging: false,
            processing: true,
            serverSide: true,
            ajax: data.details_url,
            initComplete: function(settings, json){

            },
            columnDefs: [

            ],
            columns: [
                { data: 'client', name: 'users.id', title: 'Client', width: '10%'},
                { data: 'date_from', name: 'date_from', title: 'Date from', width: '10%'},
                { data: 'date_to', name: 'date_to', title: 'Date to', width: '10%'},
                { data: 'total_cost', name: 'total_cost', title: 'Total cost', width: '50%'}
            ],
            order: [

            ],
            language: {
                info: "",
                zeroRecords: "No Results",
            },
        })
    }



</script>
