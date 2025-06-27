@extends('layouts.admin')

@section('header-resources')
    @include('partials.datatable_css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 p-5 pt-3">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title pt-2 pb-2">
                        Vaccination Records for {{ $child->name }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="records" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Vaccine Name</th>
                                    <th>Dose Number</th>
                                    <th>Next Due Date</th>
                                    <th>Status</th>
                                    <th>Health Worker</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DataTables will populate -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')
    @include('partials.datatable_js')
    <script>
        $(function () {
            $('#records').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('child.records', $child->id) }}",
                    method: 'post',
                    data: function (d) {
                        d._token = $('input[name="_token"]').val();
                    }
                },
                columns: [
                    { data: 'vaccine_name', name: 'vaccine_name' },
                    { data: 'dose_number', name: 'dose_number' },
                    { data: 'next_due_date', name: 'next_due_date' },
                    { data: 'status', name: 'status' },
                    { data: 'health_worker', name: 'health_worker' }
                ],
                "aaSorting": []
            });
        });
    </script>
@endsection
