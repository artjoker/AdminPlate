<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/js/theme/default.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
<!-- ================== END BASE JS ================== -->

@yield('scripts')

<script>
    var handleDataTableDefault = function () {
        "use strict";

        if ($('#data-table-default').length !== 0) {
            $('#data-table-default').DataTable({
                language      : {
                    "processing"    : "{!! __('backend.datatable.processing') !!}",
                    "search"        : "{!! __('backend.datatable.search') !!}",
                    "lengthMenu"    : "{!! __('backend.datatable.lengthMenu') !!}",
                    "info"          : "{!! __('backend.datatable.info') !!}",
                    "infoEmpty"     : "{!! __('backend.datatable.infoEmpty') !!}",
                    "infoFiltered"  : "{!! __('backend.datatable.infoFiltered') !!}",
                    "infoPostFix"   : "{!! __('backend.datatable.infoPostFix') !!}",
                    "loadingRecords": "{!! __('backend.datatable.loadingRecords') !!}",
                    "zeroRecords"   : "{!! __('backend.datatable.zeroRecords') !!}",
                    "emptyTable"    : "{!! __('backend.datatable.emptyTable') !!}",
                    "paginate"      : {
                        "first"   : "{!! __('backend.datatable.paginate.first') !!}",
                        "previous": "{!! __('backend.datatable.paginate.previous') !!}",
                        "next"    : "{!! __('backend.datatable.paginate.next') !!}",
                        "last"    : "{!! __('backend.datatable.paginate.last') !!}"
                    },
                    "aria"          : {
                        "sortAscending" : "{!! __('backend.datatable.aria.sortAscending') !!}",
                        "sortDescending": "{!! __('backend.datatable.aria.sortDescending') !!}"
                    },
                    "select"        : {
                        "rows": {
                            "_": "{!! __('backend.datatable.select.rows._') !!}",
                            "0": "{!! __('backend.datatable.select.rows.0') !!}",
                            "1": "{!! __('backend.datatable.select.rows.1') !!}"
                        }
                    }
                }
            });
        }
    };

    var TableManageDefault = function () {
        "use strict";
        return {
            //main function
            init: function () {
                handleDataTableDefault();
            }
        };
    }();

    $(document).ready(function () {
        TableManageDefault.init();
    });
</script>
