@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/user.js') }}"></script>
    @if (isset(Auth::user()->email))
        @if(Auth::user()->email != "inforentier@gmail.com")
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
                    <div>You can add upto 5 images and size of each image mustbe less than 2 MB</div>
                    <form class="image-props" method="POST" action="{{ route('addimagetoprop')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="number" id="image-prop" name="id" hidden>
                        <label for="file-field-image">Images</label>
                        <input type="file" id="file-field-image" name="file[]" accept=".jpg,.png" multiple onchange="checkImages(event)">
                        <button type="submit">Save</button>
                        <div class="cancel" onclick="closeImageModal()">Cancel</div>
                    </form>
                </div>
            </div>
            <a href="{{route('userpassword')}}">Edit personal details</a>
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
                            <a href="/useraccountedit/{{$prop->id}}"><img class="card-image-edit" src="{{asset('images/viewprops/edit.svg')}}"/></a>
                            <img class="card-image-cancel" src="{{asset('images/viewprops/close.svg')}}" onclick="showModal(event, {{$prop->id}})" >
                            <img class="card-image-cancel" src="{{asset('images/viewprops/upload.svg')}}" onclick="showImageModal(event, {{$prop->id}})" >
                            <a href="/images/{{$prop->id}}"><img class="card-image-edit" src="{{asset('images/viewprops/photo.svg')}}"/></a>
                        </div>
                        <div class="property-details">
                            <div class="property-title"><a href="/useraccount/{{$prop->id}}">{{$prop->streetName}}</a></div>
                            <div class="property-address">{{$prop->locality.", ".$prop->city}}</div>
                            <div class="property-interested-numbers">Interested members : 10</div>
                        </div>
                        <div class="property-footer">Details: {{Auth::user()->email}}, {{Auth::user()->contact}}, {{Auth::user()->name}}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif

@endsection