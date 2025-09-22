{{-- resources/views/reports/district_directory.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <title>District Directory Q{{ $currentQuarter }} {{ $year }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
        }

        h2 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>District Directory - Q{{ $currentQuarter }} {{ $year }}</h1>

    @foreach ($districtMembers as $districtData)
        <h2>District: {{ $districtData['district']->name }}</h2>

        @if ($districtData['members']->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Preferred Name</th>
                        <th>Branch</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($districtData['members'] as $member)
                        <tr>
                            <td>{{ $member['member_id'] }}</td>
                            <td>{{ $member['name'] }}</td>
                            <td>{{ $member['preferred_name'] }}</td>
                            <td>{{ $member['branch'] }}</td>
                            <td>{{ $member['email'] }}</td>
                            <td>{{ $member['phone'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No active members in this district.</p>
        @endif
    @endforeach
</body>

</html>
