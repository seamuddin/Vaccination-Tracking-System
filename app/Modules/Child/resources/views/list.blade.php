@extends('layouts.admin')

@section('header-resources')
    @include('partials.datatable_css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 p-5 pt-3">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title pt-2 pb-2"> Child List </h3>
                    <div class="card-tools">
                        <a href="{{ route('child.create') }}" class="btn btn-sm btn-primary">
                            <i class="bx bx-plus pr-2"></i> Add Child
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="list" class="table table-striped table-bordered dt-responsive " cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Parent/Guardian</th>
                                <th>Contact Number</th>
                                <th>Vaccination Status</th>
                                <th>Last Updated</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->

        </div>
    </div>
@endsection

@section('footer-script')

    @include('partials.datatable_js')

    <script>
        $(function () {
            $('#list').DataTable({
                processing: true,
                serverSide: true,
                "ordering": true,
                ajax: {
                    url: '{{ route('child.list') }}',
                    method: 'post',
                    data: function (d) {
                        d._token = $('input[name="_token"]').val();
                    }
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'date_of_birth',
                        name: 'date_of_birth'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'guardian_name',
                        name: 'guardian_name'
                    },
                    {
                        data: 'guardian_contact',
                        name: 'guardian_contact'
                    },
                    {
                        data: 'vaccination_status',
                        name: 'vaccination_status',
                        render: function(data) {
                            if (data === 'complete') {
                                return '<span class="badge bg-success">Complete</span>';
                            } else if (data === 'in_progress') {
                                return '<span class="badge bg-warning">In Progress</span>';
                            } else {
                                return '<span class="badge bg-danger">Not Started</span>';
                            }
                        }
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                "aaSorting": []
            });
        });
    </script>
@endsection
