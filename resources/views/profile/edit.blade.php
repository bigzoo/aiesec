@extends('layouts.app')

@section('content')

  <div class="container">
      <h1>Edit Profile</h1>
    	<hr>
  	<div class="row">

        <!-- edit form column -->
        <div class="col-md-9 personal-info">

          <form class="form-horizontal" role="form" method="post" action="/profile/update" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
              <label class="col-lg-3 control-label">Name:</label>
              <div class="col-lg-8">
                <input class="form-control" name="name" type="text" value="{{ Auth::user()->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email:</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="email" value="{{ Auth::user()->email }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Company:</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="company" value="{{ Auth::user()->company }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Title:</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="title" value="{{ Auth::user()->title }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Image:</label>
              <div class="col-lg-8">
                <input class="form-control" type="file" name="image">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Years:</label>
              <div class="col-lg-8">
                <select name="year-start">
                  @for ($i=1980; $i <= 2017; $i++)
                    <option
                    @if ($i==Auth::user()->getAttribute('year-start'))
                      {{ 'selected' }}
                    @endif
                    value="{{$i}}">{{ $i }}</option>
                  @endfor
                </select>
                to
                <select name="year-end">
                  @for ($i=1980; $i <= 2017; $i++)
                    <option
                    @if ($i==Auth::user()->getAttribute('year-end'))
                      {{ 'selected' }}
                    @endif
                    value="{{$i}}">{{ $i }}</option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label"></label>
              <div class="col-md-8">
                <input type="submit" class="btn btn-primary" value="Save Changes">
                <span></span>
                <input type="reset" class="btn btn-default" value="Cancel">
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
  <hr>

@endsection
