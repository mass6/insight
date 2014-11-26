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
                                        {{Form::hidden('attribute-name1', 'Brand')}}
                                        <input id="attribute-value1" name="attribute-value1" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('HS Code')}}
                                        {{Form::hidden('attribute-name2', 'HS Code')}}
                                        <input id="attribute-value2" name="attribute-value2" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Barcode Number')}}
                                        {{Form::hidden('attribute-name3', 'Barcode Number')}}
                                        <input id="attribute-value3" name="attribute-value3" class="form-control" placeholder="">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('Country of Manufacture')}}
                                        {{Form::hidden('attribute-name4', 'Country of Manufacture')}}
                                        <input id="attribute-value4" name="attribute-value4" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Lead Time (days)')}}
                                        {{Form::hidden('attribute-name5', 'Lead Time')}}
                                        <input id="attribute-value5" name="attribute-value5" class="form-control" placeholder="From order to loading date">
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
                                        {{Form::hidden('attribute-name6', 'Ingredients')}}
                                        <textarea class="form-control" name="attribute-value6" id="attribute-value6"></textarea>
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
                                        {{Form::hidden('attribute-name7', 'Calories')}}
                                        <input id="attribute-value7" name="attribute-value7" class="form-control" placeholder="">
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Calories From Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name8', 'Calories From Fat')}}
                                        <input id="attribute-value8" name="attribute-value8" class="form-control" placeholder="">
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Total Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name9', 'Total Fat')}}
                                        <input id="attribute-value9" name="attribute-value9" class="form-control" placeholder="">
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Saturated Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name10', 'Saturated Fat')}}
                                        <input id="attribute-value10" name="attribute-value10" class="form-control" placeholder="">
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Trans Fat')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name11', 'Trans Fat')}}
                                        <input id="attribute-value11" name="attribute-value11" class="form-control" placeholder="">
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Cholesterol')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name12', 'Cholesterol')}}
                                        <input id="attribute-value12" name="attribute-value12" class="form-control" placeholder="">
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    {{Form::label('Sodium')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name13', 'Sodium')}}
                                        <input id="attribute-value13" name="attribute-value13" class="form-control" placeholder="">
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Total Carbohydrates')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name14', 'Total Carbohydrates')}}
                                        <input id="attribute-value14" name="attribute-value14" class="form-control" placeholder="">
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Dietary Fiber')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name15', 'Dietary Fiber')}}
                                        <input id="attribute-value15" name="attribute-value15" class="form-control" placeholder="">
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Sugars')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name16', 'Sugars')}}
                                        <input id="attribute-value16" name="attribute-value16" class="form-control" placeholder="">
                                        <div class="input-group-addon">g</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Protein')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name17', 'Protein')}}
                                        <input id="attribute-value17" name="attribute-value17" class="form-control" placeholder="">
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
                                        {{Form::hidden('attribute-name18', 'Vitamin A')}}
                                        <input id="attribute-value18" name="attribute-value18" class="form-control" placeholder="">
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Vitamin C')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name19', 'Vitamin C')}}
                                        <input id="attribute-value19" name="attribute-value19" class="form-control" placeholder="">
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Calcium')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name20', 'Calcium')}}
                                        <input id="attribute-value20" name="attribute-value20" class="form-control" placeholder="">
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{Form::label('Iron')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name21', 'Iron')}}
                                        <input id="attribute-value21" name="attribute-value21" class="form-control" placeholder="">
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
                                        {{Form::hidden('attribute-name22', 'Packaging')}}
                                        <input id="attribute-value22" name="attribute-value22" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Packaging Type')}}
                                        {{Form::hidden('attribute-name23', 'Packaging Type')}}
                                        <input id="attribute-value23" name="attribute-value23" class="form-control" placeholder="From order to loading date">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Shelf Life (months)')}}
                                        {{Form::hidden('attribute-name24', 'Shelf Life')}}
                                        <input id="attribute-value24" name="attribute-value24" data-validate="number" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::label('Storage Conditions')}}
                                        {{Form::hidden('attribute-name25', 'Storage Conditions')}}
                                        <input id="attribute-value25" name="attribute-value25" class="form-control" placeholder="">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    {{Form::label('Weight (case): Net')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name26', 'Weight Case Net')}}
                                        <div class="input-group-addon">Kg</div>
                                        <input id="attribute-value26" name="attribute-value26" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (case): Gross')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name27', 'Weight Case Gross')}}
                                        <div class="input-group-addon">Kg</div>
                                        <input id="attribute-value27" name="attribute-value27" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    {{Form::label('Weight (individual): Net')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name28', 'Weight Individual Net')}}
                                        <div class="input-group-addon">g</div>
                                        <input id="attribute-value28" name="attribute-value28" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (individual): Gross')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name29', 'Weight Individual Gross')}}
                                        <div class="input-group-addon">Kg</div>
                                        <input id="attribute-value29" name="attribute-value29" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::label('Weight (individual): Drain')}}
                                    <div class="input-group">
                                        {{Form::hidden('attribute-name30', 'Weight Individual Drain')}}
                                        <div class="input-group-addon">Kg</div>
                                        <input id="attribute-value30" name="attribute-value30" class="form-control" placeholder="">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

    </div>

</div>