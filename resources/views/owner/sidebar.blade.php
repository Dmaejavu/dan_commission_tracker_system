<div class="sidebar">
    {{-- Navigation sidebar --}}
    <div class="sidebar-content">
        <nav>
            <div class="sidebar-section">
                <a class="imHere" href="{{ route('dashboardowner') }}">Dashboard</a>
            </div>
            <div class="sidebar-section">
                <small>Manage Commissions</small>
                <a class="imHere" href="{{ route('viewCommissions') }}">View Commissions</a>
                <a class="imHere" href="{{ route('totalCommissions') }}">Total Commissions</a>
            </div>
            <div class="sidebar-section">
                <small>Manage Personnel</small>
                <a class="imHere" href="{{ route('manageUser') }}">Users</a>
                <a class="imHere" href="{{ route('manageAgent') }}">Agents</a>
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
    <script>
        const sidebarLink = document.querySelectorAll('a.imHere');
        const currentLink = window.location.pathname;

        sidebarLink.forEach(function(link){
            const linkPath = new URL(link.href).pathname;
            if(linkPath === currentLink){
                link.classList.add('active');
            }
        });
        
        document.addEventListener('DOMContentLoaded', setActiveLink);
   
    </script>

</div> <!-- End of sidebar -->
