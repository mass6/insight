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
                                        <input id="attribute-value-brand" name="attribute-value-brand" class="form-control" placeholder="">
                                        {{ $errors->first('attribute-value-brand', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('HS Code')}}
                                        {{Form::hidden('attribute-name-hscode', 'HS Code')}}
                                        <input id="attribute-value-hscode" name="attribute-value-hscode" class="form-control" placeholder="" value="{{{ Input::old('attribute-value-hscode') ? Input::old('attribute-value-hscode') : '77' }}}">
                                        {{ $errors->first('attribute-value-hscode', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Barcode Number (case)')}}
                                        {{Form::hidden('attribute-name-barcodenumbercase', 'Barcode Number Case')}}
                                        <input id="attribute-value-barcodenumbercase" name="attribute-value-barcodenumbercase" class="form-control" placeholder="">
                                        {{ $errors->first('attribute-value-barcodenumbercase', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('Country of Manufacture')}}
                                        {{Form::hidden('attribute-name-countryofmanufacture', 'Country of Manufacture')}}
                                        {{Form::select('attribute-value-countryofmanufacture', getCountries(), null, ['class'=>'form-control', 'id'=>'attribute-value-countryofmanufacture']) }}
                                        {{ $errors->first('attribute-value-countryofmanufacture', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Lead Time (days)')}}
                                        {{Form::hidden('attribute-name-leadtime', 'Lead Time')}}
                                        <input id="attribute-value-leadtime" name="attribute-value-leadtime" class="form-control" data-validate="number" placeholder="From order to loading date">
                                        {{ $errors->first('attribute-value-leadtime', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Barcode Number (individual)')}}
                                        {{Form::hidden('attribute-name-barcodenumberindividual', 'Barcode Number Individual')}}
                                        <input id="attribute-value-barcodenumberindividual" name="attribute-value-barcodenumberindividual" class="form-control" placeholder="">
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
                                        <textarea class="form-control" name="attribute-value-ingredients" id="attribute-value-ingredients"></textarea>
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
                                        <input id="attribute-value-calories" name="attribute-value-calories" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-calories', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Calories From Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-caloriesfromfat', 'Calories From Fat')}}
                                        <input id="attribute-value-caloriesfromfat" name="attribute-value-caloriesfromfat" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-caloriesfromfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Total Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-totalfat', 'Total Fat')}}
                                        <input id="attribute-value-totalfat" name="attribute-value-totalfat" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-totalfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Saturated Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-saturatedfat', 'Saturated Fat')}}
                                        <input id="attribute-value-saturatedfat" name="attribute-value-saturatedfat" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-saturatedfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Trans Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-transfat', 'Trans Fat')}}
                                        <input id="attribute-value-transfat" name="attribute-value-transfat" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-transfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Cholesterol')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-cholesterol', 'Cholesterol')}}
                                        <input id="attribute-value-cholesterol" name="attribute-value-cholesterol" class="form-control" data-validate="number" placeholder="">
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
                                        <input id="attribute-value-sodium" name="attribute-value-sodium" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-sodium', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Total Carbohydrates')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-totalcarbohydrates', 'Total Carbohydrates')}}
                                        <input id="attribute-value-totalcarbohydrates" name="attribute-value-totalcarbohydrates" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-totalcarbohydrates', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Dietary Fiber')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-dietaryfiber', 'Dietary Fiber')}}
                                        <input id="attribute-value-dietaryfiber" name="attribute-value-dietaryfiber" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-dietaryfiber', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Sugars')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-sugars', 'Sugars')}}
                                        <input id="attribute-value-sugars" name="attribute-value-sugars" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-sugars', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Protein')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-protein', 'Protein')}}
                                        <input id="attribute-value-protein" name="attribute-value-protein" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-hscode', '<span class="label label-danger">:message</span>') }}
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
                                        <input id="attribute-value-vitamina" name="attribute-value-vitamina" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-vitamina', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Vitamin C')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-vitaminc', 'Vitamin C')}}
                                        <input id="attribute-value-vitaminc" name="attribute-value-vitaminc" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-vitaminc', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Calcium')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-calcium', 'Calcium')}}
                                        <input id="attribute-value-calcium" name="attribute-value-calcium" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-calcium', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Iron')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-iron', 'Iron')}}
                                        <input id="attribute-value-iron" name="attribute-value-iron" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-iron', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>

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
                                        <input id="attribute-value-packaging" name="attribute-value-packaging" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Packing Type')}}
                                        {{Form::hidden('attribute-name-packingtype', 'Packing Type')}}
                                        <select id="attribute-value-packingtype" name="attribute-value-packingtype" class="form-control">
                                            <option value="">-Select-</option>
                                            <option value="Glass Bottle">Glass Bottle</option>
                                            <option value="Plastic Bottle">Plastic Bottle</option>
                                            <option value="Packet">Packet</option>
                                            <option value="Can">Can</option>
                                            <option value="Tin">Tin</option>
                                            <option value="Mni Glass Jar">Mni Glass Jar</option>
                                            <option value="Plastic Jar">Plastic Jar</option>
                                            <option value="Each">Each</option>
                                            <option value="Bag">Bag</option>
                                            <option value="Tub">Tub</option>
                                            <option value="Pouch">Pouch</option>
                                            <option value="Bucket">Bucket</option>
                                            <option value="Tetra Pack">Tetra Pack</option>
                                            <option value="Box">Box</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        {{ $errors->first('attribute-value-packingtype', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('Shelf Life From Production (days)')}}
                                        {{Form::hidden('attribute-name-shelflife', 'Shelf Life')}}
                                        <input id="attribute-value-shelflife" name="attribute-value-shelflife" data-validate="number" class="form-control" placeholder="">
                                        {{ $errors->first('attribute-value-shelflife', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{Form::label('Storage Condition')}}
                                        {{Form::hidden('attribute-name-storagecondition', 'Storage Condition')}}
                                        <select id="attribute-value-storagecondition" name="attribute-value-storagecondition" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Ambient">Ambient</option>
                                            <option value="Chilled">Chilled</option>
                                            <option value="Frozen">Frozen</option>
                                            <option value="Non-food">Non-food</option>
                                        </select>
                                        {{ $errors->first('attribute-value-storagecondition', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Case Length (cm)')}}
                                        {{Form::hidden('attribute-name-caselength', 'Case Length')}}
                                        <input id="attribute-value-caselength" name="attribute-value-caselength" data-validate="number" class="form-control" placeholder="">
                                        {{ $errors->first('attribute-value-caselength', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Case Width (cm)')}}
                                        {{Form::hidden('attribute-name-casewidth', 'Case Width')}}
                                        <input id="attribute-value-casewidth" name="attribute-value-casewidth" data-validate="number" class="form-control" placeholder="">
                                        {{ $errors->first('attribute-value-casewidth', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Case Depth (cm)')}}
                                        {{Form::hidden('attribute-name-casedepth', 'Case Depth')}}
                                        <input id="attribute-value-casedepth" name="attribute-value-casedepth" data-validate="number" class="form-control" placeholder="">
                                        {{ $errors->first('attribute-value-casedepth', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases per Pallet')}}
                                        {{Form::hidden('attribute-name-casesperpallet', 'Cases Per Pallet')}}
                                        <input id="attribute-value-casesperpallet" name="attribute-value-casesperpallet" data-validate="number" class="form-control" placeholder="">
                                        {{ $errors->first('attribute-value-casesperpallet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases per Pallet Row')}}
                                        {{Form::hidden('attribute-name-casesperpalletrow', 'Cases Per Pallet Row')}}
                                        <input id="attribute-value-casesperpalletrow" name="attribute-value-casesperpalletrow" data-validate="number" class="form-control" placeholder="">
                                        {{ $errors->first('attribute-value-casesperpallet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases Per Container (20 ft.)')}}
                                        {{Form::hidden('attribute-name-casespercontainer', 'Cases Per Container')}}
                                        <input id="attribute-value-casespercontainer" name="attribute-value-casespercontainer" data-validate="number" class="form-control" placeholder="">
                                        {{ $errors->first('attribute-value-casespercontainer', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases Per Container (Loose)')}}
                                        {{Form::hidden('attribute-name-casespercontainerloose', 'Cases Per Container Loose')}}
                                        <input id="attribute-value-casespercontainerloose" name="attribute-value-casespercontainerloose" data-validate="number" class="form-control" placeholder="">
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
                                        <input id="attribute-value-weightcasenet" name="attribute-value-weightcasenet" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-weightcasenet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (case): Gross')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightcasegross', 'Weight Case Gross')}}
                                        <div class="input-group-addon">g</div>
                                        <input id="attribute-value-weightcasegross" name="attribute-value-weightcasegross" class="form-control" data-validate="number" placeholder="">
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
                                        <input id="attribute-value-weightindividualnet" name="attribute-value-weightindividualnet" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-weightindividualnet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (individual): Gross')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightindividualgross', 'Weight Individual Gross')}}
                                        <div class="input-group-addon">g</div>
                                        <input id="attribute-value-weightindividualgross" name="attribute-value-weightindividualgross" class="form-control" data-validate="number" placeholder="">
                                        {{ $errors->first('attribute-value-weightindividualgross', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (individual): Drain')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightindividualdrain', 'Weight Individual Drain')}}
                                        <div class="input-group-addon">g</div>
                                        <input id="attribute-value-weightindividualdrain" name="attribute-value-weightindividualdrain" class="form-control" data-validate="number" placeholder="">
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