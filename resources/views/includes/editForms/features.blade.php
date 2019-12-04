<div id="form-5">
    <script type="text/javascript" src="{{asset('js/listProps/features.js') }}"></script>
    <div class="list-form-heading">Customers want to know everything they can</div>
    <div class="field-inputs">
        <div class="line-4">
            <div class="list-form-check-field" id="ameneties">
                <div class="check-field-label">Amenities</div>
                @for ($i = 0; $i < count(str_split($prop->ameneties)); $i++)
                    @if(str_split($prop->ameneties)[$i]== "1")
                        <div class="check-option">
                            <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">{{$ameneties[$i+14-count(str_split($prop->ameneties))]}}</div>
                        </div>
                    @else
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">{{$ameneties[$i+14-count(str_split($prop->ameneties))]}}</div>
                        </div>
                    @endif
                @endfor  
            </div>
        </div>
        <div class="line-4">
            <div class="list-form-check-field" id="closeTo">
                <div class="check-field-label">Close To</div>
                @for ($i = 0; $i < count(str_split($prop->closeTo)); $i++)
                    @if(str_split($prop->closeTo)[$i]== "1")
                        <div class="check-option">
                            <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">{{$closeTo[$i+7-count(str_split($prop->closeTo))]}}</div>
                        </div>
                    @else
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">{{$closeTo[$i+7-count(str_split($prop->closeTo))]}}</div>
                        </div>
                    @endif
                @endfor  
            </div>
        </div>
        <div class="line-4">
            <div class="list-form-check-field" id="tenant">
                <div class="check-field-label">Tenant Preferences *</div>
                @for ($i = 0; $i < count(str_split($prop->tenant)); $i++)
                    @if(str_split($prop->tenant)[$i]== "1")
                        <div class="check-option">
                            <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">{{$tenant[$i+8-count(str_split($prop->tenant))]}}</div>
                        </div>
                    @else
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">{{$tenant[$i+8-count(str_split($prop->tenant))]}}</div>
                        </div>
                    @endif
                @endfor  
            </div>
        </div>
        <div class="line-4">
                    @if(count(explode(",",$prop->ownerdetails))>2)
                        <div class="list-input-field">
                            <label for="ownerDetails1">Owner's name *</label>
                            <input id="ownerDetails1" class="list-form-input" value="{{explode(",",$prop->ownerdetails)[0]}}" name="ownerDetails1" >
                        </div>
                        <div class="list-input-field">
                            <label for="ownerDetails2">Owner's email *  </label>
                            <input id="ownerDetails2" class="list-form-input" value="{{explode(",",$prop->ownerdetails)[1]}}" name="ownerDetails2" >
                        </div>
                        <div class="list-input-field">
                            <label for="ownerDetails3">Owner's contact* </label>
                            <input id="ownerDetails3" class="list-form-input" value="{{explode(",",$prop->ownerdetails)[2]}}" name="ownerDetails3" >
                        </div>
                    @else
                        <div class="list-input-field">
                            <label for="ownerDetails1">Owner's name *</label>
                            <input id="ownerDetails1" class="list-form-input" placeholder="Name" name="ownerDetails1" >
                        </div>
                        <div class="list-input-field">
                            <label for="ownerDetails2">Owner's email *  </label>
                            <input id="ownerDetails2" class="list-form-input" placeholder="Email" name="ownerDetails2" >
                        </div>
                        <div class="list-input-field">
                            <label for="ownerDetails3">Owner's contact* </label>
                            <input id="ownerDetails3" class="list-form-input" placeholder="contact" name="ownerDetails3" >
                        </div>
                    @endif
        </div>
    </div>
    <input name="ameneties" type="text" id="ameneties-hidden" hidden>
    <input name="closeTo" type="text" id="closeTo-hidden" hidden>
    <input name="ownerDetails" type="text" id="ownerss-hidden" hidden>
    <input name="includeTaxes" type="text" id="includeTaxes-hidden" hidden>
    <input name="tenant" type="text" id="tenant-hidden" hidden>
    <input name="inUse" type="text" value="0" id="inUse-hidden" hidden>
    <div class="list-previous-button" onclick="previous4Form()">Previous</div>
</div>