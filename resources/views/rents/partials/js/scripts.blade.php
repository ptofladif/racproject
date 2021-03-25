
<script>

    let dataTableRentInstance = null;

    let Rent = function () {

        let ajaxParams = {};

        let displaySpinner = function (status) {
            status = status === undefined ? true : status;
            let spinner = $('.loading');
            status ? spinner.removeClass('hidden') : spinner.addClass('hidden')
        };

        let handleSearch = function () {

            dataTableRentInstance = $('#rentstable').DataTable({
                autoWidth: false,
                processing: false,
                serverSide: true,
                select: false,
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

                ],
                fnRowCallback: function(nRow , aData, iDisplayIndex, iDisplayIndexFull ) {

                },
                order: [
                ],
                columns: [
                    {data: 'actions', className: 'edit-rent', orderable: false, searchable: false, width: '1%'},
                    {data: 'client', name: 'user.name', title: 'Client', className:'text-center', width: '8%'},
                    {data: 'plate', name: 'car.plate', title: 'Plate', className:'text-center', width: '8%'},
                    {data: 'date_from', name: 'date_from', title: 'Date From', className:'text-center', width: '8%'},
                    {data: 'date_to', name: 'date_to', title: 'Date To', className:'input-sm text-nowrap', width: '8%'},
                    {data: 'total_cost', name: 'total_cost', title: 'Total Cost', className:'text-right text-nowrap',width: '5%'},
                ],
                language: {
                    thousands: ".",
                },
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

            dataTableRentInstance.ajax.reload();
        };
        let handleCloseCreate = function () {
            $('#create-rent-modal').modal('hide');
        };
        let handleCloseEdit = function () {
            $('#edit-rent-modal').modal('hide');
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
            closeCreate: function () {
                handleCloseCreate();
            },
            closeEdit: function () {
                handleCloseEdit();
            },
        }
    }();

    $(document).ready(function () {

        Rent.initSearch();

        $("#rentstable tbody").on("click", "td.edit-rent", function(){

            let tr = $(this).closest('tr');

            let row = dataTableRentInstance.row(tr).data();
            console.log(row);
            let route  = '{!! route('rents.edit',[':idRent']) !!}';
            route = route.replace(':idRent',row['id']);
            console.log(route);
            {{--let route = '{!! route('rents.edit') !!}';--}}

            {{--route = route + '?id=' + row['id'];--}}

            $('#modal-rent-edit').load(route, function (result) {
                $('#edit-rent-modal').modal('show');
            })
        });

    });

</script>
