
<script>

    let dataTableInstance = null;

    let Rent = function () {

        let ajaxParams = {};

        let displaySpinner = function (status) {
            status = status === undefined ? true : status;
            let spinner = $('.loading');
            status ? spinner.removeClass('hidden') : spinner.addClass('hidden')
        };

        let handleSearch = function () {

            dataTableInstance = $('#rentstable').DataTable({
                autoWidth: false,
                processing: false,
                serverSide: true,
                ajax: {
                    url: '{!! route('rents.search') !!}',
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
                    {data: 'action', className: 'edit-lead', orderable: false, searchable: false, width: '1%'},
                    {data: 'users.name', name: 'user', title: 'Client', className:'text-center', width: '8%'},
                    {data: 'cars.plate', name: 'car', title: 'Car', className:'text-center', width: '8%'},
                    {data: 'date_from', name: 'date_from', title: 'Date From', className:'text-center', width: '8%'},
                    {data: 'date_to', name: 'date_to', title: 'Date To', className:'input-sm text-nowrap', width: '8%'},
                    {data: 'total_cost', name: 'total_cost', title: 'Total Cost', className:'text-right text-nowrap',width: '5%'},

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

        Rent.initSearch();
        

        $("#carstable tbody").on("click", "td.edit-rent", function(){

            {{--let tr = $(this).closest('tr');--}}

            {{--let row = dataTableInstance.row(tr).data();--}}

            {{--let route = '{!! route('rents.edit') !!}';--}}

            {{--route = route + '?id=' + row['id'];--}}

            {{--$('#modal-lead-create').load(route, function (result) {--}}
            {{--    $('#create-lead-modal').modal('show');--}}
            {{--})--}}
        });

    });

</script>
