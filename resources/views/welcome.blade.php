@extends('layouts.app')
@section('title') Home @stop

@section('content')
    <div class="container">
        <div class="page-header">
            <h3>Make your long URLs short with this web URL shortening tool for <b>free</b>.</h3>
        </div> <!--/.page-header-->
        <div class="panel panel-info">
            <div class="panel-heading">
                <span class="panel-title">
                    <h3>Shorten your URL</h3>
                </span>
            </div><!--/.panel-header-->
            <div class="panel-body">
                <div class="well well-sm">
                    <b>Instructions:</b>
                    <p class="text-muted">
                        We create randomly coded URLs if an alias is not provided by the user, so it might result into: <b><a href="#!">http://miniurl.com/random</a></b> or like <b><a href="#!">http://miniurl.com/abcde</a></b>
                    </p>
                </div>
                <form action="{{ route('url.store') }}" class="form-horizontal" accept-charset="utf8" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('originalUrl') ? ' has-error' : '' }}">
                        <label for="originalUrl" class="control-label col-md-2">Your lengthy URL here</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" required value="{{ old('originalUrl') }}"
                                    name="originalUrl" id="originalUrl"
                                    placeholder="https://example-website.com/?page=9&guest='y'&article='something-lengthy'" 
                            >
                            @if ($errors->has('originalUrl'))
                                <span class="help-block">
                                    <b>{{ $errors->first('originalUrl') }}</b>
                                </span>
                            @endif
                        </div>
                    </div><!--/.form-group-->

                    <div class="form-group{{ $errors->has('originalUrl') ? ' has-error' : '' }}">
                        <label for="urlAlias" class="control-label col-md-2">Your URL alias here</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ old('urlAlias') }}"
                                    name="urlAlias" id="urlAlias" 
                                    placeholder="your-alias-here or your alias here" 
                                    minlength="5" maxlength="30" 
                            >
                            @if ($errors->has('urlAlias'))
                                <span class="help-block">
                                    <b>{{ $errors->first('urlAlias') }}</b>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-success col-md-offset-2" type="submit" required>
                               <b>Minify my URL!</b>
                            </button>
                        </div> <!--/.col-md-12-->
                    </div>
                </form>
            </div><!--/.panel-body-->
        </div><!--/.panel.panel-default-->
        <div class="panel panel-info">
            <div class="panel-heading">
                <span class="panel-title">
                    <h3>Are you tired of ...</h3>
                </span>
            </div>
            <div class="panel-body">
                <p class="text-muted">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Super lengthy URLs like this: 
                            <br><br>
                            <b><i>
                            https://www.google.com/search?source=hp&ei=k93-WdfDA4y90ATNyIf4Dw&q=world+peace&oq=world+peace&gs_l=psy-ab.3..0l6j0i20i263k1l2j0l2.874.7094.0.7985.26.19.6.0.0.0.319.2184.0j10j2j1.14.0....0...1.1.64.psy-ab..6.20.2345.6..35i39k1j0i131k1.128.VEGnOFQNs9g</i></b>
                        </li>
                        <li class="list-group-item">
                            Your URLs are not that trustworthy to others because it's vague to where it will redirect to?
                        </li>
                        <li class="list-group-item">
                            The recipient must type long URLs (in case they can't copy + paste from their machine/device!) that you send?
                        </li>
                    </ul>
                </p> <br>
                <h3>
                    <b>Then we can turn your URL to short and comprehendable URL!</b>
                </h3>
                <ul class="list-group">
                    <li class="list-group-item">
                        <b>From your super lengthy URL like this:</b> <br><br>
                        <i>
                            https://www.google.com/search?source=hp&ei=k93-WdfDA4y90ATNyIf4Dw&q=world+peace&oq=world+peace&gs_l=psy-ab.3..0l6j0i20i263k1l2j0l2.874.7094.0.7985.26.19.6.0.0.0.319.2184.0j10j2j1.14.0....0...1.1.64.psy-ab..6.20.2345.6..35i39k1j0i131k1.128.VEGnOFQNs9g
                        </i>

                        <br><br>
                        <b>into this:</b> <i class="text-muted">http://mini-url/world-peace</i> <br><br>
                        Which is more comprehendable and easily can be typed!
                    </li>
                </ul>
            </div> <!--/.panel-body-->
        </div><!--/.panel.panel-default-->
    </div><!--/.container-->
@stop