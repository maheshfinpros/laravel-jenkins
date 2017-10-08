@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.roles.management'))

@section('page-header')
    <!-- <h5 class="mb-4">{{ __('labels.backend.access.roles.management') }}</h5> -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.roles.management') }}
                </h4>
                <div class="small text-muted">
                    Roles Management Dashboard
                </div>
            </div>
            <!--/.col-->
            <div class="col-sm-7 pull-right">
                @include('backend.auth.role.includes.header-buttons')
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <div class="row mt-4">
            <div class="col">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>{{ __('labels.backend.access.roles.table.role') }}</th>
                        <th>{{ __('labels.backend.access.roles.table.permissions') }}</th>
                        <th>{{ __('labels.backend.access.roles.table.number_of_users') }}</th>
                        <th>{{ __('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ ucfirst($role->name) }}</td>
                                <td>
                                    @if ($role->permissions->count())
                                        @foreach ($role->permissions as $permission)
                                            {{ ucwords($permission->name) }}
                                        @endforeach
                                    @else
                                        None
                                    @endif
                                </td>
                                <td>{{ $role->users->count() }}</td>
                                <td>{!! $role->action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $roles->total() !!} {{ trans_choice('labels.backend.access.roles.table.total', $roles->total()) }}
                </div>
            </div>
            <div class="col-5">
                <div class="float-right">
                    {!! $roles->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection