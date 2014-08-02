@extends($layout)

@section('links')

<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}"  id="style-resource-1">
<link rel="stylesheet" href="{{ URL::asset('css/font-icons/entypo/css/entypo.css') }}"  id="style-resource-2">
<link rel="stylesheet" href="{{ URL::asset('css/neon.css') }}"  id="style-resource-3">

@stop


@section('content')




<div class="jumbotron">
    <div class="row">
        <div class="col-md-6">
            <h1>Welcome to 36S Insight</h1>
            <h2>Reporting & Analytics tool</h2>
            <p>Real-time data and statistics analysis on portal usage. Reports cna be viewed online or can be downloaded to a file.</p>
        </div>
        <div class="col-md-6">
            <img src="{{ URL::asset('images/analytics.jpg') }}" style="border: 1px solid #d6d6d6">
        </div>
    </div>
</div>
<section class="features-blocks">

    <div class="container">

        <div class="row vspace">
            <div class="col-sm-4">

                <div class="feature-block">
                    <h3>
                        <i class="entypo-cog"></i>
                        Settings
                    </h3>

                    <p>
                        Fifteen no inquiry cordial so resolve garrets as. Impression was estimating surrounded solicitude indulgence son shy.
                    </p>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="feature-block">
                    <h3>
                        <i class="entypo-gauge"></i>
                        Dashboard
                    </h3>

                    <p>
                        On am we offices expense thought. Its hence ten smile age means. Seven chief sight far point any. Of so high into easy.
                    </p>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="feature-block">
                    <h3>
                        <i class="entypo-lifebuoy"></i>
                        24/7 Support
                    </h3>

                    <p>
                        Extremely eagerness principle estimable own was man. Men received far his dashwood subjects new.
                    </p>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <hr />
            </div>
        </div>

    </div>

</section>


<section class="clients-logos-container">

    <div class="container">

        <div class="row">

            <div class="client-logos carousel slide" data-ride="carousel" data-interval="5000">

                <div class="carousel-inner">

                    <div class="item active">

                        <a href="#">
                            <img src="http://demo.neontheme.com/assets/frontend/images/client-logo-1.png" />
                        </a>

                        <a href="#">
                            <img src="http://demo.neontheme.com/assets/frontend/images/client-logo-2.png" />
                        </a>

                        <a href="#">
                            <img src="http://demo.neontheme.com/assets/frontend/images/client-logo-3.png" />
                        </a>

                        <a href="#">
                            <img src="http://demo.neontheme.com/assets/frontend/images/client-logo-4.png" />
                        </a>

                    </div>

                    <div class="item">

                        <a href="#">
                            <img src="http://demo.neontheme.com/assets/frontend/images/client-logo-2.png" />
                        </a>

                        <a href="#">
                            <img src="http://demo.neontheme.com/assets/frontend/images/client-logo-1.png" />
                        </a>

                        <a href="#">
                            <img src="http://demo.neontheme.com/assets/frontend/images/client-logo-4.png" />
                        </a>

                        <a href="#">
                            <img src="http://demo.neontheme.com/assets/frontend/images/client-logo-3.png" />
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>





@stop


<script src="{{ URL::asset('js/neon-slider.js') }}" id="script-resource-5"></script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-28991003-7']);
    _gaq.push(['_setDomainName', 'demo.neontheme.com']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>