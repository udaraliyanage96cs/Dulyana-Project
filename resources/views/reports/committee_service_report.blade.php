<!DOCTYPE html>
<html>
<head>
    <title>Committee Service Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        h2 { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Committee Service Report</h1>
    
    @foreach($committees as $committee)
        <h2>{{ $committee->name }}</h2>
        
        @if($committee->memberCommittees->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($committee->memberCommittees as $mc)
                        <?php $member = $mc->member; ?>
                        <tr>
                            <td>{{ $mc->role_get->name ?? $mc->role ?? 'N/A' }}</td>
                            <td>{{ $member->member_id }}</td>
                            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                            <td>{{ $mc->start_date ? \Carbon\Carbon::parse($mc->start_date)->format('M d, Y') : 'N/A' }}</td>
                            <td>{{ $mc->end_date ? \Carbon\Carbon::parse($mc->end_date)->format('M d, Y') : 'Current' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No service records for this committee.</p>
        @endif
    @endforeach
</body>
</html>