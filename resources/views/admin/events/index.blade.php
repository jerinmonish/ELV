@extends('layouts.app')
@section('title', trans('main.event_title'))
@section('content')
@php use App\Helpers\LERHelper; @endphp
<style type="text/css">
    .help-block{
        color: red !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    List My {{ trans('main.event_title') }}
                    <a href="#" class="btn btn-primary" id="setPopUp" data-toggle="modal" data-target="#myModal">{{ trans('main.bulk_upload') }}</a>

                    <a href="{{ route('event.create') }}" class="btn btn-primary float-right">Create Event</a>
                    <a href="{{ route('list_events') }}?status=future_events" class="btn btn-success float-right" style="margin-right: 10px !important;">Future {{ trans('main.event_title') }}</a> 
                    <a href="{{ route('list_events') }}?status=past_events" class="btn btn-danger float-right" style="margin-right: 10px !important;">Past {{ trans('main.event_title') }}</a> 
                </div>
                <div class="card-body">
                    
                    @if ($errors->has('upload_file'))
                        <span class="help-block" style="display: inline !important;">
                            <strong>{{ $errors->first('upload_file') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('0'))
                        <span class="help-block" style="display: inline !important;">
                            <strong>{{ $errors->first('0') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('event_description'))
                        <span class="help-block" style="display: inline !important;">
                            <strong>{{ $errors->first('event_description') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('event_scheduled_date'))
                        <span class="help-block" style="display: inline !important;">
                            <strong>{{ $errors->first('event_scheduled_date') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('event_scheduled'))
                        <span class="help-block" style="display: inline !important;">
                            <strong>{{ $errors->first('event_scheduled') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('event_status'))
                        <span class="help-block" style="display: inline !important;">
                            <strong>{{ $errors->first('event_status') }}</strong>
                        </span>
                    @endif

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

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('main.bulk_upload') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    {!! Form::open( array('route' => 'importExcelSave','id' => 'eventForm','class'=>'form-horizontal', 'enctype'=>'multipart/form-data') ) !!}
                        {!! Form::token() !!}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.bulk_file') }}</label>
                            <div class="col-md-6">
                                {!! Form::file('upload_file', array('class'=>'', 'id' => 'upload_file','required'=>'required','accept'=>'.csv')) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-lg-offset-2 col-md-7">
                                {!! Form::submit('Upload',['class' => 'btn btn-primary float-right']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('list_eventsadmin') !!}",
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
