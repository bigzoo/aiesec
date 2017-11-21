@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome to your profile {{ Auth::user()->name }}
                    <div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" style="height: 180px; width: 100%; display: block;" src="{{ url("images/profileImages/" . Auth::user()->image) }}" data-holder-rendered="true">
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
