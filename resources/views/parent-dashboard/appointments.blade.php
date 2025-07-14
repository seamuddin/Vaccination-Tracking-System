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
                    Appointments
                </h3>

                <a href="{{ route('appointments.create.form') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Appointment
                </a>
               
            </div>
            <div class="card-body">
                <div class="table-responsive " style='padding-bottom: 10px;'>
                    <table id="records" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Child</th>
                                <th>Vaccine</th>
                                <th>Vaccine Dose</th>
                                <th>Vaccine Center</th>
                                <th>Appointment Date</th>
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
                url: "{{ route('appointments') }}",
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
                { data: 'child_name', name: 'child_name' },
                { data: 'vaccine_name', name: 'vaccine_name' },
                { data: 'vaccine_dose', name: 'vaccine_dose' },
                { data: 'vaccine_center', name: 'vaccine_center' },
                { data: 'appointment_date', name: 'appointment_date' },
                { data: 'status', name: 'status', orderable: false, searchable: false }
            ],
            aaSorting: []
        });
    });

   
 
    
</script>
@endsection