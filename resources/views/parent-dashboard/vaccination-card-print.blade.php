<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Card - {{ $child->name }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bd-green: #006A4E;
            --bd-red: #ff0000;
            --gov-blue: #0F4C75;
            --light-green: #E8F5E8;
            --light-red: #FFF0F0;
            --light-blue: #F0F4F8;
        }

        @media print {
            @page {
                size: A4;
                margin: 15mm;
            }
            
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            
            .no-print {
                display: none !important;
            }
            
            .card {
                border: 2px solid #000 !important;
                box-shadow: none !important;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .vaccination-card {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border: 2px solid var(--gov-blue);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--gov-blue), var(--bd-green));
            color: white;
            text-align: center;
            padding: 2rem;
        }

        .card-header h1 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .card-header .subtitle {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
        }

        .child-info {
            background: var(--light-blue);
            padding: 1.5rem;
            border-bottom: 2px solid var(--gov-blue);
        }

        .child-info .row {
            margin-bottom: 0.5rem;
        }

        .child-info .label {
            font-weight: 600;
            color: var(--gov-blue);
        }

        .child-info .value {
            color: #333;
        }

        .vaccination-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .vaccination-table th {
            background: var(--light-blue);
            color: var(--gov-blue);
            font-weight: 600;
            padding: 12px 8px;
            border: 1px solid #ddd;
            font-size: 0.9rem;
            text-align: center;
        }

        .vaccination-table td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            font-size: 0.85rem;
            text-align: center;
        }

        .vaccination-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-given {
            background: var(--light-green);
            color: var(--bd-green);
            border: 1px solid var(--bd-green);
        }

        .status-scheduled {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-missed {
            background: var(--light-red);
            color: var(--bd-red);
            border: 1px solid var(--bd-red);
        }

        .card-footer {
            background: var(--light-blue);
            padding: 1.5rem;
            text-align: center;
            border-top: 2px solid var(--gov-blue);
        }

        .footer-info {
            font-size: 0.85rem;
            color: var(--gov-blue);
            margin-bottom: 0.5rem;
        }

        .print-date {
            font-size: 0.8rem;
            color: #666;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
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
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Print Controls -->
        <div class="no-print text-center mb-4">
            <button class="btn btn-primary me-2" onclick="window.print()">
                <i class="fas fa-print me-1"></i>Print Card
            </button>
            <button class="btn btn-secondary" onclick="window.close()">
                <i class="fas fa-times me-1"></i>Close
            </button>
        </div>

        <!-- Vaccination Card -->
        <div class="vaccination-card">
            <!-- Header -->
            <div class="card-header">
                <h1>VACCINATION CARD</h1>
                <p class="subtitle">Republic of Bangladesh - Ministry of Health</p>
            </div>

            <!-- Child Information -->
            <div class="child-info">
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
                <table class="vaccination-table">
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
                                            $statusClass = 'status-given';
                                            break;
                                        case 'scheduled':
                                            $statusClass = 'status-scheduled';
                                            break;
                                        case 'missed':
                                            $statusClass = 'status-missed';
                                            break;
                                        default:
                                            $statusClass = 'status-scheduled';
                                    }
                                @endphp
                                <span class="status-badge {{ $statusClass }}">{{ ucfirst($record->status) }}</span>
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
            <div class="px-4 py-3" style="background: #f8f9fa; border-top: 1px solid #ddd;">
                <div class="row text-center">
                    <div class="col-3">
                        <strong style="color: var(--bd-green);">{{ $completedVaccines->count() }}</strong><br>
                        <small>Completed</small>
                    </div>
                    <div class="col-3">
                        <strong style="color: #856404;">{{ $upcomingVaccines->count() }}</strong><br>
                        <small>Scheduled</small>
                    </div>
                    <div class="col-3">
                        <strong style="color: var(--bd-red);">{{ $overdueVaccines->count() }}</strong><br>
                        <small>Overdue</small>
                    </div>
                    <div class="col-3">
                        <strong style="color: var(--gov-blue);">{{ $records->count() }}</strong><br>
                        <small>Total</small>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer">
                <div class="footer-info">
                    <strong>Important:</strong> Keep this card safe and bring it to all vaccination appointments.
                </div>
                <div class="print-date">
                    Card printed on: {{ \Carbon\Carbon::now()->format('d F Y, g:i A') }}
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

    <script>
        // Auto-print when page loads (optional)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 1000);
        // };

        // Close window after printing
        window.onafterprint = function() {
            // Uncomment if you want to auto-close after printing
            // window.close();
        };
    </script>
</body>
</html>