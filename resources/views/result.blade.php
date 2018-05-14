<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <title>@lang('madsms::msg.title')</title>
  </head>
  <body>
  	<style type="text/css">
  		.provider_logo { width:25px; float: right; }
  	</style>

    <h1 class="text-center mt-3 mb-3">@lang('madsms::msg.h1')</h1>

    <div class="text-center mb-3">
    	@for ($i = 1; $i < 11; $i++)
    		<a class="btn btn-primary" href="{{ url(Route::currentRouteName(), ['new_limit' => $i*10]) }}" role="button">{{ $i*10 }}</a>
    	@endfor
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

	<div class="container-fluid">
		<div class="row">
			@unless($results)
				<div class="alert alert-danger" role="alert">
			  		@lang('madsms::msg.no-results')
				</div>
			@else
				@foreach($results as $result)
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
						<div class="card mb-3">
						  <div class="card-body">
						    <h5 class="card-title">
						    	{{ $result->getPhone() }}
						    </h5>
						    <h6 class="card-subtitle mb-2 text-muted">
						    	id: {{ $result->reply()->getId() }}
						    	<span class="badge @if($result->reply()->getResult()==1) badge-dark @else badge-warning @endif float-sm-right">
						    		@lang('madsms::msg.status-'.$result->reply()->getResult())
						    	</span>
						    </h6>
						    <p class="card-text">
						    	{{ $result->reply()->getMessage() }}
						    </p>
						  </div>
						  <ul class="list-group list-group-flush">
						    <li class="list-group-item">
						    	<span class="badge badge-success float-sm-right">
						    		{{ $result->reply()->getParts() }} {{ $result->getMessageType() }}
						    	</span>
						    	@lang('madsms::msg.type-'.$result->reply()->getType())
						    </li>
						    <li class="list-group-item">
						    	<img class="provider_logo" src="{{ $result->reply()->getGatewayLogo() }}">
						    	{{ $result->reply()->getGatewayName() }}
						    </li>
						  </ul>
						</div>
					</div>
				@endforeach
			@endunless
		</div>
	</div>

  </body>
</html>
