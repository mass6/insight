<div id="attributes">
    <!-- Panel Group -->
    <div class="col-md-12">

            <div class="panel-group joined" id="accordion-test-2">

                <div id="panel-manufacturing" class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2">
                                Manufacturing Details <small>click to expand</small>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne-2" class="panel-collapse collapse in">
                        <!-- panel body -->
                        <div class="panel-body">

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('Brand')}}
                                        {{Form::hidden('attribute-name-brand', 'Brand')}}
                                        {{Form::text('attribute-value-brand', null, ['class'=>'form-control', 'id'=>'attribute-value-brand']) }}
                                        {{ $errors->first('attribute-value-brand', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('HS Code')}}
                                        {{Form::hidden('attribute-name-hscode', 'HS Code')}}
                                        {{Form::text('attribute-value-hscode', null, ['class'=>'form-control', 'id'=>'attribute-value-hscode']) }}
                                        {{ $errors->first('attribute-value-hscode', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Barcode Number (case)')}}
                                        {{Form::hidden('attribute-name-barcodenumbercase', 'Barcode Number Case')}}
                                        {{Form::text('attribute-value-barcodenumbercase', null, ['class'=>'form-control', 'id'=>'attribute-value-barcodenumbercase']) }}
                                        {{ $errors->first('attribute-value-barcodenumbercase', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('Country of Manufacture')}}
                                        {{Form::hidden('attribute-name-countryofmanufacture', 'Country of Manufacture')}}
                                        {{Form::select('attribute-value-countryofmanufacture', getCountries(), Input::old('attribute-value-countryofmanufacture'), ['class'=>'form-control', 'id'=>'attribute-value-countryofmanufacture']) }}
                                        {{ $errors->first('attribute-value-countryofmanufacture', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Lead Time (days)')}}
                                        {{Form::hidden('attribute-name-leadtime', 'Lead Time')}}
                                        {{Form::text('attribute-value-leadtime', null, ['class'=>'form-control', 'id'=>'attribute-value-leadtime','placeholder'=>'From order to loading date']) }}
                                        {{ $errors->first('attribute-value-leadtime', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Barcode Number (individual)')}}
                                        {{Form::hidden('attribute-name-barcodenumberindividual', 'Barcode Number Individual')}}
                                        {{Form::text('attribute-value-barcodenumberindividual', null, ['class'=>'form-control', 'id'=>'attribute-value-barcodenumberindividual']) }}
                                        {{ $errors->first('attribute-value-barcodenumberindividual', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <div id="panel-ingredients" class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed">
                                Ingredients
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo-2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>Here is where you list the product ingredients. Be as detailed as possible.</p>
                                        {{Form::hidden('attribute-name-ingredients', 'Ingredients')}}
                                        <textarea class="form-control" name="attribute-value-ingredients" id="attribute-value-ingredients">{{{ Input::old('attribute-value-ingredients')}}}</textarea>
                                        {{ $errors->first('attribute-value-ingredients', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="panel-nutritional-information" class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed">
                                Nutritional Information
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree-2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h5 class="text text-info">All quantities shall be specified per 100 gram serving.</h5>
                            <br/>

                            <div class="row">
                                <div class="col-md-2">
                                    {{Form::label('Calories')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-calories', 'Calories')}}
                                        {{Form::text('attribute-value-calories', null, ['class'=>'form-control', 'id'=>'attribute-value-calories']) }}
                                        {{ $errors->first('attribute-value-calories', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Calories From Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-caloriesfromfat', 'Calories From Fat')}}
                                        {{Form::text('attribute-value-caloriesfromfat', null, ['class'=>'form-control', 'id'=>'attribute-value-caloriesfromfat']) }}
                                        {{ $errors->first('attribute-value-caloriesfromfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Total Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-totalfat', 'Total Fat')}}
                                        {{Form::text('attribute-value-totalfat', null, ['class'=>'form-control', 'id'=>'attribute-value-totalfat']) }}
                                        {{ $errors->first('attribute-value-totalfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Saturated Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-saturatedfat', 'Saturated Fat')}}
                                        {{Form::text('attribute-value-saturatedfat', null, ['class'=>'form-control', 'id'=>'attribute-value-saturatedfat']) }}
                                        {{ $errors->first('attribute-value-saturatedfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Trans Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-transfat', 'Trans Fat')}}
                                        {{Form::text('attribute-value-transfat', null, ['class'=>'form-control', 'id'=>'attribute-value-transfat']) }}
                                        {{ $errors->first('attribute-value-transfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Cholesterol')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-cholesterol', 'Cholesterol')}}
                                        {{Form::text('attribute-value-cholesterol', null, ['class'=>'form-control', 'id'=>'attribute-value-cholesterol']) }}
                                        {{ $errors->first('attribute-value-cholesterol', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    {{Form::label('Sodium')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-sodium', 'Sodium')}}
                                        {{Form::text('attribute-value-sodium', null, ['class'=>'form-control', 'id'=>'attribute-value-sodium']) }}
                                        {{ $errors->first('attribute-value-sodium', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Total Carbohydrates')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-totalcarbohydrates', 'Total Carbohydrates')}}
                                        {{Form::text('attribute-value-totalcarbohydrates', null, ['class'=>'form-control', 'id'=>'attribute-value-totalcarbohydrates']) }}
                                        {{ $errors->first('attribute-value-totalcarbohydrates', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Dietary Fiber')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-dietaryfiber', 'Dietary Fiber')}}
                                        {{Form::text('attribute-value-dietaryfiber', null, ['class'=>'form-control', 'id'=>'attribute-value-dietaryfiber']) }}
                                        {{ $errors->first('attribute-value-dietaryfiber', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Sugars')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-sugars', 'Sugars')}}
                                        {{Form::text('attribute-value-sugars', null, ['class'=>'form-control', 'id'=>'attribute-value-sugars']) }}
                                        {{ $errors->first('attribute-value-sugars', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Protein')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-protein', 'Protein')}}
                                        {{Form::text('attribute-value-protein', null, ['class'=>'form-control', 'id'=>'attribute-value-protein']) }}
                                        {{ $errors->first('attribute-value-protein', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <h5 class="text text-info">Percentage of daily nutritional value (based on a 2000 calorie diet).</h5>
                            <br/>
                            <div class="row">
                                <div class="col-md-2">
                                    {{Form::label('Vitamin A')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-vitamina', 'Vitamin A')}}
                                        {{Form::text('attribute-value-vitamina', null, ['class'=>'form-control', 'id'=>'attribute-value-vitamina']) }}
                                        {{ $errors->first('attribute-value-vitamina', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Vitamin C')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-vitaminc', 'Vitamin C')}}
                                        {{Form::text('attribute-value-vitaminc', null, ['class'=>'form-control', 'id'=>'attribute-value-vitaminc']) }}
                                        {{ $errors->first('attribute-value-vitaminc', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Calcium')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-calcium', 'Calcium')}}
                                        {{Form::text('attribute-value-calcium', null, ['class'=>'form-control', 'id'=>'attribute-value-calcium']) }}
                                        {{ $errors->first('attribute-value-calcium', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Iron')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-iron', 'Iron')}}
                                        {{Form::text('attribute-value-iron', null, ['class'=>'form-control', 'id'=>'attribute-value-iron']) }}
                                        {{ $errors->first('attribute-value-iron', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>

                            </div>
                            <hr/>
                            <h5 class="text text-info">Advisory Information</h5>
                            <br/>
                            <div class="row">

                                <div class="col-md-7">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Allergens</label>

                                        {{Form::hidden('attribute-name-allergens', 'Allergens')}}
                                        <div class="col-sm-5">
                                            <div class="checkbox checkbox-replace color-primary">
{{--                                                {{ Form::hidden('attribute-value-allergens[gluten]', 'no')}}--}}
                                                {{ Form::checkbox('attribute-value-allergens[]', 'gluten', false, ['id'=>'attribute-value-allergens-gluten']) }}
                                                {{--<input type="checkbox" name="attribute-value-allergens[gluten]" id="chk-2">--}}
                                                <label>Gluten</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'crustaceans', false, ['id'=>'attribute-value-allergens-crustaceans']) }}
                                                <label>Crustaceans</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'eggs', false, ['id'=>'attribute-value-allergens-eggs']) }}
                                                <label>Eggs</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'fish', false, ['id'=>'attribute-value-allergens-fish']) }}
                                                <label>Fish</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'lupin', false, ['id'=>'attribute-value-allergens-lupin']) }}
                                                <label>lupin</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'milk', false, ['id'=>'attribute-value-allergens-milk']) }}
                                                <label>Milk (including lactose)</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'molluscs', false, ['id'=>'attribute-value-allergens-molluscs']) }}
                                                <label>Molluscs</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'mustard', false, ['id'=>'attribute-value-allergens-mustard']) }}
                                                <label>Mustard</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'nuts', false, ['id'=>'attribute-value-allergens-nuts']) }}
                                                <label>Nuts</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'peanuts', false, ['id'=>'attribute-value-allergens-peanuts']) }}
                                                <label>Peanuts</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'sesameseeds', false, ['id'=>'attribute-value-allergens-sesameseeds']) }}
                                                <label>Sesame Seeds</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'soybeans', false, ['id'=>'attribute-value-allergens-soybeans']) }}
                                                <label>Soybeans</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'so2', false, ['id'=>'attribute-value-allergens-so2']) }}
                                                <label>SO2 (sulfites)</label>
                                            </div>
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-allergens[]', 'celery', false, ['id'=>'attribute-value-allergens-celery']) }}
                                                <label>Celery</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Halal?</label>
                                        {{Form::hidden('attribute-name-halal', 'Halal')}}
                                        {{Form::hidden('attribute-value-halal', 'no')}}
                                        <div class="col-sm-5">
                                            <div class="checkbox checkbox-replace color-primary">
                                                {{ Form::checkbox('attribute-value-halal', 'yes', false, ['id'=>'attribute-value-halal']) }}
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <script src="{{ URL::asset('js/bootstrap-switch.min.js') }}"></script>



                            </div>


                        </div>
                    </div>
                </div>

                <div id="panel-packaging" class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseFour-2" class="collapsed">
                                Packaging
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour-2" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Packaging')}}
                                        {{Form::hidden('attribute-name-packaging', 'Packaging')}}
                                        {{Form::text('attribute-value-packaging', null, ['class'=>'form-control', 'id'=>'attribute-value-packaging', 'readonly']) }}
                                    </div>
                                </div>
                                <?php
                                    $packingTypes = [
                                        ''=>'-Select-',
                                        'Glass Bottle'=>'Glass Bottle',
                                        'Plastic Bottle'=>'Plastic Bottle',
                                        'Packet' => "Packet",
                                        "Can" => 'Can',
                                        "Tin" => 'Tin',
                                        "Mini Glass Jar", 'Mini Glass Jar',
                                        "Plastic Jar" => 'Plastic Jar',
                                        "Each" => 'Each',
                                        "Bag" => 'Bag',
                                        "Tub" => 'Tub',
                                        "Pouch" => 'Pouch',
                                        "Bucket" => 'Bucket',
                                        "Tetra Pack" => 'Tetra Pack',
                                        "Box" => 'Box',
                                        "Other" => 'Other'
                                    ];
                                ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Packing Type')}}
                                        {{Form::hidden('attribute-name-packingtype', 'Packing Type')}}
                                        {{Form::select('attribute-value-packingtype', $packingTypes, null, ['class'=>'form-control','id'=>'attribute-value-packingtype'])}}
                                        {{ $errors->first('attribute-value-packingtype', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('Shelf Life From Production (days)')}}
                                        {{Form::hidden('attribute-name-shelflife', 'Shelf Life')}}
                                        {{Form::text('attribute-value-shelflife', null, ['class'=>'form-control', 'id'=>'attribute-value-shelflife']) }}
                                        {{ $errors->first('attribute-value-shelflife', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <?php
                                    $storageCondition = [
                                        '' => 'Select',
                                        'Ambient' => 'Ambient',
                                        'Chilled' => 'Chilled',
                                        'Frozon' => 'Frozen',
                                        'Non-food' => 'Non-food'
                                    ];
                                ?>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{Form::label('Storage Condition')}}
                                        {{Form::hidden('attribute-name-storagecondition', 'Storage Condition')}}
                                        {{Form::select('attribute-value-storagecondition', $storageCondition, null, ['class'=>'form-control','id'=>'attribute-value-storagecondition'])}}
                                        {{ $errors->first('attribute-value-storagecondition', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Case Length (cm)')}}
                                        {{Form::hidden('attribute-name-caselength', 'Case Length')}}
                                        {{Form::text('attribute-value-caselength', null, ['class'=>'form-control', 'id'=>'attribute-value-caselength']) }}
                                        {{ $errors->first('attribute-value-caselength', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Case Width (cm)')}}
                                        {{Form::hidden('attribute-name-casewidth', 'Case Width')}}
                                        {{Form::text('attribute-value-casewidth', null, ['class'=>'form-control', 'id'=>'attribute-value-casewidth']) }}
                                        {{ $errors->first('attribute-value-casewidth', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Case Depth (cm)')}}
                                        {{Form::hidden('attribute-name-casedepth', 'Case Depth')}}
                                        {{Form::text('attribute-value-casedepth', null, ['class'=>'form-control', 'id'=>'attribute-value-casedepth']) }}
                                        {{ $errors->first('attribute-value-casedepth', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases per Pallet')}}
                                        {{Form::hidden('attribute-name-casesperpallet', 'Cases Per Pallet')}}
                                        {{Form::text('attribute-value-casesperpallet', null, ['class'=>'form-control', 'id'=>'attribute-value-casesperpallet']) }}
                                        {{ $errors->first('attribute-value-casesperpallet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases per Pallet Row')}}
                                        {{Form::hidden('attribute-name-casesperpalletrow', 'Cases Per Pallet Row')}}
                                        {{Form::text('attribute-value-casesperpalletrow', null, ['class'=>'form-control', 'id'=>'attribute-value-casesperpalletrow']) }}
                                        {{ $errors->first('attribute-value-casesperpalletrow', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases Per Container (20 ft.)')}}
                                        {{Form::hidden('attribute-name-casespercontainer', 'Cases Per Container')}}
                                        {{Form::text('attribute-value-casespercontainer', null, ['class'=>'form-control', 'id'=>'attribute-value-casespercontainer']) }}
                                        {{ $errors->first('attribute-value-casespercontainer', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases Per Container (Loose)')}}
                                        {{Form::hidden('attribute-name-casespercontainerloose', 'Cases Per Container Loose')}}
                                        {{Form::text('attribute-value-casespercontainerloose', null, ['class'=>'form-control', 'id'=>'attribute-value-casespercontainerloose']) }}
                                        {{ $errors->first('attribute-value-casespercontainerloose', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    {{Form::label('Weight (case): Net')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightcasenet', 'Weight Case Net')}}
                                        <div class="input-group-addon">g</div>
                                        {{Form::text('attribute-value-weightcasenet', null, ['class'=>'form-control', 'id'=>'attribute-value-weightcasenet']) }}
                                        {{ $errors->first('attribute-value-weightcasenet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (case): Gross')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightcasegross', 'Weight Case Gross')}}
                                        <div class="input-group-addon">g</div>
                                        {{Form::text('attribute-value-weightcasegross', null, ['class'=>'form-control', 'id'=>'attribute-value-weightcasegross']) }}
                                        {{ $errors->first('attribute-value-weightcasegross', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">

                                <div class="col-md-3">
                                    {{Form::label('Weight (individual): Net')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightindividualnet', 'Weight Individual Net')}}
                                        <div class="input-group-addon">g</div>
                                        {{Form::text('attribute-value-weightindividualnet', null, ['class'=>'form-control', 'id'=>'attribute-value-weightindividualnet']) }}
                                        {{ $errors->first('attribute-value-weightindividualnet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (individual): Gross')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightindividualgross', 'Weight Individual Gross')}}
                                        <div class="input-group-addon">g</div>
                                        {{Form::text('attribute-value-weightindividualgross', null, ['class'=>'form-control', 'id'=>'attribute-value-weightindividualgross']) }}
                                        {{ $errors->first('attribute-value-weightindividualgross', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (individual): Drain')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightindividualdrain', 'Weight Individual Drain')}}
                                        <div class="input-group-addon">g</div>
                                        {{Form::text('attribute-value-weightindividualdrain', null, ['class'=>'form-control', 'id'=>'attribute-value-weightindividualdrain']) }}
                                        {{ $errors->first('attribute-value-weightindividualdrain', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


    </div>

</div>