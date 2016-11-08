@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">


                <div class="panel">
                    <div class="panel-heading"><h2>Image was uploaded</h2></div>

                    <div class="panel-body">
                        <p>
                            <img src="{{ asset("img/small/".$img->file_name) }}" alt="{{ $img->name }}">
                        </p>
                        <p>
                            <b>Direct path Path:</b>. {{ link_to(asset('storage/uploads/images/' . $img->file_name),asset('storage/uploads/images/' . $img->file_name)) }}
                        </p>
                        <p>
                            <b>Cached Paths:</b><br>

                            {{ link_to(asset("img/small/".$img->file_name),asset("img/small/".$img->file_name)) }}<br>
                            {{ link_to(asset("img/medium/".$img->file_name),asset("img/medium/".$img->file_name)) }}<br>
                            {{ link_to(asset("img/large/".$img->file_name),asset("img/large/".$img->file_name)) }}<br>
                            {{ link_to(asset("img/original/".$img->file_name),asset("img/original/".$img->file_name)) }}<br>
                            {{ link_to(asset("img/download/".$img->file_name),asset("img/download/".$img->file_name)) }}<br>


                        </p>

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
