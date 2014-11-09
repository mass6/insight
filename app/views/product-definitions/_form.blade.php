<!-- Created by UserId -->
{{Form::hidden('user_id', $user->id)}}
<!-- Owned by CompanyID -->
{{Form::hidden('company_id', $user->company->id)}}
<!-- Currency hard-coded to AED -->
{{Form::hidden('currency', 'AED')}}
<!-- Attributes: //Todo: add to form as input -->
{{Form::hidden('attributes', '') }}

<!-- Code  -->
<div class="form-group">
    {{ Form::label('code', 'Product Code:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('code', '555', ['class' => 'form-control step1', 'id' => 'code', 'required', 'placeholder' => 'Item Code, Product Code, or SKU']) }}
    </div>
</div>

<!-- Name -->
<div class="form-group">
    {{ Form::label('name', 'Name:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('name', 'bread', ['class' => 'form-control', 'required', 'placeholder' => 'Name as it shall be cataloged in the portal']) }}
    </div>
</div>

<!-- Category -->
<div class="form-group">
    {{ Form::label('category', 'Category:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('category', null, ['class' => 'form-control', 'placeholder' => 'Category that this product should be classified in.']) }}
    </div>
</div>

<!-- Uom -->
<div class="form-group">
    {{ Form::label('uom', 'UOM:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('uom', null, ['class' => 'form-control', 'id' => 'uom', 'placeholder' => 'e.g. Each, Pack, Carton']) }}
    </div>
</div>

<!-- Price -->
<div class="form-group">
    {{ Form::label('price', 'Price per UOM:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        <div class="input-group">
            <span class="input-group-addon">AED</span>
            {{ Form::text('price', null, ['class' => 'form-control']) }}
            <span class="input-group-addon">.00</span>
        </div>
    </div>
</div>

<!-- Description -->
<div class="form-group">
    <label for="field-ta" class="col-sm-3 control-label">Description</label>
    <div class="col-sm-7">
        <textarea class="form-control ckeditor" name="description">{{{ Input::old('description') ? Input::old('description') : (isset($product) ? $product->description : '') }}} </textarea>
    </div>
</div>

<!-- Images -->
{{--<div class="form-group">--}}
    {{--{{ Form::label('images', 'Product Images:', ['class' => 'col-sm-3 control-label']) }}--}}
    {{--<div class="col-sm-5">--}}
        {{--{{ Form::file('images[]', ['images', 'class'=>'form-control file2 inline btn btn-info', 'multiple', 'data-label' =>"<i class='glyphicon glyphicon-picture'></i> Browse images..." ]) }}--}}
    {{--<button id="clear-images">clear</button>--}}
    {{--</div>--}}
{{--</div>--}}

<!-- Images -->
<div id="image-div0" class="form-group">
    {{ Form::label('images', 'Product Images:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">

        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;" data-trigger="fileinput">
                <img src="http://placehold.it/150&text=Product+photo" alt="...">
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
            <div>
                <span class="btn btn-info btn-file">
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="images[]" accept="image/*">
                </span>
                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
            </div>
        </div>

    </div>
</div>

<div id="dynamicImageInput">
</div>

<div class="form-group">
    <div class="col-sm-offset-2">
        <input id="add-image-input" type="button" class="btn btn-success" value="+ image" onClick="addImageInput('dynamicImageInput');">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Product Attachments</label>
    <div class="col-sm-5">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <span class="btn btn-info btn-file">
                <span class="fileinput-new">Select file</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="attachments[]" />
            </span>
            <span class="fileinput-filename"></span>
            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
        </div>
    </div>
</div>

<div id="dynamicAttachmentInput">
</div>

<div class="form-group">
    <div class="col-sm-offset-2">
        <input id="add-image-input" type="button" class="btn btn-success" value="+ file" onClick="addAttachmentInput('dynamicAttachmentInput');">
    </div>
</div>






<script type="text/javascript">
    var imageSerial = 1;
    var imageCounter = 0; // current count/index of image
    var imageLimit = 5; // max amount of images allowed
    var attachmentSerial = 1;
    var attachmentCounter = 0; // current count/index of image
    var attachmentLimit = 5; // max amount of images allowed

    function addAttachmentInput(divName){
        if ((attachmentCounter + 1) == attachmentLimit)  {
            alert("You have reached the limit of adding " + attachmentLimit + " images");
        }
        else {
            var newdiv = document.createElement('div');
            var divId = 'image-div' + attachmentSerial;
            var inner = "<label class='col-sm-3 control-label'>&nbsp;</label>"
                + "<div class='col-sm-5'>"
                + "<div class='fileinput fileinput-new' data-provides='fileinput'>"
                + "<span class='btn btn-info btn-file'>"
                + "<span class='fileinput-new'>Select file</span><span class='fileinput-exists'>Change</span><input type='file' name='attachments[]'></span> "
                + "<span class='fileinput-filename'></span>"
                + "<a href='#' class='close fileinput-exists' data-dismiss='fileinput' style='float: none'>&times;</a>"
                + "</div></div>";
            newdiv.innerHTML = inner;
            document.getElementById(divName).appendChild(newdiv);
            newdiv.className = 'form-group';
            newdiv.id = divId;
            attachmentSerial++;
            attachmentCounter++;
        }
    }

    function addImageInput(divName){
        if ((imageCounter + 1) == imageLimit)  {
            alert("You have reached the limit of adding " + imageLimit + " images");
        }
        else {
            var newdiv = document.createElement('div');
            var divId = 'image-div' + imageSerial;
            var inner = "<label class='col-sm-3 control-label'>&nbsp;</label>"
                + "<div class='col-sm-5'>"
                + "<div class='fileinput fileinput-new' data-provides='fileinput'>"
                + "<div class='fileinput-new thumbnail' style='width: 150px; height: 150px;' data-trigger='fileinput'>"
                + "<img src='http://placehold.it/150&text=Product+photo' alt='...'></div>"
                + "<div class='fileinput-preview fileinput-exists thumbnail' style='max-width: 200px; max-height: 150px'></div>"
                + "<div><span class='btn btn-info btn-file'>"
                + "<span class='fileinput-new'>Select image</span><span class='fileinput-exists'>Change</span><input type='file' name='images[]' accept='image/*'></span> "
                + "<input type='button' class='btn btn-orange' value='Remove' onclick='deleteInput(\"" + divId + "\")' >"
                + "</div></div></div>";
            newdiv.innerHTML = inner;
            document.getElementById(divName).appendChild(newdiv);
            newdiv.className = 'form-group';
            newdiv.id = divId;
            imageSerial++;
            imageCounter++;
        }
    }

    function deleteInput(id){
        var elem = document.getElementById(id);
        elem.parentNode.removeChild(elem);
        counter--;
    }

</script>
{{--<div class="form-group">--}}
    {{--<input type="button" class="btn btn-info btn-sm" value="Add additional immage" onClick="addInput('dynamicInput');">--}}
    {{--<hr/>--}}
{{--</div>--}}

<!-- Remarks -->
<div class="form-group">
    {{ Form::label('remarks', 'Remarks:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-7">
        <textarea class="form-control" name="remarks"></textarea>
    </div>
</div>

<!-- Supplier -->
<div class="form-group">
    {{ Form::label('supplier_id', 'Supplier:', ['class' =>'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::select('supplier_id', $suppliers, null, ['class'=>'form-control', 'id'=>'supplier_id']) }}
    </div>
</div>

<!-- Assigned To -->
<div class="form-group">
    {{ Form::label('assigned_user_id', 'Assigned To:', ['class' =>'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{--<select id="assigned_user_id" name="assigned_user_id" class="form-control">--}}

        {{--</select>--}}
        {{ Form::select('assigned_user_id', $assignableUsersList, null, ['class'=>'form-control', 'id'=>'assigned_user_id']) }}
    </div>
</div>

<!-- Status -->
<div class="form-group">
    {{ Form::label('status', 'Status:', ['class' =>'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::select('status', $statuses, null, ['class'=>'form-control', 'id'=>'status']) }}
    </div>
</div>

<!-- Buttons -->
<div class="form-group">
    {{ Form::label('', '', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        <!-- Submit button -->
        {{ Form::submit(isset($submit)?$submit:'Submit', ['class' => 'form-control btn btn-primary']) }}
        <!-- Cancel button -->
        {{ link_to_route('admin.companies.index', 'Cancel', null, array('class'=>'form-control btn btn-warning')) }}
    </div>
</div>



<script type="text/javascript">

    $(document).ready(function() {
    // Populate Assigned User select based on Supplier selection
        $("#supplier_id").change(function() {
            var $userSelect = $("#assigned_user_id");
            $userSelect.empty();
            $.getJSON("../suppliers/" + $("#supplier_id").val(), function(data) {
                $.each(data, function(index, value) {
                    $userSelect.append('<option value="' + index +'">' + value + '</option>');
                });
            $("#assigned_user_id").trigger("change"); /* trigger next drop down list not in the example */
            });
        });

    // Page Tour
        // Instanciate the tour
        var tour = new Tour({
            name: "product_definitions_tour",
            debug: "true",
            steps: [
                {
                    element: "#tour-intro",
                    title: "Welcome",
                    content: "Content of code step",
                    placement: "right",
                    orphan: true,
                    backdrop: true
                },
                {
                    element: "#code",
                    title: "Title of code step",
                    content: "Content of code step",
                    placement: "right"
                },
                {
                    element: "#uom",
                    title: "Title of my step",
                    content: "Content of my step"
                }
          ]
        });

        // Initialize the tour
        tour.init();

        // Start the tour
        tour.start();

        // Restart tour button
        $('#help').click(function(e){
            tour.restart();
            e.preventDefault();
        });

        $("#clear-images").click(function(event){
          event.preventDefault();
          $("#images").replaceWith("<input type='file' id='images' name='images[]' multiple />");
        });
    });

</script>

<!-- Bottom Scripts -->


<script src="{{ URL::asset('js/fileinput.js') }}"></script>
<script src="{{ URL::asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ URL::asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-tour/build/js/bootstrap-tour.min.js') }}"></script>