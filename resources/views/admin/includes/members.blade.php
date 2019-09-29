@extends('admin.layout')
@section('admin-view')
    @if(Auth::user() != null)
        @if (Auth::user()->email == "inforentiers@gmail.com")
            <div class="main-layout">
                <div class="delete-modal">
                    <div class="modal-content">
                        <div>Are you sure you want to delete this user?</div>
                        <form class="delete-props" method="POST" action="{{ route('memberdelete')}}">
                            @csrf
                            <input type="number" id="member-user-delete" name="id" hidden>
                            <button type="submit">Yes</button>
                            <div class="cancel" onclick="closeMemberModal()">No</div>
                        </form>
                    </div>
                </div>
                <!-- nav-bar -->
                <div class="nav-bar">
                    <img src="/images/menu.svg" alt="menu" class="dashboard-icon" onclick="handleMenu()" />
                    <span class="dashboard-heading">Members</span>
                </div>
                <div class="admin-search-bar-container">
                    <input type="text" placeholder="Search name" value="{{$search}}" class="admin-search-bar" name="search-text"/>
                    <img src="{{asset('/images/home/search.svg')}}" onclick="searchMember(event)"/>
                </div>
                <div class="users-card-container">
                    @foreach ($members as $member)
                        <div class="user-card">
                            <div class="user-card-text">
                                <div class="user-card-name">{{$member->name}}</div>
                                <div class="user-info-group">
                                    <img src="{{asset('/images/admin/phone.svg')}}">
                                    <div>+91 {{$member->contact}}</div>
                                </div>
                                <div class="user-info-group">
                                    <img src="{{asset('/images/admin/email.svg')}}">
                                    <div>{{$member->email}}</div>
                                </div>
                            </div>
                            <div class="user-card-actions">
                                <img src="{{asset('/images/viewprops/close.svg')}}" onclick="showMemberModal(event, {{$member->id}})" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="admin-page-links">{{$members->links()}}</div>
            </div>
        @else
            <script>window.location.href="/login"</script>
        @endif
    @else
        <script>window.location.href="/login"</script>
    @endif
@endsection