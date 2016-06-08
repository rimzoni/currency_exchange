<!DOCTYPE html>
<html>
    <head>
        <title>MoneyFly</title>

        {!! Html::style('css/app.css') !!}

        {!! Html::script('js/jquery.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
          <!--AngularJS-->
        {!! Html::script('js/angular.min.js') !!}
        {!! Html::script('js/app.js') !!}

        <style>
		body { padding-top: 60px; }
		  @media (max-width: 979px) {
		body { padding-top: 0px; }
		}
        </style>
    </head>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <p class="navbar-brand">Money Transfer</p>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/">Transfer Money</a></li>
                    <li><a href="/rates">Exchange rates</a></li>
                    <li><a href="/orders">Orders</a></li>
                    <li><a href="/surcharges">Surcharge</a></li>
                    <li><a href="/actions">Actions</a></li>
                    <li><a href="/emails">Emails</a></li>
                    <li><a href="/discounts">Discounts</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <body>
        <div class="container">
            @yield('content')
        </div><!-- /.container -->
    </body>
</html>
