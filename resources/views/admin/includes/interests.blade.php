@extends('admin.layout')
@section('admin-view')
            <div class="main-layout">
                @if(session('delete'))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Interest deleted.
                </div>
                @endif
                <div class="delete-modal">
                    <div class="modal-content">
                        <div>Are you sure you want to delete this interest</div>
                        <form class="delete-props" method="POST" action="{{ route('interestdelete')}}">
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
                    <span class="dashboard-heading">Interests</span>
                </div>
                <div class="admin-search-bar-container">
                    <input type="text" placeholder="Search name/property" value="{{$search}}" class="admin-search-bar" name="search-text"/>
                    <img src="{{asset('/images/home/search.svg')}}" onclick="searchInterests(event)"/>
                </div>
                <div class="users-card-container">
                    @foreach ($interests as $interest)
                        <div class="user-card">
                            <div class="user-card-text">
                                <div class="user-card-name">{{$interest->name}}</div>
                                <div class="user-info-group">
                                    <img src="{{asset('/images/admin/phone.svg')}}">
                                    <div>+91 {{$interest->contact}}</div>
                                </div>
                                <div class="user-info-group">
                                    <div>{{$interest->propdetails}}</div>
                                </div>
                            </div>
                            <div class="user-card-actions">
                                <img src="{{asset('/images/viewprops/close.svg')}}" onclick="showMemberModal(event, {{$interest->id}})" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="admin-page-links">{{$interests->links()}}</div>
            </div>
@endsection