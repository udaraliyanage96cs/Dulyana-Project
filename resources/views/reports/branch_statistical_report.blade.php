{{-- resources/views/reports/branch_statistical_report.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <title>Branch Statistical Report</title>
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

        .summary {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Statistical Report for Branch: {{ $branch->name }} - {{ now()->year }}</h1>
    <p><strong>District:</strong> {{ $branch->zone->district->name ?? 'N/A' }}</p>
    <p><strong>Zone:</strong> {{ $branch->zone->name ?? 'N/A' }}</p>

    <h2>Summary</h2>
    <p class="summary">Active Members: {{ $activeCount }}</p>
    <p class="summary">In-Training: {{ $inTrainingCount }}</p>
    <p class="summary">New Members This Year: {{ $newCount }}</p>

    <h2>Active Members</h2>
    @if ($activeMembers->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Start Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activeMembers as $mb)
                    <?php $member = $mb->member; ?>
                    <tr>
                        <td>{{ $member->member_id }}</td>
                        <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $mb->start_date ? \Carbon\Carbon::parse($mb->start_date)->format('M d, Y') : 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No active members.</p>
    @endif

    <h2>In-Training Members</h2>
    @if ($inTrainingMembers->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Incomplete Courses</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inTrainingMembers as $member)
                    <tr>
                        <td>{{ $member->member_id }}</td>
                        <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>
                            @foreach ($member->memberCourses as $mc)
                                {{ $mc->course->name }} (Status: {{ $mc->status }})<br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No members in training.</p>
    @endif

    <h2>New Members This Year</h2>
    @if (count($newMembers) > 0)
        <table>
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Start Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newMembers as $mb)
                    <tr>
                        <td>{{ $mb?->member?->member_id }}</td>
                        <td>{{ $mb?->member?->first_name }} {{ $mb?->member?->last_name }}</td>
                        <td>{{ $mb?->member?->email }}</td>
                        <td>{{ $mb?->member?->start_date ? \Carbon\Carbon::parse($mb?->member?->start_date)->format('M d, Y') : '' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No new members this year.</p>
    @endif
</body>

</html>
