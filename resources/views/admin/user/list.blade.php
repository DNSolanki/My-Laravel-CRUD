@extends('admin.layouts.app')
@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title">User List</h3>
                </div>

                <!-- /.box-header --> 
                <div class="box-body table-responsive">
                    <table id="user_table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sr.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Address</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('public/theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('js')

<script type="text/javascript" src="{{ asset('public/theme/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<!-- <script type="text/javascript" src="{{ asset('public/DataTables/buttons.flash.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/DataTables/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/DataTables/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/DataTables/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/DataTables/buttons.html5.min.js') }}"></script> -->

<script type="text/javascript">

$(document).ready(function () {

    if ($('#user_table').length > 0) {
        $('#user_table').DataTable({
            //stateSave: true,

            processing: true,
            serverSide: true,
            lengthMenu: [[10, 250, 500, 1000, -1], [10, 250, 500, 1000, "All"]],
            dom: 'lBfrtip',
            buttons: [
                // 'csv', 'excel', 'pdf',
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                },
            ],
            ajax: {
                url: "{{ route('admin.users.index') }}",
                type: 'GET',
                data: function (d) { }

            },
            "fnDrawCallback": function (oSettings) {
                $('body').off('click', '[id^="changeStatus-"]').on('click', '[id^="changeStatus-"]', function (e) {
                    var self = $(this);
                    var tbl = 'users';
                    var id = $(this).attr('id').split('-')[1];
                    var status = $(this).attr('id').split('-')[2];

                    var msgStatus = status == 'Active' ? 'Inactive' : 'Active';

                    swal({
                        title: "Are you sure?",
                        text: "You want " + msgStatus + " this record !!",
                        type: "warning",
                        confirmButtonText: 'Yes, ' + msgStatus + ' it!',
                        cancelButtonText: "No, cancel please!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then(function (value) {
                        if (value == 1) {
                            $.post(SITEURL + "/admin/change-status", {table: tbl, id: id},
                                    function (data) {
                                        if (data == '1') {
                                            if (status == 'Active') {
                                                self.attr('id', 'changeStatus-' + id + '-Inactive-').removeClass('btn-success').addClass('btn-danger').html('Inactive');
                                            } else {
                                                self.attr('id', 'changeStatus-' + id + '-Active-').removeClass('btn-danger').addClass('btn-info').html('Active');
                                            }
                                        }
                                    });
                            swal(msgStatus + "!", "Your record has been " + msgStatus + "!", "success");
                        } else {
                            // swal("Cancelled", "Your record is safe :)", "error"); 
                        }

                    });

                });

            },
            columns: [
                {data: 'id', name: 'id', 'visible': false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'mobile_number', name: 'mobile_number'},
                {data: 'address', name: 'address'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false},
            ],
            order: [[0, 'desc']]
        });
    }

});

</script>

@endsection
