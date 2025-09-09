@php
$padding_top = $candidate->passportDetail->raDocument->registration_no == 'B-0500/UP/COM/1000+/5/8956/2013' ? '20px':
($candidate->passportDetail->raDocument->registration_no == 'B-1348/UP/PER/1000+/5/9588/2019' ? '155px' : '20px');
@endphp

<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        .page {
            position: relative;
            width: 100%;
            height: 297mm;
        }

        .table-overlay {
            width: 80%;
            margin-left: 10%;
            padding-top: 12px;
            /* padding-top: 160px; */
        }

        table {
            font-family: sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid;
            text-align: left;
            padding: 5px;
        }
    </style>
</head>

<body>

    {{-- Loop over affidavit images to generate page overlays --}}
    @foreach($candidate->passportDetail->raDocument->scan_notary as $key => $image)
    <div class="page" style="
            background-image: url('{{ public_path('storage/'.$image) }}');
            background-repeat: no-repeat;
            background-position: left top;
            background-size: cover;">
        @if($loop->index == 1)

        <div class="table-overlay" style="padding-top: {{ $padding_top }};">
            <div style="margin-left: 9%;width:80%;padding-top:10px;text-align:center;"> <strong>That I have applied for
                    Emigration Clearance</strong> </div>
            <table>
                <tr>
                    <td>A.</td>
                    <td>NAME OF EMIGRANT</td>
                    <td>{{ $candidate->first_name_eng }} {{ $candidate->last_name_eng }}</td>
                </tr>
                <tr>
                    <td>B.</td>
                    <td>PASSPORT NUMBER</td>
                    <td>{{ $candidate->passportDetail->passport_no }}</td>
                </tr>
                <tr>
                    <td>C.</td>
                    <td>NAME OF FOREIGN EMPLOYER</td>
                    <td>{{ $candidate->passportDetail->fe_name }}</td>
                </tr>
                <tr>
                    <td>D.</td>
                    <td>VISA NUMBER</td>
                    <td>{{ $candidate->visa_no }}</td>
                </tr>
                <tr>
                    <td>E.</td>
                    <td>VISA EXPIRY</td>
                    <td>{{ $candidate->visa_expiry_date }}</td>
                </tr>
                <tr>
                    <td>F.</td>
                    <td>FE ID</td>
                    <td>{{ $candidate?->emigrate_fe_id ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>G.</td>
                    <td>DESTINATION COUNTRY</td>
                    <td>{{ $candidate->passportDetail->country->name }}</td>
                </tr>
                <tr>
                    <td>H.</td>
                    <td>DEMAND DATE</td>
                    <td>{{ date('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td>I.</td>
                    <td>DATE OF VISA ISSUE</td>
                    <td>{{ $candidate->visa_issue_date }}</td>
                </tr>
            </table>
        </div>
        @endif
    </div>
    @endforeach
</body>

</html>