@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Details
                            <a href="{{ url('users') }}" class="btn btn-primary float-right">Back</a>
                            <form action="{{ url('users/update-role/' . $users->id) }}" method="POST"
                                class="float-right mr-2">
                                @csrf
                                <select name="role" class="form-select" style="display:inline-block; width:auto;">
                                    <option value="0" {{ $users->role_as == '0' ? 'selected' : '' }}>User</option>
                                    <option value="1" {{ $users->role_as == '1' ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $users->role_as == '2' ? 'selected' : '' }}>Agent</option>
                                </select>
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="">Role</label>
                                <div class="p-2 border">
                                    {{ $users->role_as == '0' ? 'User' : ($users->role_as == '1' ? 'Admin' : 'Agent') }}
                                </div>

                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">First Name</label>
                                <div class="p-2 border">{{ $users->name }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">Email</label>
                                <div class="p-2 border">{{ $users->email }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
