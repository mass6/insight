@extends($layout)

@section('content')

<div class="container">
    <h3>Product:  {{ $product->name }} [{{ $product->code }}]
        @if($product->assigned_user_id === $currentUser->id || $currentUser->hasAccess('cataloguing.products.admin'))
            &nbsp;
            <a href="{{URL::route('catalogue.product-definitions.edit', [$product->id])}}" class="">
              <button type="button" class="btn btn-blue btn-icon btn-sm">
                  Edit
                  <i class="entypo-pencil"></i>
              </button>
          </a>
        @endif
    </h3>
    <br/>
    {{-- Prodct Details Block --}}
    <div id="request-details" class="row">
        <div class="col-md-10">
            @include('product-definitions.partials._request-details')
        </div>
    </div>
    <hr/>

    <div class="row">


        <div class="col-md-10">

                <div class="tabs-vertical-env">

                    <ul class="nav tabs-vertical"><!-- available classes "right-aligned" -->
                        <li class="active"><a href="#v-general" data-toggle="tab">General</a></li>
                        <li><a href="#v-description" data-toggle="tab">Description</a></li>
                        <li><a href="#v-media" data-toggle="tab">Media</a></li>
                        <li><a href="#v-attributes" data-toggle="tab">Attributes</a></li>
                        <li><a href="#v-history" data-toggle="tab">History & Comments</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="v-general">
                            <div>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td width="150"><p><strong>Customer:</strong></p></td>
                                            <td><p>{{ $product->customer->name }}</p></td>
                                        </tr>
                                        <tr>
                                            <td width="150"><p><strong>Supplier:</strong></p></td>
                                            <td><p>{{ $product->supplier ? $product->supplier->name : '' }}</p></td>
                                        </tr>
                                        <tr>
                                            <td width="150"><p><strong>Product Code:</strong></p></td>
                                            <td><p>{{ $product->code }}</p></td>
                                        </tr>
                                        <tr>
                                            <td width="150"><p><strong>Product Name:</strong></p></td>
                                            <td><p>{{ $product->name }}</p></td>
                                        </tr>
                                        <tr>
                                            <td width="150"><p><strong>Category:</strong></p></td>
                                            <td><p>{{ $product->category }}</p></td>
                                        </tr>
                                        <tr>
                                            <td width="150"><p><strong>UOM:</strong></p></td>
                                            <td><p>{{ $product->uom }}</p></td>
                                        </tr>
                                        <tr>
                                            <td width="150"><p><strong>Price:</strong></p></td>
                                            <td><p>{{ $product->price }}</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="tab-pane" id="v-description">

                            <h4>Short Description</h4>
                            <p>{{ $product->short_description }}</p>
                            <hr/>
                            <br/>

                            <h4>Full Description</h4>
                            <p>{{ $product->description }}</p>




                        </div>
                        <div class="tab-pane" id="v-media">

                            <!-- Images -->

                                <div class="gallery-env">

                                    <?php $customImageLabels = $product->customer->settings()->getCustomImageLabels; ?>
                                    <h4>Product Images</h4>

                                    <div class="row">

                                                <div class="col-sm-3 col-xs-4" data-tag="1d">
                                                    <span>{{ isset($customImageLabels['imageLabel1']) ? $customImageLabels['imageLabel1'] : 'Image 1' }}</span>
                                                    <article class="image-thumb">
                                                        <a href="{{ $product->image1->url() }}" class="image" target="_blank">
                                                            <img src="{{ $product->image1->url('thumb') }}"/>
                                                        </a>
                                                    </article>
                                                </div>

                                                <div class="col-sm-3 col-xs-4" data-tag="1d">
                                                <span>{{ isset($customImageLabels['imageLabel2']) ? $customImageLabels['imageLabel2'] : 'Image 2' }}</span>
                                                    <article class="image-thumb">
                                                        <a href="{{ $product->image2->url() }}" class="image" target="_blank">
                                                            <img src="{{ $product->image2->url('thumb') }}"/>
                                                        </a>
                                                    </article>
                                                </div>

                                                <div class="col-sm-3 col-xs-4" data-tag="1d">
                                                <span>{{ isset($customImageLabels['imageLabel3']) ? $customImageLabels['imageLabel3'] : 'Image 3' }}</span>
                                                    <article class="image-thumb">
                                                        <a href="{{ $product->image3->url() }}" class="image" target="_blank">
                                                            <img src="{{ $product->image3->url('thumb') }}"/>
                                                        </a>
                                                    </article>
                                                </div>

                                                <div class="col-sm-3 col-xs-4" data-tag="1d">
                                                <span>{{ isset($customImageLabels['imageLabel4']) ? $customImageLabels['imageLabel4'] : 'Image 4' }}</span>
                                                    <article class="image-thumb">
                                                        <a href="{{ $product->image4->url() }}" class="image" target="_blank">
                                                            <img src="{{ $product->image4->url('thumb') }}"/>
                                                        </a>
                                                    </article>
                                                </div>

                                    </div>

                                </div>
                                <hr />



                            <!-- Attachments -->

                                <?php $customAttachmentLabels = $product->customer->settings()->getCustomAttachmentLabels; ?>

                                <h4>Attachments</h4>

                                <div class="row">
                                    <ul style="font-size: 14px;">
                                        @if ($product->attachment1->originalFilename())
                                            <li>{{ isset($customAttachmentLabels['attachmentLabel1']) ? '[' . $customAttachmentLabels['attachmentLabel1'] . '] : ' : '' }}
                                                <a href="{{ $product->attachment1->url() }}" target="_blank">
                                                    {{$product->attachment1->originalFilename()}}
                                                </a>
                                            </li>
                                        @endif
                                        @if ($product->attachment2->originalFilename())
                                            <li>{{ isset($customAttachmentLabels['attachmentLabel2']) ? '[' . $customAttachmentLabels['attachmentLabel2'] . '] : ' : '' }}
                                                <a href="{{ $product->attachment2->url() }}" target="_blank">
                                                    {{$product->attachment2->originalFilename()}}
                                                </a>
                                            </li>
                                        @endif
                                        @if ($product->attachment3->originalFilename())
                                            <li>{{ isset($customAttachmentLabels['attachmentLabel3']) ? '[' . $customAttachmentLabels['attachmentLabel3'] . '] : ' : '' }}
                                                <a href="{{ $product->attachment3->url() }}" target="_blank">
                                                    {{$product->attachment3->originalFilename()}}
                                                </a>
                                            </li>
                                        @endif
                                        @if ($product->attachment4->originalFilename())
                                            <li>{{ isset($customAttachmentLabels['attachmentLabel4']) ? '[' . $customAttachmentLabels['attachmentLabel4'] . '] : ' : '' }}
                                                <a href="{{ $product->attachment4->url() }}" target="_blank">
                                                    {{$product->attachment4->originalFilename()}}
                                                </a>
                                            </li>
                                        @endif
                                        @if ($product->attachment5->originalFilename())
                                            <li>{{ isset($customAttachmentLabels['attachmentLabel5']) ? '[' . $customAttachmentLabels['attachmentLabel5'] . '] : ' : '' }}
                                                <a href="{{ $product->attachment5->url() }}" target="_blank">
                                                    {{$product->attachment5->originalFilename()}}
                                                </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>




                        </div>
                        <div class="tab-pane" id="v-attributes">
                                @if($attributes)

                                    @if($customAttributes)
                                        @include('product-definitions.partials._' . strtolower($customAttributes) . '-attributes-data')
                                    @else


                                        <table>
                                            <tbody>
                                            @foreach($attributes as $key => $val)
                                                <tr>
                                                    <td width="150"><p><strong>{{$key}}:</strong></p></td>
                                                    <td><p>{{ $val }}</p></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                @endif

                        </div>
                        <div class="tab-pane" id="v-history">


                            <!-- Comments -->
                            <h4 class="">History</h4>
                            <br/>
                            @if (Session::has('comment_message'))
                            <div class="row alert {{ Session::get('success') ? 'alert-success' : 'alert-danger' }} clearfix" data-dismiss="alert">
                                {{ Session::get('comment_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            </div>
                            @endif

                            @foreach ($product->comments as $comment)
                            <div class="row">
                                <div class="col-sm-2">
                                    <a href="#" class="profile-picture">
                                        <img src="{{ $comment->user->profile ? $comment->user->profile->avatar->url('thumb') : URL::asset('images/user.jpeg') }}" class="img-responsive img-circle" />
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <h5>{{ $comment->user->name() .' on ' . $comment->created_at }}</h5>
                                    <p>{{ formatComment($comment->body) }}</p>
                                </div>
                            </div>
                            <hr/>
                            @endforeach





                        </div>
                    </div>

                </div>

            </div>


        </div>

        <div class="row">
            <div class="col-sm-4">
                {{ link_to_route('catalogue.product-definitions.index', 'Back', null, array('class'=>'btn btn-danger btn-sm')) }}
            </div>
        </div>

    </div>







@stop