@extends('admin.layout')
@section('admin-view')
            <div class="main-layout">
                @if(isset($delete))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> User deleted successfully.
                </div>
                @endif
                <div class="delete-modal">
                    <div class="modal-content">
                        <div>Are you sure you want to delete this user? This will delete the properties associated with the user</div>
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
                    <img src="/images/menu.svg" alt="menu" class="dashboard-icon" onclick="handleAdminMenu()" />
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
                                <div class="user-card-name"><a href="/adminuseraccount/{{$member->id}}">{{$member->name}}</a></div>
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
@endsection