<!-- Created by UserId -->
{{Form::hidden('user_id', $user->id)}}
<!-- Current User ID -->
{{Form::hidden('current_user_id', $user->id)}}
<!-- Currency hard-coded to AED -->
{{Form::hidden('currency', 'AED')}}
<!-- Attributes: //Todo: add to form as input -->
{{--{{Form::hidden('attributes', '') }}--}}
{{Form::hidden('remarks', '', ['id'=>'remarks'])}}



	<div class="steps-progress">
		<div class="progress-indicator"></div>
	</div>

	<ul>
		<li class="active">
			<a href="#tab2-1" data-toggle="tab"><span>1</span>Basic Info</a>
		</li>
		<li>
			<a href="#tab2-2" data-toggle="tab"><span>2</span>Description</a>
		</li>
		<li>
			<a href="#tab2-3" data-toggle="tab"><span>3</span>Product Photos</a>
		</li>
		<li>
			<a href="#tab2-4" data-toggle="tab"><span>4</span>File Attachments</a>
		</li>
		<li>
			<a href="#tab2-5" data-toggle="tab"><span>5</span>Attributes</a>
		</li>
		<li>
			<a href="#tab2-6" data-toggle="tab"><span>6</span>Assign</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="tab2-1">

		<div class="row">
            <h3>Basic Product Information</h3>
            <br />
            <br />
        </div>

        <div class="well">
            <div class="row">
                @if($user->hasAccess('cataloguing.products.admin'))
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="full_name">Customer</label>
                            {{ Form::select('company_id', $companies, null, ['class'=>'form-control', 'id'=>'company_id', 'data-validate' => 'required']) }}
                        </div>
                    </div>
                @else
                    <!-- Owned by CompanyID -->
                    {{Form::hidden('company_id', $user->company->id)}}
                @endif

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="supplier_id">Supplier</label>
                        {{ Form::select('supplier_id', $suppliers, null, ['class'=>'form-control', 'id'=>'supplier_id']) }}
                        {{ $errors->first('supplier_id', '<p class="error-label"><span class="label label-danger">:message</span></p>') }}
                    </div>
                </div>

            </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="code">Code</label>
                            {{ Form::text('code', null, ['class' => 'form-control step1', 'id' => 'code', 'data-validate' => 'required', 'placeholder' => 'Item Code, Product Code, or SKU']) }}
                            {{ $errors->first('code', '<p class="error-label"><span class="label label-danger">:message</span></p>') }}
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="control-label" for="name">Name</label>
                            {{ Form::text('name', null, ['class' => 'form-control','id' => 'name', 'data-validate' => 'required', 'placeholder' => 'Name as it shall be cataloged in the portal']) }}
                            {{ $errors->first('name', '<p class="error-label"><span class="label label-danger">:message</span></p>') }}
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="category">Category</label>
                            {{ Form::text('category', null, ['class'=>'form-control','id'=>'category','placeholder'=>'Category that this product should be classified in']) }}
                            {{ $errors->first('category', '<p class="error-label"><span class="label label-danger">:message</span></p>') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="uom">UOM</label>
                            {{ Form::text('uom', null, ['class'=>'form-control','id'=>'uom','placeholder'=>'e.g. Each, Pack, Carton']) }}
                            {{ $errors->first('uom', '<p class="error-label"><span class="label label-danger">:message</span></p>') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Price</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span>AED</span>
                                </div>
                                {{ Form::text('price', null, ['class'=>'form-control','id'=>'price','data-validate'=>'number']) }}
                            </div>
                                {{ $errors->first('price', '<p class="error-label"><span class="label label-danger">:message</span></p>') }}
                        </div>
                    </div>

                </div>
            </div>

		</div>

		<div class="tab-pane" id="tab2-2">

            <div class="row">
                <h2>Product Description <small>(see example) &rightarrow;</small> <a href="{{URL::asset('images/product-description-sample.png')}}" target="_blank"><img src="{{URL::asset('images/product-description-sample.png')}}" width="70" style="border:1px solid #DDDDDD;"></a></h2>
                <br />
                <br />
            </div>

            <div class="well">
                {{ $errors->first('short_description', '<span class="label label-danger">:message</span>') }}
                <h3>Short Description</h3>
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <p style="font-size: 16px;" class="text text-info">Provide a short one or two line product description.</p>
                            <textarea class="form-control" name="short_description" id="short_description" rows="5" placeholder="Short summary of the product">{{{ Input::old('short_description') ? Input::old('short_description') : '' }}}</textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="well">
                {{ $errors->first('description', '<span class="label label-danger">:message</span>') }}
                <h3>Full Description</h3>
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <p style="font-size: 16px;" class="text text-info">Here is where you list the full product details. Be as descriptive as possible. Format the description as you wish it to appear on the portal.</p>
                            <textarea class="form-control ckeditor" name="description" id="description">{{{ Input::old('description') ? Input::old('description') : '' }}}</textarea>

                        </div>
                    </div>

                </div>

            </div>



		</div>

		<div class="tab-pane" id="tab2-3">

            <div class="row">
                <h3>Product Photos <small>512Kb max file size per photo</small></h3>
                <br />
            </div>

            <div class="well">

                <div class="row">

                    <!-- Add new Images -->
                    {{ Form::label('images', 'Main:', ['class' => 'col-sm-1 control-label text-right']) }}
                    <div id="image-div0" class="form-group col-md-2">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;" data-trigger="fileinput">
                                <img src="http://placehold.it/150&text=Product+photo" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-info btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="image1" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                        {{ $errors->first('image1', '<span class="label label-danger">:message</span><br/><br/>') }}
                    </div>

                    {{ Form::label('images', 'Secondary:', ['class' => 'col-sm-1 control-label text-right']) }}
                    <div id="image-div1" class="form-group col-md-2">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;" data-trigger="fileinput">
                                <img src="http://placehold.it/150&text=Product+photo" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-info btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="image2" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>



                    {{ Form::label('images', 'Front:', ['class' => 'col-sm-1 control-label text-right']) }}
                    <div id="image-div2" class="form-group col-md-2">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;" data-trigger="fileinput">
                                <img src="http://placehold.it/150&text=Product+photo" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-info btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="image3" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>


                    {{ Form::label('images', 'Back:', ['class' => 'col-sm-1 control-label text-right']) }}
                    <div id="image-div3" class="form-group col-md-2">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;" data-trigger="fileinput">
                                <img src="http://placehold.it/150&text=Product+photo" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-info btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="image4" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

		</div>

		<div class="tab-pane" id="tab2-4">

			<div class="row">
                <h3>File Attachments <small>2MB max file size per attachment</small></h3>
                <br />
            </div>
            <div class="well" style="min-height: 200px;">
                <div id="attachment-div" class="row">
                    <div class="row">
                        <div  class="form-group">
                            <div class="col-md-6 col-md-offset-1">
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
                    </div>

                </div>

                <div class="row">

                    <div id="dynamicAttachmentInput">
                    </div>

                </div>
            </div>

            <div class="row">

                <div class="form-group">
                    <div class="col-md-3">
                        <input id="add-image-input" type="button" class="btn btn-success" value="+ File" onClick="addAttachmentInput('dynamicAttachmentInput');">
                    </div>
                </div>

            </div>

		</div>

		<div class="tab-pane" id="tab2-5">

			<div class="row">
                <h3>Product Attributes</h3>
                <br />
                <p style="font-size: 16px">You can define additional product attributes to help define the product more specifically. Attributes
                you define here will be included with the product details that are uploaded to the portal. Attributes
                help users find locate and identify products by their key product characteristics.</p>
                <br/>
            </div>
			<div class="row">

                {{-- Attributes --}}


            @if($customAttributes)
                @include('product-definitions.partials._' . $customAttributes . '-attributes');
            @else
                <input id="add-attribute" type="button" class="btn btn-success" value="+ add Attribute" > <span id="attribute-helper" style="display: none"><em>&leftarrow; Click to add more attributes</em></span><br/><br/>
                <div id="new-attributes" class="well" style="min-height: 200px;">
                </div>
            @endif


			</div>

		</div>

		<div class="tab-pane" id="tab2-6">

			<div class="row">
                <h3>Review & Assign</h3>
                <br />
                <p style="font-size: 16px;">Good job!</p>
                <p style="font-size: 16px;">You're nearly done. If you wish to review the form, you can do by clicking
                on the <label class="label label-default">&lt; Previous</label> button below, or by clicking any of the step numbers listed above to go to that specific section.</p>
                <p style="font-size: 16px;">Once you are finished reviewing and have ensured that all the required
                fields have been completed, you can submit your cataloguing request now for processing by 36S. Alternatively,
                you can save it as a draft and come back later to complete it.</p>
            </div>
            <div id="div-remarks" class="row">
                <div class="col-md-8">
                    {{ $errors->first('remarks', '<span class="label label-danger">:message</span>') }}
                    <h3>Remarks</h3>
                    <div class="form-group">
                        <p>Add any remarks or comments you have here.</p>
                        <textarea class="form-control" name="remarks" id="remarks" rows="3"></textarea>
                    </div>
                </div>
            </div>
			<br/>
			<br/>

			<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <button id="save" type="submit" class="btn btn-info">Save Draft</button>
                        @if($user->hasAccess('cataloguing.products.catalogue'))
                            <button id="assign-to-customer" type="submit" class="btn btn-primary">Assign to Customer</button>
                            <button id="assign-to-supplier" type="submit" class="btn btn-gold">Assign to Supplier</button>
                        @else
                            @if($user->hasAccess('cataloguing.products.submit'))
                                <button id="submit" type="submit" class="btn btn-primary">Submit Now</button>
                            @endif
                        @endif
                        @if($user->hasAccess('cataloguing.products.catalogue'))
                            <button id="process" type="submit" class="btn btn-green">Submit for Processing</button>
                        @endif

                    </div>
                </div>
                <div class="col-md-2 pull-left">
                    <div class="form-group">
                        {{ link_to_route('catalogue.product-definitions.index', 'Cancel', null, array('class'=>'btn btn-danger')) }}
                    </div>
                </div>

            </div>
            {{Form::hidden('action', '', ['id'=>'action'])}}
            {{Form::hidden('status', '', ['id'=>'status'])}}


		</div>

		<ul class="pager wizard">
			<li class="previous">
				<a href="#"><i class="entypo-left-open"></i> Previous</a>
			</li>

            <li class="pull-right">
                <div class="" style="margin-left:20px;">
                    {{ link_to_route('catalogue.product-definitions.index', 'Cancel', null, array('class'=>'btn btn-default pull-right')) }}
                </div>
            </li>

			<li class="next">
				<a href="#">Next <i class="entypo-right-open"></i></a>
			</li>
		</ul>
	</div>


<script type="text/javascript">

(function() {

    $('#save').click(function(){
        $("#action").val('save');
        $("#status").val(1);
    });

    $('#assign-to-supplier').click(function(){
        $("#action").val('assign-to-supplier');
        $("#status").val(1);
    });

    $('#assign-to-customer').click(function(){
        $("#action").val('assign-to-customer');
        $("#status").val(1);
    });

    $('#submit').click(function(){
        $("#action").val('submit');
        $("#status").val(2);
    });

    $('#process').click(function(){
        $("#action").val('process');
        $("#status").val(3);
    });


    var attributeSerial = 1; // serial to append to new element id
    var attributeCounter = 0; // current count/index of image
    var attributeLimit = 10;

    $('#add-attribute').click(function(){
        if ((attributeCounter) == attributeLimit)  {
             alert("You have reached the limit of adding " + attributeLimit + " attributes");
        }
        else {
             // add attribute name input
             var newdiv = document.createElement('div');
             var attnameid = 'attribute-name' + attributeSerial;
             var attvalueid = 'attribute-value' + attributeSerial;
             var inner = "<div class='col-md-1'>"
                + "<label class='control-label'>&nbsp;</label>"
                 + "<p class='text-right'><span class='label label-info'>" + attributeSerial + "</span></p>"
                 + "</div>"
                 + "<div class='col-md-3'>"
                 + "<div class='form-group'>"
                 + "<label class='control-label' for='" + attnameid + "'>Name</label>";
                 if(attributeSerial === 1){
                    inner += "<input id='" + attnameid + "' name='" + attnameid + "' class='form-control' placeholder='e.g. Color, Size, Material' />"
                 } else {
                    inner += "<input id='" + attnameid + "' name='" + attnameid + "' class='form-control' />"
                 }
             inner += "</div></div>"
                 + "<div class='col-md-6'>"
                 + "<div class='form-group'>"
                 + "<label class='control-label' for='" + attvalueid + "'>Value</label>";

                 if(attributeSerial === 1){
                     inner += "<input id='" + attvalueid + "' name='" + attvalueid + "' class='form-control' placeholder='e.g. White, Large, Steel' />"
                  } else {
                     inner += "<input id='" + attvalueid + "' name='" + attvalueid + "' class='form-control' />"
                  }
             inner += "</div></div>";

             newdiv.innerHTML = inner;
             document.getElementById('new-attributes').appendChild(newdiv);
             newdiv.className = 'row';
             var bttn = document.getElementById('attribute-helper');
             bttn.style.display = 'inline';

             // increment counters
             attributeSerial++;
             attributeCounter++;
             console.log(attributeSerial);
             console.log(attributeCounter);
        }
    });

    $(document).ready(function() {




// Had to disable below validation function because it was breaking the overall validation process
// Need to look into how to add CKeditor validation using JQuery-validate.js


//        $("#rootwizard-2").validate(
//        {
//          ignore: [],
//          debug: false,
//            rules: {
//
//                description:{
//                     required: function()
//                    {
//                     CKEDITOR.instances.description.updateElement();
//                    },
//
//                     minlength:10
//                }
//            },
//            messages:
//                {
//
//                description:{
//                    required:"Please enter Text",
//                    minlength:"Please enter 10 characters"
//
//
//                }
//            }
//        });


        var cust = $("#company_id").val();
        console.log(cust);
        if(typeof cust !== "undefined" && cust !== ''){
            updateSupplierList();
        }
        function updateSupplierList()
        {
            var $supplierSelect = $("#supplier_id");
            $supplierSelect.empty();
            $.getJSON("../cataloguing/suppliers/" + $("#company_id").val(), function(data) {
                $supplierSelect.append('<option value="">[Select]</option>');
                $.each(data, function(index, value) {
                    $supplierSelect.append('<option value="' + index +'">' + value + '</option>');
                });
            });
        }


        // Populate Assigned User select based on Supplier selection
        $("#supplier_id").change(function() {
            var $userSelect = $("#assigned_user_id");
            $userSelect.empty();
            var supplier = $("#supplier_id").val();
            if(supplier )
            $.getJSON("../cataloguing/supplier-users/" + $("#company_id").val() + '/' + $("#supplier_id").val(), function(data) {
                for (var company in data) {
                  if (data.hasOwnProperty(company)) {
                    $userSelect.append('<optgroup label="' + company + '">');

                    for (var key in data[company]) {
                      if (data[company].hasOwnProperty(key)) {
                        $userSelect.append('<option value="' + key +'">' + data[company][key] + '</option>');
                      }
                    }
                  }
                }
            });

        });

        // Populate Assigned User and Supplier select based on customer selection
        $("#company_id").change(function() {
//            var $userSelect = $("#assigned_user_id");
//            $userSelect.empty();
//            $.getJSON("../cataloguing/customer-users/" + $("#company_id").val(), function(data) {
//                for (var company in data) {
//                  if (data.hasOwnProperty(company)) {
//                    $userSelect.append('<optgroup label="' + company + '">');
//
//                    for (var key in data[company]) {
//                      if (data[company].hasOwnProperty(key)) {
//                        $userSelect.append('<option value="' + key +'">' + data[company][key] + '</option>');
//                      }
//                    }
//                  }
//                }
//            });

            updateSupplierList();

//            var $supplierSelect = $("#supplier_id");
//            $supplierSelect.empty();
//            $.getJSON("../cataloguing/suppliers/" + $("#company_id").val(), function(data) {
//                $supplierSelect.append('<option value="">[Select]</option>');
//                $.each(data, function(index, value) {
//                    $supplierSelect.append('<option value="' + index +'">' + value + '</option>');
//                });
//            });
        });

        $("#clear-images").click(function(event){
          event.preventDefault();
          $("#images").replaceWith("<input type='file' id='images' name='images[]' multiple />");
        });
    });

})();
</script>

<script type="text/javascript">

    Element.prototype.remove = function() {
        this.parentElement.removeChild(this);
    }
    NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
        for(var i = 0, len = this.length; i < len; i++) {
            if(this[i] && this[i].parentElement) {
                this[i].parentElement.removeChild(this[i]);
            }
        }
    }

    $("a.detach-image").click(function(e){
          e.preventDefault();
          var confirmdelete = confirm("Are you sure to want to delete this image?");
          if (confirmdelete ==true) {
              var $id = $(this).attr('imageid');
              document.getElementById('image'+$id).style.display = 'none';
              document.getElementById('image'+$id).remove();
              $.getJSON("/images/" + $id + "/delete",function(result){});
          }
    });

    $("a.detach-attachment").click(function(e){
          e.preventDefault();
          var confirmdelete = confirm("Are you sure to want to delete this file?");
          if (confirmdelete ==true) {
              var $id = $(this).attr('attachmentid');
              document.getElementById('attachment'+$id).style.display = 'none';
              document.getElementById('attachment'+$id).remove();
              $.getJSON("/attachments/" + $id + "/delete",function(result){});
          }
    });

    var imageSerial = 1; // serial to append to new element id
    var imageCounter = 0; // current count/index of image
    var imageLimit = 5; // max amount of images allowed
    var attachmentSerial = 1; // serial to append to new element id
    var attachmentCounter = 0; // current count/index of image
    var attachmentLimit = 5; // max amount of images allowed

    function addAttachmentInput(divName){
        if ((attachmentCounter + 1) == attachmentLimit)  {
            alert("You have reached the limit of adding " + attachmentLimit + " file attachments");
        }
        else {
            var newdiv = document.createElement('div');
            var divId = 'attachment-div' + attachmentSerial;
            var inner = "<div class='form-group'>"
                + "<div class='col-md-6 col-md-offset-1'>"
                + "<div class='fileinput fileinput-new' data-provides='fileinput'>"
                + "<span class='btn btn-info btn-file'>"
                + "<span class='fileinput-new'>Select file</span><span class='fileinput-exists'>Change</span><input type='file' name='attachments[]'></span> "
                + "<span class='fileinput-filename'></span>"
                + "<a href='#' class='close fileinput-exists' data-dismiss='fileinput' style='float: none'>&times;</a>"
                + "</div></div></div>";
            newdiv.innerHTML = inner;
            document.getElementById(divName).appendChild(newdiv);
            newdiv.className = 'row';
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


<!-- Bottom Scripts -->


<link rel="stylesheet" href="{{URL::asset('js/selectboxit/jquery.selectBoxIt.css')}}">

<script src="{{ URL::asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ URL::asset('js/ckeditor/adapters/jquery.js') }}"></script>
<script src="{{ URL::asset('js/fileinput.js') }}"></script>
<script src="{{ URL::asset('js/joinable.js') }}"></script>
<script src="{{ URL::asset('js/resizeable.js') }}"></script>
<script src="{{ URL::asset('js/jquery.bootstrap.wizard.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ URL::asset('js/jselectboxit/jquery.selectBoxIt.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-switch.js') }}"></script>
<script src="{{ URL::asset('js/jquery.multi-select.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-tour/build/js/bootstrap-tour.min.js') }}"></script>