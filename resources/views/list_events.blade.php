@extends('layouts.app')
@section('title', trans('main.event_title'))
@section('content')
@php use App\Helpers\LERHelper; $evStatus = isset($_GET['status']) ? $_GET['status'] : ''; @endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if($evStatus == "past_events")
                        {{ "Past Events" }}
                    @elseif($evStatus == "future_events")
                        {{ "Future Events" }}
                    @else
                        {{ "Current Events" }}
                    @endif
                    @if(Auth::user()->role == "admin")
                        <a href="{{ route('event.create') }}" class="btn btn-primary float-right">Create Event</a>
                    @else
                        <a href="{{ route('list_events') }}" class="btn btn-info float-right">{{ trans('main.event_title') }}</a> 
                    @endif
                    <a href="{{ route('list_events') }}?status=future_events" class="btn btn-success float-right" style="margin-right: 10px !important;">Future {{ trans('main.event_title') }}</a> 
                    <a href="{{ route('list_events') }}?status=past_events" class="btn btn-danger float-right" style="margin-right: 10px !important;">Past {{ trans('main.event_title') }}</a> 
                </div>
                <div class="card-body">
                    <table class="datatable mdl-data-table dataTable" cellspacing="0" width="100%" role="grid" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>{{ trans('main.event_name') }}</th>
                                <th>{{ trans('main.event_scheduled') }}</th>
                                <th>{{ trans('main.created_at') }}</th>
                                <th>{{ trans('main.updated_at') }}</th>
                                <th>{{ trans('main.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var get_vstatus = "{{ $evStatus }}";
        var xUrl = "";
        if(get_vstatus == "past_events"){
            xUrl = "{!! route('list_past_events') !!}";
        } else if(get_vstatus == "future_events"){
            xUrl = "{!! route('list_future_events') !!}";
        } else {
            xUrl = "{!! route('list_todays_events') !!}";
        }
        $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: xUrl,
            columns: [
                        { data: 'event_name', name: 'event_name' },
                        { data: 'event_scheduled', name: 'event_scheduled' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'updated_at', name: 'updated_at' },
                        { data: 'viewLink', name: 'viewLink' },
                     ]
        });
    });
</script>
@endsection
