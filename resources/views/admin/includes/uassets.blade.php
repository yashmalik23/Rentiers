@extends('admin.layout')
@section('admin-view')
<script type="text/javascript" src="{{asset('js/user.js') }}"></script>
    @if(Auth::user() != null)
        @if (Auth::user()->email == "inforentiers@gmail.com")
            <div class="main-layout">
                <!-- nav-bar -->
                <div class="nav-bar">
                    <img src="/images/menu.svg" alt="menu" class="dashboard-icon" onclick="handleMenu()" />
                    <span class="dashboard-heading">Pending assets</span>
                </div>
                @if(isset($success))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Property verified.
                </div>
                @endif
                @if(isset($image))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Image added successfully.
                </div>
                @endif
                @if(isset($delete))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Property deleted successfully.
                </div>
                @endif
                <div class="admin-search-bar-container">
                    <input type="text" placeholder="Search address" value="{{$search}}" class="admin-search-bar" name="search-text"/>
                    <img src="{{asset('/images/home/search.svg')}}" onclick="searchUProps(event)"/>
                </div>
                <div class="delete-modal">
                    <div class="modal-content">
                        <div>Are you sure you want to delete this property?</div>
                        <form class="delete-props" method="POST" action="{{ route('deleteprops')}}">
                            @csrf
                            <input type="number" id="delete-prop" name="id" hidden>
                            <button type="submit">Yes</button>
                            <div class="cancel" onclick="closeModal()">No</div>
                        </form>
                    </div>
                </div>
                <div class="upload-image-modal">
                    <div class="modal-content">
                        <div>You can add upto 15 images and 1 video</div>
                        <form class="image-props" method="POST" action="{{ route('uaddimagetoprop')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="number" id="image-prop" name="id" hidden>
                            <label for="file-field-image">Images</label>
                            <input type="file" id="file-field-image" name="file[]" accept=".jpg,.png" multiple>
                            <button type="submit">Save</button>
                            <div class="cancel" onclick="closeImageModal()">Cancel</div>
                        </form>
                    </div>
                </div>
                <div class="user-account">
                    <div class="user-properties">
                        @foreach($props as $prop)
                        <div class="property-card" onclick="">
                            @if(count(explode(",", $prop->images))>0 && explode(",",$prop->images)[0] != "" && explode(",",$prop->images)[0] != "noimage.png") 
                            <img class="card-image-circle" src="/storage/{{$prop->id}}/{{explode(",",$prop->images)[0]}}"/>
                            @else
                                <img class="card-image-circle" src="/storage/noimage.png"/>
                            @endif
                            <div class="property-actions">
                                <a href="/adminedit/{{$prop->id}}"><img class="card-image-edit" src="{{asset('images/viewprops/edit.svg')}}"/></a>
                                <img class="card-image-cancel" src="{{asset('images/viewprops/close.svg')}}" onclick="showModal(event, {{$prop->id}})" >
                                <img class="card-image-cancel" src="{{asset('images/viewprops/upload.svg')}}" onclick="showImageModal(event, {{$prop->id}})" >
                                <a href="/images/{{$prop->id}}"><img class="card-image-edit" src="{{asset('images/viewprops/photo.svg')}}"/></a>
                            </div>
                            <div class="property-details">
                                <div class="property-title"><a href="/adminview/{{$prop->id}}">{{$prop->streetName}}</a></div>
                                <div class="property-address">{{$prop->locality.", ".$prop->city}}</div>
                                <div class="property-interested-numbers">Interested members : 10</div>
                            </div>
                            <div class="property-footer">Details:
                                @if(count(explode(",",$prop->ownerdetails))>2)
                                    @if(explode(",",$prop->ownerdetails)[0] != "" && explode(",",$prop->ownerdetails)[1] != "" && explode(",",$prop->ownerdetails)[2] != "")
                                    {{explode(",",$prop->ownerdetails)[0]}},{{explode(",",$prop->ownerdetails)[1]}},{{explode(",",$prop->ownerdetails)[2]}}
                                    @else
                                    {{Auth::user()->email}}, {{Auth::user()->contact}},{{Auth::user()->name}}
                                    @endif
                                @else
                                    {{Auth::user()->email}}, {{Auth::user()->contact}},{{Auth::user()->name}}
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="admin-page-links">{{$props->links()}}</div>
            </div>
        @else
            <script>window.location.href="/login"</script>
        @endif
    @else
        <script>window.location.href="/login"</script>
    @endif
@endsection