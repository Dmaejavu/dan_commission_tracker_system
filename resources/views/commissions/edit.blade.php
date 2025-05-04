<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Commission</title>
</head>
<body>

    <div class="wrapper">
        <!-- watt, lemme cook -Dan the man -->
    </div>
    <h1>Edit my ass Commission</h1>

    <form action="{{ route('commissions.update', $commission->comID) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="totalcom">Total Commission:</label>
        <input type="number" step="0.01" name="totalcom" id="totalcom" value="{{ $commission->totalcom }}" required>
        <br>

        <label for="clientname">Client Name:</label>
        <input type="text" name="clientname" id="clientname" value="{{ $commission->clientname }}" required>
        <br>

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="Pending" {{ $commission->status === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Approved" {{ $commission->status === 'Approved' ? 'selected' : '' }}>Approved</option>
            <option value="Rejected" {{ $commission->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="Canceled" {{ $commission->status === 'Canceled' ? 'selected' : '' }}>Canceled</option>
        </select>
        <br>

        <button type="submit">Update Commission</button>
    </form>
</body>
</html>