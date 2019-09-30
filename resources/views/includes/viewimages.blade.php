@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/image.js') }}"></script>
    @if (isset(Auth::user()->email))
        @if(session('delete'))
            <div class="alert alert-success" role="alert">
            <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> Image deleted successfully. {{session('delete')}}
        </div>
        @endif
            <div class="delete-modal">
                <div class="modal-content">
                    <div>Are you sure you want to delete this image?</div>
                    <form class="delete-props" method="POST" action="{{route('deleteimage')}}" >
                        @csrf
                        <input type="number" id="delete-prop" name="id" hidden>
                        <input type="text" id="image-name" name="image" hidden>
                        <button type="submit">Yes</button>
                        <div class="cancel" onclick="closeModal()">No</div>
                    </form>
                </div>
            </div>
            <div class="images-container">
                @foreach($images as $image)
                @if($image != "" && $image != "noimage.png")
                    <div class="image-card">
                        <img src="/storage/{{$propid}}/{{$image}}">
                        <img src="/images/viewprops/close.svg"  class="closeimg" onclick="showModal(event, {{$propid}}, '{{$image}}')">
                    </div>
                @endif
                @endforeach
            </div>
    @endif

@endsection