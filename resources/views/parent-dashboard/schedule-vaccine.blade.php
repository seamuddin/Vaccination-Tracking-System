@extends('parent-dashboard.main')
@section('header-resources')
    <link rel="stylesheet" href="{{ asset('assets/css/parent_dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/child_page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/child-registration.css') }}">
    <style>
        .select2 {
            width: 100% !important;
        }
        .print-btn {
            background: var(--bd-green);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .print-btn:hover {
            background: #005A42;
            color: white;
        }

        /* Print Section Styles */
        .print-section {
            display: none;
        }

        @media print {
            /* Hide everything except print section when printing */
            body * {
                visibility: hidden;
            }
            
            .print-section, .print-section * {
                visibility: visible;
            }
            
            .print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                display: block !important;
            }

            @page {
                size: A4;
                margin: 15mm;
            }
        }

        /* Vaccination Card Styles for Print */
        .vaccination-card {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border: 2px solid #0F4C75;
            border-radius: 10px;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-header-print {
            background: linear-gradient(135deg, #0F4C75, #006A4E);
            color: white;
            text-align: center;
            padding: 2rem;
        }

        .card-header-print h1 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .card-header-print .subtitle {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
        }

        .child-info-print {
            background: #F0F4F8;
            padding: 1.5rem;
            border-bottom: 2px solid #0F4C75;
        }

        .child-info-print .row {
            margin-bottom: 0.5rem;
        }

        .child-info-print .label {
            font-weight: 600;
            color: #0F4C75;
        }

        .child-info-print .value {
            color: #333;
        }

        .vaccination-table-print {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .vaccination-table-print th {
            background: #F0F4F8;
            color: #0F4C75;
            font-weight: 600;
            padding: 12px 8px;
            border: 1px solid #ddd;
            font-size: 0.9rem;
            text-align: center;
        }

        .vaccination-table-print td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            font-size: 0.85rem;
            text-align: center;
        }

        .vaccination-table-print tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-badge-print {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-given-print {
            background: #E8F5E8;
            color: #006A4E;
            border: 1px solid #006A4E;
        }

        .status-scheduled-print {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-missed-print {
            background: #FFF0F0;
            color: #ff0000;
            border: 1px solid #ff0000;
        }

        .card-footer-print {
            background: #F0F4F8;
            padding: 1.5rem;
            text-align: center;
            border-top: 2px solid #0F4C75;
        }

        .footer-info-print {
            font-size: 0.85rem;
            color: #0F4C75;
            margin-bottom: 0.5rem;
        }

        .print-date {
            font-size: 0.8rem;
            color: #666;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid #ddd;
        }

        .signature-box {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-bottom: 1px solid #333;
            height: 40px;
            margin-bottom: 0.5rem;
        }

        .signature-label {
            font-size: 0.8rem;
            color: #666;
        }

        .summary-stats {
            background: #f8f9fa;
            border-top: 1px solid #ddd;
            padding: 10px;
        }

        @media print {
            /* Page Setup */
            @page {
                size: A4;
                margin: 20mm 15mm 25mm 15mm; /* top, right, bottom, left - extra bottom margin for footer */
            }

            /* Hide everything except print section when printing */
            body * {
                visibility: hidden;
            }
            
            .print-section, .print-section * {
                visibility: visible;
            }
            
            .print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                display: block !important;
            }

            /* Print-specific body styles */
            body {
                background: white !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            /* Vaccination Card Print Layout */
            .vaccination-card {
                max-width: none;
                width: 100%;
                margin: 0;
                padding-bottom: 60px; /* Space for footer */
                page-break-inside: avoid;
                position: relative;
                min-height: calc(100vh - 60px);
            }

            /* Header - always at top */
            .card-header-print {
                page-break-after: avoid;
                page-break-inside: avoid;
            }

            /* Child Info - keep with header */
            .child-info-print {
                page-break-after: avoid;
                page-break-inside: avoid;
            }

            /* Table container */
            .vaccination-table-container {
                page-break-inside: auto;
                margin-bottom: 60px; /* Space for footer */
            }

            /* Table specific rules */
            .vaccination-table-print {
                page-break-inside: auto;
                border-collapse: collapse;
            }

            .vaccination-table-print thead {
                display: table-header-group; /* Repeat header on each page */
            }

            .vaccination-table-print tbody {
                display: table-row-group;
            }

            .vaccination-table-print tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            .vaccination-table-print thead tr {
                page-break-after: avoid;
            }

            /* Summary stats - keep together */
            .summary-stats {
                page-break-inside: avoid;
                page-break-before: avoid;
                margin-top: 15px;
                padding: 10px;
            }

            /* Footer - Fixed at bottom of every page */
            .card-footer-print {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                background: #F0F4F8 !important;
                border-top: 2px solid #0F4C75 !important;
                padding: 10px 15px !important;
                margin: 0;
                box-sizing: border-box;
                z-index: 1000;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            /* Footer content adjustments for print */
            .footer-info-print {
                font-size: 0.8rem !important;
                color: #0F4C75 !important;
                margin-bottom: 0.5rem;
                text-align: center;
            }

            .print-date {
                font-size: 0.75rem !important;
                color: #666 !important;
                text-align: center;
                margin-bottom: 0.5rem;
            }

            .signature-section {
                display: flex;
                justify-content: space-between;
                padding-top: 0.5rem;
                border-top: 1px solid #ddd;
            }

            .signature-box {
                text-align: center;
                width: 200px;
            }

            .signature-line {
                border-bottom: 1px solid #333;
                height: 25px;
                margin-bottom: 0.25rem;
            }

            .signature-label {
                font-size: 0.7rem;
                color: #666;
            }

            /* Prevent orphaned content */
            .vaccination-table-print tbody tr:last-child {
                page-break-inside: avoid;
            }

            /* Page break rules */
            .page-break-before {
                page-break-before: always;
            }

            .page-break-after {
                page-break-after: always;
            }

            .no-page-break {
                page-break-inside: avoid;
            }
        }

        /* Vaccination Card Styles for Screen */
        .vaccination-card {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border: 2px solid #0F4C75;
            border-radius: 10px;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-header-print {
            background: linear-gradient(135deg, #0F4C75, #006A4E);
            color: white;
            text-align: center;
            padding: 2rem;
        }

        .card-header-print h1 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
        }

        .card-header-print .subtitle {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
        }

        .child-info-print {
            background: #F0F4F8;
            padding: 10px;
            border-bottom: 2px solid #0F4C75;
        }

        .child-info-print .row {
            margin-bottom: 0.5rem;
        }

        .child-info-print .label {
            font-weight: 600;
            color: #0F4C75;
        }

        .child-info-print .value {
            color: #333;
        }

        .vaccination-table-print {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .vaccination-table-print th {
            background: #F0F4F8;
            color: #0F4C75;
            font-weight: 600;
            padding: 12px 8px;
            border: 1px solid #ddd;
            font-size: 0.9rem;
            text-align: center;
        }

        .vaccination-table-print td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            font-size: 0.85rem;
            text-align: center;
        }

        .vaccination-table-print tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-badge-print {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-given-print {
            background: #E8F5E8;
            color: #006A4E;
            border: 1px solid #006A4E;
        }

        .status-scheduled-print {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-missed-print {
            background: #FFF0F0;
            color: #ff0000;
            border: 1px solid #ff0000;
        }

        .card-footer-print {
            background: #F0F4F8;
            text-align: center;
            border-top: 2px solid #0F4C75;
        }

        .footer-info-print {
            font-size: 0.85rem;
            color: #0F4C75;
            margin-bottom: 0.5rem;
        }

        .print-date {
            font-size: 0.8rem;
            color: #666;
        }

       

        .signature-box {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-bottom: 1px solid #333;
            height: 40px;
            margin-bottom: 0.5rem;
        }

        .signature-label {
            font-size: 0.8rem;
            color: #666;
        }

      

    </style>
    @include('partials.datatable_css')
@endsection

@section('body')
<div class="row">
    <div class="col-md-12 p-5 pt-3">
        <div class="card card-outline card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title pt-2 pb-2">
                    Vaccination Records for {{ $child->name }}
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn print-btn" onclick="printVaccinationCard()">
                        <i class="fas fa-print me-2"></i>Print Vaccination Card
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive " style='padding-bottom: 10px;'>
                    <table id="records" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Vaccine Name</th>
                                <th>Dose Number</th>
                                <th>Next Due Date</th>
                                <th>Status</th>
                                <th>Provided By</th>
                                <th>Vaccination Date</th>
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

<!-- Hidden Print Section -->
<div class="print-section">
    <div class="vaccination-card">
        <!-- Header -->
        <div class="card-header-print">
            <h1>VACCINATION CARD</h1>
            <p class="subtitle">Republic of Bangladesh - Ministry of Health</p>
        </div>

        <!-- Child Information -->
        <div class="child-info-print">
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-5 label">Child Name:</div>
                        <div class="col-7 value">{{ $child->name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 label">Date of Birth:</div>
                        <div class="col-7 value">{{ \Carbon\Carbon::parse($child->date_of_birth)->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 label">Gender:</div>
                        <div class="col-7 value">{{ ucfirst($child->gender) }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-5 label">Parent/Guardian:</div>
                        <div class="col-7 value">{{ $child->parent->name ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 label">Card Number:</div>
                        <div class="col-7 value">VC-{{ str_pad($child->id, 6, '0', STR_PAD_LEFT) }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 label">Age:</div>
                        <div class="col-7 value">{{ \Carbon\Carbon::parse($child->date_of_birth)->age }} years</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vaccination Records Table -->
        <div class="table-responsive">
            <table class="vaccination-table-print">
                <thead>
                    <tr>
                        <th style="width: 25%">Vaccine Name</th>
                        <th style="width: 10%">Dose</th>
                        <th style="width: 15%">Due Date</th>
                        <th style="width: 15%">Given Date</th>
                        <th style="width: 15%">Status</th>
                        <th style="width: 20%">Healthcare Provider</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                    <tr>
                        <td style="text-align: left;">{{ $record->vaccine->name ?? 'N/A' }}</td>
                        <td>{{ $record->dose_number }}</td>
                        <td>{{ $record->next_due_date ? \Carbon\Carbon::parse($record->next_due_date)->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $record->date_given ? \Carbon\Carbon::parse($record->date_given)->format('d/m/Y') : '-' }}</td>
                        <td>
                            @php
                                $statusClass = '';
                                switch(strtolower($record->status)) {
                                    case 'given':
                                        $statusClass = 'status-given-print';
                                        break;
                                    case 'scheduled':
                                        $statusClass = 'status-scheduled-print';
                                        break;
                                    case 'missed':
                                        $statusClass = 'status-missed-print';
                                        break;
                                    default:
                                        $statusClass = 'status-scheduled-print';
                                }
                            @endphp
                            <span class="status-badge-print {{ $statusClass }}">{{ ucfirst($record->status) }}</span>
                        </td>
                        <td style="text-align: left;">{{ $record->healthWorker->name ?? 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No vaccination records found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Summary Statistics -->
        <div class="summary-stats">
            <div class="row text-center">
                <div class="col-3">
                    <strong style="color: #006A4E;">{{ $records->where('status', 'given')->count() }}</strong><br>
                    <small>Completed</small>
                </div>
                <div class="col-3">
                    <strong style="color: #856404;">{{ $records->where('status', 'scheduled')->count() }}</strong><br>
                    <small>Scheduled</small>
                </div>
                <div class="col-3">
                    <strong style="color: #ff0000;">{{ $records->where('status', 'missed')->count() }}</strong><br>
                    <small>Overdue</small>
                </div>
                <div class="col-3">
                    <strong style="color: #0F4C75;">{{ $records->count() }}</strong><br>
                    <small>Total</small>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="card-footer-print">
            <div class="footer-info-print">
                <strong>Important:</strong> Keep this card safe and bring it to all vaccination appointments.
            </div>
            <div class="print-date">
                Card printed on: <span id="printDate"></span>
            </div>
            
            <!-- Signature Section -->
            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-label">Parent/Guardian Signature</div>
                </div>
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-label">Healthcare Provider Signature</div>
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
                url: "{{ route('child.vaccine.records', $child->id) }}",
                method: 'post',
                data: function (d) {
                    d._token = $('input[name="_token"]').val();
                },
                dataSrc: function (json) {
                    // Store the data for printing
                    vaccinationData = json.data;
                    return json.data;
                }
            },
            columns: [
                { data: 'vaccine_name', name: 'vaccine_name' },
                { data: 'dose_number', name: 'dose_number' },
                { data: 'next_due_date', name: 'next_due_date' },
                { data: 'status', name: 'status' },
                { data: 'health_worker', name: 'health_worker' },
                { data: 'vaccination_date', name: 'vaccination_date' }
            ],
            "aaSorting": []
        });
    });

    function printVaccinationCard() {
        // Set print date
        const now = new Date();
        const printDate = now.toLocaleDateString('en-BD', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        document.getElementById('printDate').textContent = printDate;

        // Show loading state
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Preparing...';
        button.disabled = true;

        // Trigger print after a short delay
        setTimeout(() => {
            window.print();
            
            // Reset button
            button.innerHTML = originalText;
            button.disabled = false;
        }, 500);
    }

 
    
</script>
@endsection