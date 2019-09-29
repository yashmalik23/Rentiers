@extends('admin.layout')
@section('admin-view')
    @if(Auth::user() != null)
        @if (Auth::user()->email == "inforentiers@gmail.com")
            <div class="main-layout">
                <div class="delete-modal">
                    <div class="modal-content">
                        <div>Are you sure you want to delete this user?</div>
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
                    <img src="/images/menu.svg" alt="menu" class="dashboard-icon" onclick="handleMenu()" />
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
        @else
            <script>window.location.href="/login"</script>
        @endif
    @else
        <script>window.location.href="/login"</script>
    @endif
@endsection