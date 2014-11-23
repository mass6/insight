@extends($layout)

@section('content')
<div class="container">
    <h3>Product:  {{ $product->name }} [{{ $product->code }}]</h3>

    <div class="row" id="form-container" style="display:block;">
        <div class="col-lg-10">
            <div class="well bs-component">

                {{ Form::model($product, ['url'=>[''], 'method'=>'POST','class'=>'form-horizontal','role'=>'form']) }}

                <p><strong>Code:</strong> {{ $product->code }}</p>
                <p><strong>Name:</strong> {{ $product->name}}</p>
                <p><strong>UOM:</strong> {{ $product->uom}}</p>
                <p><strong>Price:</strong> {{ $product->price }}</p>
                <p><strong>Category:</strong> {{ $product->category}}</p>
                <p><strong>Supplier:</strong> {{ $product->supplier ? $product->supplier->name : ''}}</p>
                <p><strong>Description:</strong> {{ $product->description}}</p>

                {{-- Gallery --}}

                @if($product->images)
                    <div class="gallery-env">
                    	<div class="row">
                    		<div class="col-sm-12">
                    			<h3>Product Images</h3>
                    			<hr />
                    		</div>
                    	</div>
                        <div class="row">
                                 @foreach ($product->images as $image)
                                    <div class="col-sm-2 col-xs-4" data-tag="1d">
                                        <article class="image-thumb">
                                            <a href="{{ $image->image->url() }}" class="image">
                                                <img src="{{ $image->image->url('thumb') }}"/>
                                            </a>
                                            <div class="image-options">
                                                <a href="#" class="delete"><i class="entypo-cancel"></i></a>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                @endif


                <!-- Attachments -->
                @if($product->attachments)
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Attachments</h3>
                        </div>
                    </div>
                    <div class="row">
                        <ul>
                             @foreach ($product->attachments as $attachment)
                                <li>
                                    <a href="{{ $attachment->attachment->url() }}" target="_blank">
                                        {{$attachment->attachment->originalFilename()}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{--End Gallery--}}

                {{ Form::close() }}
                <div class="form-group">
                    {{ link_to_route('catalogue.product-definitions.edit', 'Edit', array($product->id), array('class' => 'btn btn-primary')) }} {{ link_to_route('catalogue.product-definitions.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
                </div>
            </div>

            <!-- Comments -->

                <div class="row">
                    <h2 class="">History</h2>
                    <br/>
                    @if (Session::has('comment_message'))
                    <div class="row alert {{ Session::get('success') ? 'alert-success' : 'alert-danger' }} clearfix" data-dismiss="alert">
                        {{ Session::get('comment_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
                    @endif
                </div>

                @foreach ($product->comments as $comment)
                <div class="row">
                    <div class="col-sm-1">
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



                <div class="form-group">
                    <?php //$type = 'Insight\Entities\ItemRequest'; ?>
                    <?php //$id = $item_request['id']; ?>
                    {{--@include('comments._form')--}}
                </div>



        </div>
    </div>

</div>


@stop