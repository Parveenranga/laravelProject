<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Contact Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Contact Messages</h2>

    <a href="{{ url('/') }}" class="btn btn-secondary mb-3">← Back to Home</a>

    @if($messages->count() > 0)
    <div class="mt-4">
    {{ $messages->links() }}
</div>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $index => $msg)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $msg->name }}</td>
                        <td>{{ $msg->email }}</td>
                        <td>{{ $msg->message }}</td>
                        <td>{{ $msg->created_at->format('d M Y h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">No messages found.</div>
    @endif
</div>

</body>
</html>
