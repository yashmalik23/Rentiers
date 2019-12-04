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
            <div class="frontalert alert-danger" id="frontalert">
                Wrong details
            </div>
            <div class="order-heading">Order of images</div>
            <div class="order-sub-title">Type the position separated by commas to change the order of images. Include all the images to proceed further</div>
            <form method="POST" class="order-images" action={{route('changeorder')}}>
                @csrf
                <input type="text" hidden value="{{$propid}}" name='id'>
                <input type="text" value='' placeholder='1,4,3,2' name="image"/> 
                <div class="submit-order" onclick="checkOrder(event, {{ count($images)}})">Change</div>
                <button type='submit' id='change-order-images' hidden></button>
            </form>
            <div class="images-container">
                @for($i=0;$i< count($images)-1;$i++)
                    @if($images[$i] != "" && $images[$i] != "noimage.png")
                        <div class="image-card">
                            <img src="/storage/{{$propid}}/{{$images[$i]}}">
                            <img src="/images/viewprops/close.png"  class="closeimg" onclick="showIModal(event, {{$propid}}, '{{$images[$i]}}')">
                            <div class="image-number">Image number - {{$i+1}}</div>
                        </div>
                    @endif
                @endfor
            </div>
    @endif

@endsection