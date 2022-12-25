@extends('layouts.app')

@section('title', 'List users')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="card-header pb-0">
                            <h6>Users table</h6>
                        </div>
                        <div class="px-4 pt-3">
                            <a href="{{ route('users.create') }}" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            @if (Session::has('status'))
                                <div class="alert alert-success" role="alert">
                                    <strong>Success!</strong> {{ session('status') }}
                                </div>
                            @endif
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <a
                                                href="{{ request()->fullUrlWithQuery(['sortBy' => 'name', 'sortType' => Request::get('sortType') === 'desc' ? 'asc' : 'desc']) }}">
                                                <i
                                                    class="ni ni-bold-{{ Request::get('sortType') === 'desc' ? 'down' : 'up' }}"></i>
                                                User
                                            </a>
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            <a
                                                href="{{ request()->fullUrlWithQuery(['sortBy' => 'role', 'sortType' => Request::get('sortType') === 'desc' ? 'asc' : 'desc']) }}">
                                                <i
                                                    class="ni ni-bold-{{ Request::get('sortType') === 'desc' ? 'down' : 'up' }}"></i>
                                                Role
                                            </a>
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets/img/logo.webp') }}"
                                                            class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-uppercase text-xs font-weight-bold mb-0">
                                                    {{ $user->role?->name }}</p>
                                            </td>
                                            <td class="align-middle">
                                                @if ($authUser->can('update-user') && !$user->hasRole('superadmin'))
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                @endif
                                                @if ($authUser->can('delete-user') && !$user->hasRole('superadmin'))
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="text-danger font-weight-bold text-xs bg-transparent border-0"
                                                            data-toggle="tooltip" data-original-title="Delete user">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No users found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="pagination mt-3">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
