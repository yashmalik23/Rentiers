@extends('admin.layout')
@section('admin-view')
    <script type="text/javascript" src="{{asset('js/contact.js') }}"></script>
        <div class="main-layout">
            <!-- nav-bar -->
            <div class="nav-bar">
                <img src="/images/menu.svg" alt="menu" class="dashboard-icon" onclick="handleAdminMenu()" />
                <span class="dashboard-heading">Dashboard</span>
            </div>
            {{-- quick links --}}
            <div class="quick-links">
                <div class="links-heading">Quick links</div>
                <div class="admin-card-container">
                    <div class="admin-card" onclick="function c(){window.location.href='{{route('members')}}'}; c()" >
                        <img src="{{asset('/images/admin/members.svg')}}"  class="card-image"/>
                        <div class="admin-card-text">
                            <div class="card-name">Members</div>
                            <div class="card-info">Total: {{$members}}</div>
                        </div>
                    </div>
                    <div class="admin-card" onclick="function c(){window.location.href='{{route('sellers')}}'}; c()">
                        <img src="{{asset('/images/admin/sellers.svg')}}"  class="card-image"/>
                        <div class="admin-card-text">
                            <div class="card-name">Sellers</div>
                            <div class="card-info">Total: {{$sellers}}</div>
                        </div>
                    </div>
                    <div class="admin-card" onclick="function c(){window.location.href='{{route('vassets')}}'}; c()">
                        <img src="{{asset('/images/admin/vassets.svg')}}"  class="card-image"/>
                        <div class="admin-card-text" >
                            <div class="card-name">Verified Assets</div>
                            <div class="card-info">Total: {{$vassets}}</div>
                        </div>
                    </div>
                    <div class="admin-card" onclick="function c(){window.location.href='{{route('uassets')}}'}; c()">
                        <img src="{{asset('/images/admin/uassets.svg')}}"  class="card-image"/>
                        <div class="admin-card-text">
                            <div class="card-name">Pending Assets</div>
                            <div class="card-info">Total: {{$uassets}}</div>
                        </div>
                    </div>
                    <div class="admin-card" onclick="function c(){window.location.href='{{route('requests')}}'}; c()">
                        <img src="{{asset('/images/admin/contacts.svg')}}"  class="card-image"/>
                        <div class="admin-card-text">
                            <div class="card-name">Contact Requests</div>
                            <div class="card-info">Total: {{$contacts}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection