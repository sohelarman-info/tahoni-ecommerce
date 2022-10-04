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
    <div class="col-xl-8">
      <div class="card pd-10 pd-sm-25 form-layout form-layout-4">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-5 text-center">User Permission</h6>
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0">
                <thead>
                    <tr>
                    <th class="text-center">SL</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Permission</th>
                    <th>Created At</th>
                    <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                    <tr>
                        <td class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $user->name ?? 'N/A' }}</td>
                        <td>
                            @foreach ($user->getRoleNames() as $ur)
                                <li style="list-style: none">{{ $ur }}</li>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($user->getAllPermissions() as $permission)
                            <li style="list-style: none">{{ $permission->name }}</li>
                            @endforeach
                        </td>
                        <td>{{ $user->created_at != null ? $user->created_at->diffForHumans() : 'N/A' }}</td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="{{ route('PermissionChange', $user->id) }}">Permission Edit</a>
                            <a class="btn btn-danger" href="">Permission Delet</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div><!-- card -->
      <div class="card pd-10 pd-sm-25 form-layout form-layout-4">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-5 text-center">Role Managment</h6>
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0">
                <thead>
                    <tr>
                    <th class="text-center">SL</th>
                    <th>Name</th>
                    <th>Permission</th>
                    <th>Guard Name</th>
                    <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                    <tr>
                        <td class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $role->name ?? 'N/A' }}</td>
                        <td>
                            @foreach ($role->getPermissionNames() as $permission)
                            <li style="list-style: none">{{ $permission }}</li>
                            @endforeach
                        </td>
                        <td>{{ $role->guard_name ?? 'N/A' }}</td>
                        <td>{{ $role->created_at != null ? $role->created_at->diffForHumans() : 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div><!-- card -->
      <div class="card pd-10 pd-sm-25 form-layout form-layout-4">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-5 text-center">Permission</h6>
        <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th class="text-center">SL</th>
                  <th>Name</th>
                  <th>Guard Name</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($permissions as $key => $permission)
                  <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $permission->name ?? 'N/A' }}</td>
                    <td>{{ $role->guard_name ?? 'N/A' }}</td>
                    <td>{{ $permission->created_at != null ? $permission->created_at->diffForHumans() : 'N/A' }}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
      </div><!-- card -->
    </div><!-- col-4 -->
    <div class="col-xl-4 mg-t-25 mg-xl-t-0">
      <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Role Add To User</h6>
        <form action="{{ route('RoleAddToUser') }}" method="POST">
            @csrf
            <div class="row row-xs">
                <div class="col-sm-8 col-md-12 mg-t-10 mg-sm-t-0">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">User: <span class="tx-danger">*</span></label>
                        <select name="user_id" id="user_id" class="form-control select2 select2-hidden-accessible">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>

                            @endforeach
                        </select>
                        <label class="form-control-label">User Role: <span class="tx-danger">*</span></label>
                        <select name="user_role" id="user_role" class="form-control select2 select2-hidden-accessible">
                            @foreach ($roles as $key => $role)
                            <option value="{{ $role->name }}">{{ $role->name ?? 'N/A' }}</option>

                            @endforeach
                        </select>
                    </div>
                    @error('role_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!-- row -->
            <div class="row row-xs mg-t-10">
            <div class="col-md-12 mg-l-auto">
                <div class="form-layout-footer text-center">
                <button class="btn btn-info" style="cursor: pointer">Submit Form</button>
                </div><!-- form-layout-footer -->
            </div><!-- col-8 -->
            </div>
        </form>
      </div><!-- card -->
      {{--  <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">User Permission</h6>
        <form action="{{ route('RoleAddToUser') }}" method="POST">
            @csrf
            <div class="row row-xs">
                <div class="col-sm-8 col-md-12 mg-t-10 mg-sm-t-0">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">User: <span class="tx-danger">*</span></label>
                        <select name="user_id" id="user_id" class="form-control select2 select2-hidden-accessible">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>

                            @endforeach
                        </select>
                        <label class="form-control-label">User Role: <span class="tx-danger">*</span></label>
                            @foreach ($permissions as $key => $permission)
                            <li style="list-style: none">
                                <input type="checkbox" name="user_permission[]" value="{{ $permission->name }}"> {{ $permission->name ?? 'N/A' }}</input>
                            </li>

                            @endforeach
                    </div>
                    @error('role_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!-- row -->
            <div class="row row-xs mg-t-10">
            <div class="col-md-12 mg-l-auto">
                <div class="form-layout-footer text-center">
                <button class="btn btn-info" style="cursor: pointer">Submit Form</button>
                </div><!-- form-layout-footer -->
            </div><!-- col-8 -->
            </div>
        </form>
      </div><!-- card -->  --}}
      <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Role Add</h6>
        <form action="{{ route('RoleAddToPermission') }}" method="POST">
            @csrf
            <div class="row row-xs">
                <div class="col-sm-8 col-md-12 mg-t-10 mg-sm-t-0">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">User Role: <span class="tx-danger">*</span></label>
                        <select name="role_name" id="role_name" class="form-control select2 select2-hidden-accessible mg-b-10">
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>

                            @endforeach
                        </select>
                        <label class="form-control-label">User Permission: <span class="tx-danger">*</span></label>
                        <select name="permission_name" id="permission_name" class="form-control select2 select2-hidden-accessible">
                            @foreach ($permissions as $key => $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name ?? 'N/A' }}</option>

                            @endforeach
                        </select>
                    </div>
                    @error('role_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!-- row -->
            <div class="row row-xs mg-t-10">
            <div class="col-md-12 mg-l-auto">
                <div class="form-layout-footer text-center">
                <button class="btn btn-info" style="cursor: pointer">Submit Form</button>
                </div><!-- form-layout-footer -->
            </div><!-- col-8 -->
            </div>
        </form>
      </div><!-- card -->
      <div class="card">

        @can('View articles')
            <p>Who will seen this Article Permission</p>
        @endcan
        @role('Admin')
            <p>Who will seen this Article Permission Role</p>
        @endrole
      </div>
    </div><!-- col-6 -->
  </div><!-- row -->

@endsection
