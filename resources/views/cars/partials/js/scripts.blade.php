{{--<script id="details-template" type="text/x-handlebars-template">--}}
{{--    @verbatim--}}
{{--    <div class="label label-default">Opcionais</div>--}}
{{--    <table class="table details-table" id="caroptions_{{idv}}">--}}
{{--        <thead>--}}
{{--        <tr class="mcbackground-soft">--}}
{{--            <th>Código</th>--}}
{{--            <th>Descrição</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--    </table>--}}
{{--    @endverbatim--}}
{{--</script>--}}

<script>

    // let template = Handlebars.compile($("#details-template").html());

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

                    displaySpinner(false);
                },
                initComplete: function(settings, json){

                },
                columnDefs: [

                    // {
                    //     targets: 11, "width": "10%", render: $.fn.dataTable.render.number(' ',',', 2 , '',' €') },
                ],
                fnRowCallback: function(nRow , aData, iDisplayIndex, iDisplayIndexFull ) {

                },
                order: [
                ],
                columns: [
                    // {data: null, className: 'details-control', orderable: false, defaultContent: '', searchable: false, width: '1%'},
                    // {data: 'action', className: 'create-rent', orderable: false, searchable: false, width: '1%'},
                    {data: 'brand', name: 'brands.title', title: 'Brand', className:'input-sm text-nowrap', width: '8%'},
                    {data: 'plate', name: 'plate', title: 'Plate', className:'text-center', width: '8%'},
                    {data: 'daily_price', name: 'daily_price', title: 'Daily price', className:'text-right text-nowrap',width: '5%'},

                ],
                language: {
                    thousands: ".",
                    lengthMenu: "Mostrar _MENU_ registos",
                    zeroRecords: "Sem resultados",
                    info: "_PAGE_ de _PAGES_ Pág ( _TOTAL_ Reg )",
                    infoEmpty: "Sem registos",
                    infoFiltered: "(num total de _MAX_)",
                    search: '<i class="fa fa-search"></i>',
                    paginate: {
                        first: "Primeira",
                        last: "Última",
                        next: ">",
                        previous: "<"
                    },
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

            // var tr = $(this).closest('tr');
            // var row = dataTableInstance.row(tr);
            //
            // var tableId = 'caroptions_' + row.data().idv;
            //
            // if (row.child.isShown()) {
            //     // This row is already open - close it
            //     row.child.hide();
            //     tr.removeClass('shown');
            // } else {
            //     // Open this row
            //     row.child(template(row.data())).show();
            //     initTable(tableId, row.data());
            //     tr.addClass('shown');
            //     tr.next().find('td').addClass('no-padding bg-gray');
            // }
        });

        $("#carstable tbody").on("click", "td.create-rent", function(){

            {{--let tr = $(this).closest('tr');--}}

            {{--let row = dataTableInstance.row(tr).data();--}}

            {{--let route = '{!! route('rents.create') !!}';--}}

            {{--route = route + '?idv=' + row['idv'];--}}

            {{--$('#modal-lead-create').load(route, function (result) {--}}
            {{--    $('#create-lead-modal').modal('show');--}}
            {{--})--}}

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
                { data: 'code', name: 'code', title: 'Código', width: '10%'},
                { data: 'designation', name: 'designation', title: 'Descrição', width: '50%'}
            ],
            order: [

            ],
            language: {
                info: "",
                zeroRecords: "Sem resultados",
            },
        })
    }



</script>
