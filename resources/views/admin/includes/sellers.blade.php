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
                        <form class="delete-props" method="POST" action="{{ route('sellerdelete')}}">
                            @csrf
                            <input type="number" id="seller-user-delete" name="id" hidden>
                            <button type="submit">Yes</button>
                            <div class="cancel" onclick="closeSellerModal()">No</div>
                        </form>
                    </div>
                </div>
                <!-- nav-bar -->
                <div class="nav-bar">
                    <img src="/images/menu.svg" alt="menu" class="dashboard-icon" onclick="handleAdminMenu()" />
                    <span class="dashboard-heading">Sellers</span>
                </div>
                <div class="admin-search-bar-container">
                    <input type="text" placeholder="Search name" value="{{$search}}" class="admin-search-bar" name="search-text"/>
                    <img src="{{asset('/images/home/search.svg')}}" onclick="searchSeller(event)"/>
                </div>
                <div class="users-card-container">
                    @foreach ($sellers as $seller)
                        <div class="user-card">
                            <div class="user-card-text">
                                <div class="user-card-name">{{$seller->name}}</div>
                                <div class="user-info-group">
                                    <img src="{{asset('/images/admin/phone.svg')}}">
                                    <div>+91 {{$seller->contact}}</div>
                                </div>
                                <div class="user-info-group">
                                    <img src="{{asset('/images/admin/email.svg')}}">
                                    <div>{{$seller->email}}</div>
                                </div>
                            </div>
                            <div class="user-card-actions">
                                <img src="{{asset('/images/viewprops/close.svg')}}" onclick="showSellerModal(event, {{$seller->id}})" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="admin-page-links">{{$sellers->links()}}</div>
            </div>
@endsection