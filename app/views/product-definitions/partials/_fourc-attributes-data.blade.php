<div id="attributes">
    <!-- Panel Group -->
    <div class="col-md-12">

            <div class="panel-group joined" id="accordion-test-2">

                <div id="panel-manufacturing" class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2">
                                Manufacturing Details
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
                                        <input id="attribute-value-brand" name="attribute-value-brand" class="form-control" value="{{$attributes['Brand']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('HS Code')}}
                                        <input id="attribute-value-hscode" name="attribute-value-hscode" class="form-control" value="{{$attributes['HS Code']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Barcode Number (case)')}}
                                        <input id="attribute-value-barcodenumbercase" name="attribute-value-barcodenumbercase" class="form-control" value="{{$attributes['Barcode Number Case']}}" readonly>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('Country of Manufacture')}}
                                        {{Form::text('attribute-value-countryofmanufacture',  $attributes['Country of Manufacture'], ['class'=>'form-control', 'id'=>'attribute-value-countryofmanufacture', 'readonly']) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Lead Time (days)')}}
                                        <input id="attribute-value-leadtime" name="attribute-value-leadtime" class="form-control" data-validate="number" value="{{$attributes['Lead Time']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Barcode Number (individual)')}}
                                        <input id="attribute-value-barcodenumberindividual" name="attribute-value-barcodenumberindividual" class="form-control" value="{{$attributes['Barcode Number Individual']}}" readonly>
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
                                        <textarea class="form-control" name="attribute-value-ingredients" id="attribute-value-ingredients" readonly>{{ $attributes['Ingredients'] }}</textarea>
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
                                <div class="col-md-3">
                                    {{Form::label('Engergy (kcal)')}}
                                    <div class="input-group">
                                        <input id="attribute-value-energykcal" name="attribute-value-energykcal" class="form-control" data-validate="number" value="{{$attributes['Energy Kcal']}}" readonly>
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Engergy (kJ)')}}
                                    <div class="input-group">
                                        <input id="attribute-value-energykj" name="attribute-value-energykj" class="form-control" data-validate="number" value="{{$attributes['Energy kJ']}}" readonly>
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Fat')}}
                                    <div class="input-group">
                                        <input id="attribute-value-fat" name="attribute-value-saturates" class="form-control" data-validate="number" value="{{$attributes['Fat']}}" readonly>
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Saturates')}}
                                    <div class="input-group">
                                        <input id="attribute-value-saturates" name="attribute-value-saturates" class="form-control" data-validate="number" value="{{$attributes['Saturates']}}" readonly>
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                            </div>
                            <br/>

                            <div class="row">

                                <div class="col-md-3">
                                    {{Form::label('Carbohydrates')}}
                                    <div class="input-group">
                                        <input id="attribute-value-carbohydrates" name="attribute-value-carbohydrates" class="form-control" data-validate="number" value="{{$attributes['Carbohydrates']}}" readonly>
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Sugars')}}
                                    <div class="input-group">
                                        <input id="attribute-value-sugars" name="attribute-value-sugars" class="form-control" data-validate="number" value="{{$attributes['Sugars']}}" readonly>
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Protein')}}
                                    <div class="input-group">
                                        <input id="attribute-value-protein" name="attribute-value-protein" class="form-control" data-validate="number" value="{{$attributes['Protein']}}" readonly>
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Salt')}}
                                    <div class="input-group">
                                        <input id="attribute-value-sodium" name="attribute-value-salt" class="form-control" data-validate="number" value="{{$attributes['Salt']}}" readonly>
                                        {{ $errors->first('attribute-value-salt', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>

                            </div>
                            <br/>

                            <div class="row">

                                <div class="col-md-3">
                                    {{Form::label('Calories From Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-caloriesfromfat', 'Calories From Fat')}}
                                        <input id="attribute-value-caloriesfromfat" name="attribute-value-caloriesfromfat" class="form-control" data-validate="number" value="{{$attributes['Calories From Fat']}}"  readonly>
                                        {{ $errors->first('attribute-value-caloriesfromfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Total Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-totalfat', 'Total Fat')}}
                                        <input id="attribute-value-totalfat" name="attribute-value-totalfat" class="form-control" data-validate="number" value="{{$attributes['Total Fat']}}" readonly>
                                        {{ $errors->first('attribute-value-totalfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Trans Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-transfat', 'Trans Fat')}}
                                        <input id="attribute-value-transfat" name="attribute-value-transfat" class="form-control" data-validate="number" value="{{$attributes['Trans Fat']}}" readonly>
                                        {{ $errors->first('attribute-value-transfat', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Cholesterol')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-cholesterol', 'Cholesterol')}}
                                        <input id="attribute-value-cholesterol" name="attribute-value-cholesterol" class="form-control" data-validate="number" value="{{$attributes['Cholesterol']}}" readonly>
                                        {{ $errors->first('attribute-value-cholesterol', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <h5 class="text text-info">Percentage of daily nutritional value (based on a 2000 calorie diet).</h5>
                            <br/>
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Vitamin A')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-vitamina', 'Vitamin A')}}
                                        <input id="attribute-value-vitamina" name="attribute-value-vitamina" class="form-control" data-validate="number" value="{{$attributes['Vitamin A']}}" readonly>
                                        {{ $errors->first('attribute-value-vitamina', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Vitamin C')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-vitaminc', 'Vitamin C')}}
                                        <input id="attribute-value-vitaminc" name="attribute-value-vitaminc" class="form-control" data-validate="number" value="{{$attributes['Vitamin C']}}" readonly>
                                        {{ $errors->first('attribute-value-vitaminc', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Calcium')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-calcium', 'Calcium')}}
                                        <input id="attribute-value-calcium" name="attribute-value-calcium" class="form-control" data-validate="number" value="{{$attributes['Calcium']}}" readonly>
                                        {{ $errors->first('attribute-value-calcium', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Iron')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-iron', 'Iron')}}
                                        <input id="attribute-value-iron" name="attribute-value-iron" class="form-control" data-validate="number" value="{{$attributes['Iron']}}" readonly>
                                        {{ $errors->first('attribute-value-iron', '<span class="label label-danger">:message</span>') }}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>

                            </div>
                            <hr/>
                            <h5 class="text text-info">Advisory Information</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <ul class="list-unstyled"><h5>Allergens</h5>
                                    @if(isset($attributes['Allergens']))
                                        @foreach($attributes['Allergens'] as $allergen)
                                            <li><span class="entypo entypo-check"></span> {{ ucwords($allergen) }}</li>
                                        @endforeach
                                    @endif
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h5>Halal</h5>
                                    {{ ucfirst($attributes['Halal']) }}
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
                                        <input id="attribute-value-packaging" name="attribute-value-packaging" class="form-control" value="{{$attributes['Packaging']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Packing Type')}}
                                        {{Form::hidden('attribute-name-packingtype', 'Packing Type')}}
                                        {{Form::text('attribute-value-packingtype', $attributes['Packing Type'], ['class' => 'form-control', 'readonly'])}}
                                        {{ $errors->first('attribute-value-packingtype', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('Shelf Life From Production (days)')}}
                                        {{Form::hidden('attribute-name-shelflife', 'Shelf Life')}}
                                        <input id="attribute-value-shelflife" name="attribute-value-shelflife" data-validate="number" class="form-control" value="{{$attributes['Shelf Life']}}" readonly>
                                        {{ $errors->first('attribute-value-shelflife', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{Form::label('Storage Condition')}}
                                        {{Form::hidden('attribute-name-storagecondition', 'Storage Condition')}}
                                        {{Form::text('attribute-value-storagecondition', $attributes['Storage Condition'], ['class' => 'form-control', 'readonly'])}}
                                        {{ $errors->first('attribute-value-storagecondition', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Case Length (cm)')}}
                                        {{Form::hidden('attribute-name-caselength', 'Case Length')}}
                                        <input id="attribute-value-caselength" name="attribute-value-caselength" data-validate="number" class="form-control" value="{{$attributes['Case Length']}}" readonly>
                                        {{ $errors->first('attribute-value-caselength', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Case Width (cm)')}}
                                        {{Form::hidden('attribute-name-casewidth', 'Case Width')}}
                                        <input id="attribute-value-casewidth" name="attribute-value-casewidth" data-validate="number" class="form-control" value="{{$attributes['Case Width']}}" readonly>
                                        {{ $errors->first('attribute-value-casewidth', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Case Depth (cm)')}}
                                        {{Form::hidden('attribute-name-casedepth', 'Case Depth')}}
                                        <input id="attribute-value-casedepth" name="attribute-value-casedepth" data-validate="number" class="form-control" value="{{$attributes['Case Depth']}}" readonly>
                                        {{ $errors->first('attribute-value-casedepth', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases per Pallet')}}
                                        {{Form::hidden('attribute-name-casesperpallet', 'Cases Per Pallet')}}
                                        <input id="attribute-value-casesperpallet" name="attribute-value-casesperpallet" data-validate="number" class="form-control" value="{{$attributes['Cases Per Pallet']}}" readonly>
                                        {{ $errors->first('attribute-value-casesperpallet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases per Pallet Row')}}
                                        {{Form::hidden('attribute-name-casesperpalletrow', 'Cases Per Pallet Row')}}
                                        <input id="attribute-value-casesperpalletrow" name="attribute-value-casesperpalletrow" data-validate="number" class="form-control" value="{{$attributes['Cases Per Pallet Row']}}" readonly>
                                        {{ $errors->first('attribute-value-casesperpallet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases Per Container (20 ft.)')}}
                                        {{Form::hidden('attribute-name-casespercontainer', 'Cases Per Container')}}
                                        <input id="attribute-value-casespercontainer" name="attribute-value-casespercontainer" data-validate="number" class="form-control" value="{{$attributes['Cases Per Container']}}" readonly>
                                        {{ $errors->first('attribute-value-casespercontainer', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Cases Per Container (Loose)')}}
                                        {{Form::hidden('attribute-name-casespercontainerloose', 'Cases Per Container Loose')}}
                                        <input id="attribute-value-casespercontainerloose" name="attribute-value-casespercontainerloose" data-validate="number" class="form-control" value="{{$attributes['Cases Per Container Loose']}}" readonly>
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
                                        <input id="attribute-value-weightcasenet" name="attribute-value-weightcasenet" class="form-control" data-validate="number" value="{{$attributes['Weight Case Net']}}" readonly>
                                        {{ $errors->first('attribute-value-weightcasenet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (case): Gross')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightcasegross', 'Weight Case Gross')}}
                                        <div class="input-group-addon">g</div>
                                        <input id="attribute-value-weightcasegross" name="attribute-value-weightcasegross" class="form-control" data-validate="number" value="{{$attributes['Weight Case Gross']}}" readonly>
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
                                        <input id="attribute-value-weightindividualnet" name="attribute-value-weightindividualnet" class="form-control" data-validate="number" value="{{$attributes['Weight Individual Net']}}" readonly>
                                        {{ $errors->first('attribute-value-weightindividualnet', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (individual): Gross')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightindividualgross', 'Weight Individual Gross')}}
                                        <div class="input-group-addon">g</div>
                                        <input id="attribute-value-weightindividualgross" name="attribute-value-weightindividualgross" class="form-control" data-validate="number" value="{{$attributes['Weight Individual Gross']}}" readonly>
                                        {{ $errors->first('attribute-value-weightindividualgross', '<span class="label label-danger">:message</span>') }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (individual): Drain')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name-weightindividualdrain', 'Weight Individual Drain')}}
                                        <div class="input-group-addon">g</div>
                                        <input id="attribute-value-weightindividualdrain" name="attribute-value-weightindividualdrain" class="form-control" data-validate="number" value="{{$attributes['Weight Individual Drain']}}" readonly>
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