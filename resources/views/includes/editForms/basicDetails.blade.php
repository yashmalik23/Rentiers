<div id="form-1">
    <script type="text/javascript" src="{{asset('js/editProps/basicDetails.js') }}"></script>
    <div class="list-form-heading">Let's get Started!</div>
    <div class="field-inputs">
        <input name="postedBy" type="text" hidden value="{{$prop->postedBy}}">
        <div class="line-3">
            <input name="listedFor" type="text" hidden value="{{$prop->listedFor}}">
            <input name="propertyType" type="text" hidden value="{{$prop->propertyType}}" id="propertyType">
        </div>
        <div class="line-4">
            <input name="propertySecondType" type="text" hidden value="{{$prop->propertySecondType}}">
        </div>
        <div class="line-4">
            <input name="propertyThirdType" type="text" hidden value="{{$prop->propertyThirdType}}">
        </div>
        <div class="line-4">
            <input name="multipleUnits" type="text" hidden value="{{$prop->multipleUnits}}">
        </div>
    </div>
</div>