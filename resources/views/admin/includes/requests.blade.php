@extends('admin.layout')
@section('admin-view')
            <div class="main-layout">
                <!-- nav-bar -->
                <div class="nav-bar">
                    <img src="/images/menu.svg" alt="menu" class="dashboard-icon" onclick="handleMenu()" />
                    <span class="dashboard-heading">Contact requests</span>
                </div>
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Request status changed.
                </div>
                @endif
                @if(session('delete'))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Request deleted successfully.
                </div>
                @endif
                <div class="delete-modal">
                    <div class="modal-content">
                        <div>Are you sure you want to delete this user?</div>
                        <form class="delete-props" method="POST" action="{{ route('requestdelete')}}">
                            @csrf
                            <input type="number" id="member-user-delete" name="id" hidden>
                            <button type="submit">Yes</button>
                            <div class="cancel" onclick="closeMemberModal()">No</div>
                        </form>
                    </div>
                </div>
                <div class="edit-modal">
                    <div class="modal-content">
                        <div>Change the status of request</div>
                        <form class="delete-props" method="POST" action="{{ route('requeststatus')}}">
                            @csrf
                            <input type="number" id="request-user-delete" name="id" hidden>
                            <div class="form-drop-down-options" id="request-status">
                                    <div class="drop-down-label">Change status * </div>
                                    <div class="drop-down-heading" onclick="showdrop(event)" id="requestStatus">Select</div>
                                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                                    <ul class="drop-down-list">
                                        <li onclick="changeoption(event)">Received</li>
                                        <li onclick="changeoption(event)">Contacted</li>
                                        <li onclick="changeoption(event)">Resolved</li>
                                        <li onclick="changeoption(event)">Unresolved</li>
                                        <li onclick="changeoption(event)">Fake Details</li>
                                        <li onclick="changeoption(event)">Closed</li>
                                    </ul>
                                </div>
                                <input name="requeststatus" type="text" hidden value="Received">
                            <button type="submit">Save</button>
                            <div class="cancel" onclick="closeEditModal()">Cancel</div>
                        </form>
                    </div>
                </div>
                <div class="admin-search-bar-container">
                    <input type="text" placeholder="Search status/contact" value="{{$search}}" class="admin-search-bar" name="search-text"/>
                    <img src="{{asset('/images/home/search.svg')}}" onclick="searchRequests(event)"/>
                </div>
                <div class="requests-card-container">
                    @foreach ($requests as $request)
                        <div class="request-card">
                            <div class="user-card-text">
                                <div class="user-card-name">{{$request->name}}</div>
                                <div class="user-info-group">
                                    <img src="{{asset('/images/admin/phone.svg')}}">
                                    <div>+91 {{$request->contact}}, {{$request->email}}</div>
                                </div>
                                <div class="user-info-group">
                                    <div>{{$request->status}} on {{date("d/m/y", strtotime($request->updated_at))}}</div>
                                </div>
                                <div class="user-info-group">
                                    <div>{{$request->request}}</div>
                                </div>
                            </div>
                            <div class="user-card-actions">
                                <img src="{{asset('/images/viewprops/edit.svg')}}" onclick="showEditModal(event, {{$request->id}}, '{{$request->status}}')" />
                                <img src="{{asset('/images/viewprops/close.svg')}}" onclick="showMemberModal(event, {{$request->id}})" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="admin-page-links">{{$requests->links()}}</div>
            </div>
@endsection