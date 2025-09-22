```blade
<!DOCTYPE html>
<html>
<head>
    <title>Training/Education Report</title>
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
    <h1>Training/Education Report</h1>
    
    @foreach($members as $member)
        <h2>{{ $member->first_name }} {{ $member->last_name }} (ID: {{ $member->member_id }})</h2>
        
        @if($member->memberCourses->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Course Title</th>
                        <th>Provider</th>
                        <th>Enrollment Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Duration (Hours)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($member->memberCourses as $mc)
                        <?php $course = $mc->course; ?>
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->provider ?? 'N/A' }}</td>
                            <td>{{ $mc->enrollment_date ? \Carbon\Carbon::parse($mc->enrollment_date)->format('M d, Y') : 'N/A' }}</td>
                            <td>{{ $mc->enrollment_date ? \Carbon\Carbon::parse($mc->enrollment_date)->format('M d, Y') : 'N/A' }}</td>
                            <td>{{ $mc->completion_date ? \Carbon\Carbon::parse($mc->completion_date)->format('M d, Y') : 'N/A' }}</td>
                            <td>{{ $course->duration_hours ?? 'N/A' }}</td>
                            <td>{{ $mc->status ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No training records for this member.</p>
        @endif
    @endforeach
</body>
</html>
```