@extends('layouts.admin_layout')

@section('title','Głowna')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-12">
        <div class="cart bg-info rounded">
          <div class="row">
            <div class="col-lg-6 col-12">
              <h3 class="p-2">{{$postsOllCount}}</h3>
            </div>
            <div class="col-lg-6 col-12 d-flex justify-content-end"><i class="fa fa-chart-bar p-2"></i></div>
          </div>
          <h5 class="p-2">Postów</h5>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12">
        <div class="cart bg-success rounded">
          <div class="row">
            <div class="col-lg-6 col-12">
              <h3 class="p-2">{{$postPublicCount}}</h3>
            </div>
            <div class="col-lg-6 col-12 d-flex justify-content-end"><i class="p-2 fas fa-rss"></i></div>
          </div>
          <h5 class="p-2">Postów opublikowanych</h5>
        </div>
      </div>

 

    </div>
  </div>
</section>
@endsection