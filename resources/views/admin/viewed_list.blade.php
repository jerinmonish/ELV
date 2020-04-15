@extends('layouts.app')
@section('title', trans('main.views_list'))
@section('content')
@php
    use App\Helpers\LERHelper;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('main.views_list') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>{{ trans('main.user_name') }}</th>
                            <th>{{ trans('main.watched_at') }}</th>
                        </tr>
                        @foreach($user_list as $list)
                            <tr>
                                <td>{{ LERHelper::getFullName($list->user_id) }}</td>
                                <td>{{ LERHelper::formatDate($list->created_at) }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="{{ route('event.index') }}" class="btn btn-primary float-right">List Events</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
