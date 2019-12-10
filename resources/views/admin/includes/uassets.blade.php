@extends('admin.layout')
@section('admin-view')
<script type="text/javascript" src="{{asset('js/user.js') }}"></script>
<script type="text/javascript" src="{{asset('js/navbar.js') }}"></script>
            <div class="main-layout">
                <!-- nav-bar -->
                <div class="nav-bar">
                    <img src="/images/menu.svg" alt="menu" class="dashboard-icon" onclick="handleAdminMenu()" />
                    <span class="dashboard-heading">Pending assets</span>
                </div>
                
                @if(session('succ'))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Changed status successfully.
                </div>
                @endif
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
                    <div class="frontalert alert-danger" id="frontalert">
                        Wrong details
                    </div>
                    <div class="modal-content">
                        <div>You can add upto 10 images</div>
                        <form class="image-props" method="POST" action="{{ route('uaddimagetoprop')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="number" id="image-prop" name="id" hidden>
                            <label for="file-field-image">Images</label>
                            <input type="file" id="file-field-image" name="file[]" accept=".jpg,.png" multiple onchange="checkImages(e)">
                            <div id="submitContainer"> 
                                <button type="submit" style="display:none"></button>
                                <div class="cancel" onclick="closeImageModal()">Cancel</div>
                            </div>
                            <div class="loader" id="loader">
                                <div class="spinner spinner-1">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="sold-modal">
                    <div class="frontalert alert-danger">
                        Wrong details
                    </div>
                    <div class="modal-content">
                        <div id="sold-title"></div>
                        <form class="sold-props" method="POST" action="{{ route('changestatus')}}" enctype="multipart/form-data" >
                            @csrf
                            <input type="number" id="sold-prop" name="id" hidden>
                            <input type="number" id="sold-prop-1" name="use" hidden>
                            <button type="submit">Yes</button>
                            <div class="cancel" onclick="closeSold()">No</div>
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
                            <div class="property-details">
                                <div class="property-title"><a href="/adminview/{{$prop->id}}">{{$prop->streetName}}</a></div>
                                <div class="property-address">{{$prop->locality.", ".$prop->city}}</div>
                                <div class="property-interested-numbers">ID : {{$prop->id}} , Date : {{date("d-m-Y", strtotime($prop->created_at))}}</div>
                            
                                <div class="property-actions">
                                    <a href="/adminedit/{{$prop->id}}"><img title="Edit" src="{{asset('images/viewprops/document.svg')}}"/></a>
                                    <img title="Delete" src="{{asset('images/viewprops/delete.svg')}}" onclick="showModal(event, {{$prop->id}})" >
                                    <img title="Upload images" src="{{asset('images/viewprops/upload.svg')}}" onclick="showImageModal(event, {{$prop->id}})" >
                                    <a href="/images/{{$prop->id}}"><img title="View images" src="{{asset('images/viewprops/choices.svg')}}"/></a>
                                    <img title="Property status" src="{{asset('images/viewprops/sold.svg')}}" onclick="showSold(event, {{$prop->id}}, {{$prop->inUse}})" >
                                </div>
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
@endsection