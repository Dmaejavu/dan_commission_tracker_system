<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Agent</title>
</head>
<body>
    <h1>Edit Agent</h1>

    <form action="{{ route('agents.update', $agent->agentID) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="agentname">Agent Name:</label>
        <input type="text" name="agentname" id="agentname" value="{{ $agent->agentname }}" required>
        <br>

        <label for="comrate">Commission Rate:</label>
        <input type="number" step="0.01" name="comrate" id="comrate" value="{{ $agent->comrate }}" required>
        <br>

        <label for="area">Area:</label>
        <input type="text" name="area" id="area" value="{{ $agent->area }}" required>
        <br>

        <button type="submit">Update Agent</button>
    </form>
</body>
</html>