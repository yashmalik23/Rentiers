@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/user.js') }}"></script>
    @if (isset(Auth::user()->email))
        @if(Auth::user()->email != "inforentiers@gmail.com")
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
            <div class="user-account">
                <div class="user-properties">
                    @foreach($props as $prop)
                    <div class="property-card" onclick="">
                        <img class="card-image-circle" src="{{asset('images/home/picture.png')}}"/>
                        <div class="property-actions">
                            <a href="useraccountedit/{{$prop->id}}"><img class="card-image-edit" src="{{asset('images/viewprops/edit.svg')}}"/></a>
                            <img class="card-image-cancel" src="{{asset('images/viewprops/close.svg')}}" onclick="showModal(event, {{$prop->id}})" >
                        </div>
                        <div class="property-details">
                            <div class="property-title"><a href="useraccount/{{$prop->id}}">{{$prop->streetName}}</a></div>
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