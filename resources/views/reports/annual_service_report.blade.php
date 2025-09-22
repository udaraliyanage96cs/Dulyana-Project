<!DOCTYPE html>
<html>
<head>
    <title>Annual Service Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .member-info { margin-bottom: 20px; }
        .member-info p { margin: 5px 0; }
        .address { white-space: pre-wrap; }
    </style>
</head>
<body>
    <h1>Annual Service Report</h1>
    
    <div class="member-info">
        <p><strong>Member ID:</strong> {{ $member->member_id }}</p>
        <p><strong>Name:</strong> {{ $member->first_name }} {{ $member->last_name }}</p>
        <p><strong>Email:</strong> {{ $member->email }}</p>
        <p><strong>Phone:</strong> {{ $member->phone }}</p>
        <p><strong>Address:</strong> <span class="address">{{ $member->address_line1 }}, {{ $member->address_line2 }}, {{ $member->city }}, {{ $member->state }} {{ $member->postal_code }}</span></p>
    </div>
    
    <h2>Assigned Courses</h2>
    @if($courses->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Enrolled On</th>
                    <th>Completed On</th>
                    <th>Card Number</th>
                    <th>Issue Date</th>
                    <th>Expiry Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $mc)
                    <tr>
                        <td>{{ $mc->course->name }}</td>
                        <td>{{ $mc->enrollment_date ?? 'N/A' }}</td>
                        <td>{{ $mc->completion_date ?? 'N/A' }}</td>
                        <td>{{ $mc->card_number ?? 'N/A' }}</td>
                        <td>{{ $mc->issue_date ?? 'N/A' }}</td>
                        <td>{{ $mc->expiry_date ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No assigned courses.</p>
    @endif
    
    <h2>Assigned Branches</h2>
    @if($branches->isNotEmpty())
        @foreach($branches as $mb)
            <?php
                $branch = $mb->branch;
                $memberCommittees = $member->memberCommittees->filter(function($mc) use($branch) {
                    return $mc->committee && $mc->committee->branch_id == $branch->id;
                })->groupBy('committee_id');
            ?>
            <h3>{{ $branch->name ?? 'Unknown' }} (From: {{ $mb->start_date }} To: {{ $mb->end_date ?? 'Current' }}) </h3>
            
            @if($memberCommittees->isNotEmpty())
                @foreach($memberCommittees as $committeeId => $roles)
                    <?php $committee = $roles->first()->committee; ?>
                    <h4>Committee: {{ $committee->name ?? 'Unknown' }}</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>From</th>
                                <th>To</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->role_get->name ?? $role->role ?? 'Unknown' }}</td>
                                    <td>{{ $role->start_date }}</td>
                                    <td>{{ $role->end_date ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            @else
                <p>No committees assigned under this branch.</p>
            @endif
        @endforeach
    @else
        <p>No assigned branches.</p>
    @endif
</body>
</html>