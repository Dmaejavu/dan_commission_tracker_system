<div class="sidebar">
    {{-- Navigation sidebar --}}
    <div class="sidebar-content">
        <nav>
            <div class="sidebar-section">
                <a href="{{ route('dashboardowner') }}">Dashboard</a>
            </div>
            <div class="sidebar-section">
                <small>Manage Commissions</small>
                <a href="{{ route('viewCommissions') }}">View Commissions</a>
                <a href="{{ route('totalCommissions') }}">Total Commissions</a>
            </div>
            <div class="sidebar-section">
                <small>Manage Personnel</small>
                <a href="{{ route('manageUser') }}">Users</a>
                <a href="{{ route('manageAgent') }}">Agents</a>
            </div>
        </nav>
        <div class="logoutDIV">
            {{-- Logout Button --}}
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div> <!-- End of sidebar-content -->
</div> <!-- End of sidebar -->
