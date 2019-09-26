@extends('admin.layout')
@section('admin-view')
    @if(Auth::user() != null)
        <div class="main-layout">
            <!-- nav-bar -->
            <div class="nav-bar">
                <img src="/images/menu.svg" alt="menu" class="dashboard-icon" onclick="handleMenu()" />
                <span class="dashboard-heading">Dashboard</span>
            </div>
        </div>
    @else
        <script>window.location.href="/login"</script>
    @endif
@endsection