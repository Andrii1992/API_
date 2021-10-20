@extends('layouts.admin_layout')

@section('title','Użytkownicy')

@section('content')

<section class="content pt-2">
  <div class="container-fluid">
    <form class="row" action="{{ route('usersAdmin') }}" method="GET" role="form">
      <div class="input-group mb-3 col-12">
        @if(isset($search))
        <input name="search" type="text" class="form-control" placeholder="Wyszukaj użytkowników" aria-describedby="basic-addon2" value="{{ $search }}">
        @else
        <input name="search" type="text" class="form-control" placeholder="Wyszukaj użytkowników" aria-describedby="basic-addon2">
        @endif
        <div class="input-group-append">
          <button class="btn btn-success" type="submit">Wyszukaj</button>
        </div>
      </div>

      <div class="input-group mb-3 col-lg-4 col-12 d-flex align-items-center">
        <label for="sort" class="">Kolejność</label>
        <select name="sort" class="custom-select ml-4">

          @if($sort === "desc")
          <option value="desc" selected>malejąca</option>
          <option value="asc">rosnąca</option>
          @else
          <option value="desc">malejąca</option>
          <option value="asc" selected>rosnąca</option>
          @endif
        </select>
      </div>
      <div class="input-group mb-3 col-lg-4 col-12 d-flex align-items-center">
        <label for="by" class="">Sortuj po</label>
        <select name="by" class="custom-select ml-4">
          @if($by === "created_at")
          <option value="created_at" selected>dacie utworzenia</option>
          <option value="name">imieniu</option>
          @else
          <option value="created_at">dacie utworzenia</option>
          <option value="name" selected>imieniu</option>
          @endif
        </select>
      </div>
      <div class="input-group mb-3 col-lg-4 col-12 d-flex align-items-center">
        <label for="records" class="">Na stronie rekordów</label>
        <select name="records" class="custom-select ml-4">
          @if($records === "10")
          <option value="10" selected>10</option>
          <option value="15">15</option>
          @else
          <option value="10">10</option>
          <option value="15" selected>15</option>
          @endif
        </select>
      </div>


    </form>
    @if(session()->has('message'))
    @if(session('message'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Użytkownik został pomyślnie usunięty
      @else
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Usunięcie nie powiodło się
        @endif
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if($dane->count() != 0)
      <p class="badge badge-light">Liczba rekordów: <span class="badge badge-info "> {{$dane->total()}}</span></p>

      <div class="table-responsive rounded-top">
        <table class="table table-striped table-secondary rounded-bottom">
          <thead>
            <tr>
              <th scope="col">Imie</th>
              <th scope="col">Email</th>
              <th scope="col">Data utworzenia</th>
              <th scope="col">Data aktualizacji</th>
              <th scope="col">Rola</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>

            @foreach ($dane as $dat)
            <tr>
              <td>{{ $dat->name }}</td>
              <td>{{ $dat->email }}</td>
              <td>{{ $dat->created_at }}</td>
              <td>{{ $dat->updated_at }}</td>
              <td>

                @if($dat->roles->count() !=0)
                @if($dat->roles[0]->name==="admin")
                <div class="badge badge-success"> {{$dat->roles[0]->name}}</div>
              </td>
              @else
              <div class="badge badge-info"> <?= str_replace('user', 'Użytkownik', $dat->roles[0]->name) ?> </div>
              </td>
              @endif
              @else
              <div class="badge badge-warning"> brak </div>
              @endif
              </td>
              <td><a class="text-dark d-flex justify-content-center" href="{{ route('deleteUserAdmin', ['id' => $dat->id]) }}" onclick="return confirm('Czy napewno usunąć?')"><i class="far fa-trash-alt"></i></span></a></td>
              <td><a class="text-dark d-flex justify-content-center" href="{{ route('editUserAdmin', ['id' => $dat->id]) }}"><i class="fas fa-edit"></i></span></a></td>
              <!--
              <td><a class="text-dark d-flex justify-content-center" href="{{ URL::to('admin/uzytkowniki/usun/' .  $dat->id  )}}" onclick="return confirm('Czy napewno usunąć?')"><i class="far fa-trash-alt"></i></span></a></td>
              <td><a class="text-dark d-flex justify-content-center" href="{{ URL::to('admin/uzytkowniki/edycja/' .  $dat->id  )}}"><i class="fas fa-edit"></span></a></td> -->
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      {{$dane->links('pagination::bootstrap-4') }}

      @else
      <h1 class="text-center">Brak użytkowników</h1>
      @endif
    </div>
  </div>
  @endsection('content')