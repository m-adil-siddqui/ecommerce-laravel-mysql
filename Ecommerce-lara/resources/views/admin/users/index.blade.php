@extends('admin.app')
@section('breadcrubms')
  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
 <li class="breadcrumb-item active" aria-current="page">users</li>
@endsection
@section('content')
  <div class="row d-block">
    <div class="col-sm-12">
      @if (session()->has('message'))
      <div class="alert alert-success">
        {{session('message')}}
      </div>
      @endif
    </div>
  </div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h2 class="h2">Users List</h2>

  <div class="btn-toolbar mb-2 mb-md-0">
    <a href="{{route('admin.profile.create')}}" class="btn btn-sm btn-outline-secondary">
      Add user
    </a>
  </div>
</div>
<div class="table-responsive">
  
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Slug</th>
        <th>role</th>
        <th>Address</th>
        <th>Thumbnail</th>
        <th>Date Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      
      @if(isset($users) && $users->count() > 0)

      @foreach($users as $u)
    	<tr>
       <td>{{$u->id}}</td>
       <td>{{$u->profile->name}}</td>
       <td>{{$u->email}}</td>
       <td>{{$u->profile->slug}}</td>
       <td>{{$u->role->name}}</td>
       
       <td>{{$u->profile->address}} {{@$u->getCountry()}},{{@$u->getState()}},{{@$u->getCity()}}</td>
       <td><img src="" alt=""></td>
        <td>{{$u->created_at}}</td>
        <td><a href="{{route('admin.profile.edit',$u->profile)}}" class="btn btn-sm btn-primary">Edit</a>| <a href="{{route('admin.profile.remove',$u->profile)}}" class="btn btn-sm btn-warning">Trash</a> | <button class="btn btn-sm btn-danger">Delete</button></td>
      </tr>
      @endforeach
      @else
      <tr>
        <td colspan="5"><h3>User Not Available</h3></td>
      </tr>
      @endif
    </tbody> 
   </table>
 </div>    
@endsection









