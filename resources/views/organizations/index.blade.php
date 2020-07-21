@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <h3 class="my-3">All Organizations</h3>
      @if ($organizations->isEmpty())
        <div class="card">
          <div class="card-body">
            <h3 class="text-center">No organizations have been uploaded</h3>
          </div>
        </div>
      @else
        <div class="card">
          <div class="card-body">
            <table class="table">
              <tr>
                <th>Organization Name</th>
                <th>Email</th>
                <th>Actions</th>
              </tr>
              <tr>
                @foreach ($organizations as $organization)
                  <tr>
                    <td>{{$organization->name}}</td>
                    <td>{{$organization->email}}</td>
                    <td>
                      <button class="btn btn-primary">
                        View Organization
                      </button>
                    </td>
                  </tr>  
                @endforeach
              </tr>
            </table>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
