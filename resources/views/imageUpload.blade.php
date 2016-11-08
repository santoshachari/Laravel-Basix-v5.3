@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Form::open(array('url'=>'image/upload','method'=>'POST', 'files'=>true)) !!}

                <div class="panel">
                    <div class="panel-heading"><h2>Sample Image Upload</h2></div>

                    <div class="panel-body">
                        <div class="control-group">
                            <div class="controls">
                                {!! Form::file('image') !!}
                                <p class="errors">{!!$errors->first('image')!!}</p>
                                @if(Session::has('error'))
                                    <p class="errors">{!! Session::get('error') !!}</p>
                                @endif
                            </div>
                        </div>
                        <div id="success"> </div>
                        {!! Form::submit('Submit', array('class'=>'send-btn')) !!}
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
