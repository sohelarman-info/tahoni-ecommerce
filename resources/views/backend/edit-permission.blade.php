@extends('backend.master')
@section('role-manager','active show-sub')
@section('role','active')
@section('content')
@if (session('CategoryAdd'))
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    {{ session('CategoryAdd') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="row row-sm">
    <div class="col-xl-12">
      <div class="card pd-10 pd-sm-25 form-layout form-layout-4">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Permission Change of {{ $user->name }}</h6>
        <form action="{{ route('PermissionChangeToUser') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0">
                <thead>
                    <tr>
                    <th width="10%" class="text-center">SL</th>
                    <th width="10%" class="text-center">Select</th>
                    <th>Permission</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $key => $permission)
                    <tr>
                        <td width="10%" class="text-center">{{ $loop->index + 1 }}</td>
                        <td width="10%" class="text-center">
                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}" {{ $user->hasPermissionTo($permission->name) ? "checked" : '' }}></input>
                        </td>
                        <td>{{ $permission->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <div class="float-right">
                    <input style="cursor:pointer" class="btn btn-primary text-right m-2" type="submit" value="Change Permission">
                </div>
            </div>
        </form>
        </div><!-- card -->
    </div><!-- col-12 -->
  </div><!-- row -->

@endsection
