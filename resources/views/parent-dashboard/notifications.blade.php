@extends('parent-dashboard.main')
@section('header-resources')
    <link rel="stylesheet" href="{{ asset('assets/css/parent_dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/child_page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/child-registration.css') }}">
    @include('partials.datatable_css')
@endsection

@section('body')
<div class="row">
    <div class="col-md-12 p-5 pt-3">
        <div class="card card-outline card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title pt-2 pb-2">
                    Notification
                </h3>
               
            </div>
            <div class="card-body">
                <div class="table-responsive " style='padding-bottom: 10px;'>
                    <table id="records" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Notification</th>
                                <th>Message</th>
                                <th>Child</th>
                                <th>Vaccine</th>
                                <th>Date</th>
                                <th>Status</th>
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
    let vaccinationData = [];

    $(function () {
        $('#records').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('notifications') }}",
                type: 'POST',
                data: function (d) {
                    d._token = '{{ csrf_token() }}';
                },
                dataSrc: function (json) {
                    vaccinationData = json.data;
                    return json.data;
                }
            },
            columns: [
                { data: 'title', name: 'title' },
                { data: 'message', name: 'message' },
                { data: 'child_name', name: 'child_name' },
                { data: 'vaccine_name', name: 'vaccine_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status', orderable: false, searchable: false }
            ],
            aaSorting: []
        });
    });

   
 
    
</script>
@endsection