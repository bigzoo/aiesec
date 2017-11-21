@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <a href="{{ url('/') }}" style="color: inherit;">
                <div class="panel-heading text-center">AIESEC Alumni's</div>
              </a>
            </div>
        </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
          <form action="/" id="search-form" method="get">
            <div class="input-group">
              <div class="input-group-btn search-panel">
                <button type="button" class="btn btn-default" disabled>Search</button>
              </div>
              <input type="text" class="form-control" name="q" placeholder="Search term..." value="{{ $q or '' }}">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><span class="no glyphicon glyphicon-search"></span></button>
              </span>
            </div>
        </form>
        </div>
      </div>
    </div>
    <br>
    <div class="center" id="users" style="margin: 0 auto; width: 75%;">
      @forelse ($users as $user)
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail"> <img style="height: 180px; width: 100%; display: block;" src="{{ url("images/profileImages/" . $user->image) }}" data-holder-rendered="true">
            <div class="caption">
              <h3>{{ $user->name }}</h3>
              <small>{{ $user->email }}</small>
              <p>From {{ $user->getAttribute('year-start') }} to {{ $user->getAttribute('year-end') }}</p>
              <p><b>{{ $user->title }}</b> at <b>{{ $user->company }}</b></p>
            </div>
          </div>
        </div>
      @empty
        <div class="">
          <h3>No one was found! Invite by adding the email in the form below.</h3>
        </div>
      @endforelse
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4 ">

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="{{ $users->url(1) }}">First</a></li>
                    <li class="page-item {{ $users->currentPage() == '1' ? 'disabled' : '' }}"><a class="page-link" href="{{ $users->previousPageUrl() }}">Previous</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">{{  $users->currentPage() }}</a></li>
                    <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}"><a class="page-link" href="{{ $users->nextPageUrl()  }}">Next</a></li>
                    <li class="page-item"><a class="page-link" href="{{ $users->url($users->lastPage()) }}">Last</a></li>
                </ul>
            </nav>
            <form class="" action="/profile/invite" method="post">
                {{ csrf_field() }}
                <div class="sandbox">
                    <label for="select-to-selectized">Invite Some People:</label>
                    <select name="people[]" id="select-to" class="contacts selectized" placeholder="Enter email addresses" multiple="multiple" tabindex="-1" style="display: none;">
                    </select>
                </div>
                <button type="submit" name="button" class="btn btn-primary">Send Invites</button>
            </form>
        </div>
    </div>
  </div>
@endsection
@section('styles')
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.bootstrap3.css" />
  <link rel="stylesheet" href"{{ asset('css/selectize-custom.css')}}">
@endsection
@section('scripts')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/selectize-custom.js') }}"></script>
@endsection
