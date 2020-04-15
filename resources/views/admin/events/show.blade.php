@php
    use App\Helpers\LERHelper;
@endphp
@extends('layouts.app')
@section('title','View Event')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ @$event->event_name }} - View {{ trans('main.event_title') }}
                    <a href="{{route('event.index')}}" class="btn btn-primary float-right">List {{ trans('main.event_title') }}</a>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="form_validation">
                        <div class="form-group row">
                            <b for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.event_name') }}</b>
                            <div class="col-md-6">
                               {{ @$event->event_name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <b for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.event_description') }}</b>
                            <div class="col-md-6">
                               {{ @$event->event_description }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <b for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.event_scheduled') }}</b>
                            <div class="col-md-6">
                               {{ @$event->event_scheduled_date.' '.@$event->event_scheduled }}
                            </div>
                        </div>
                        
                        @if(!empty(@$event->event_fname))
	                        <div class="form-group row">
	                            <b for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.event_fname') }}</b>
	                            <div class="col-md-6">
	                                <a href="{{ asset('/public/uploads/events') }}/{{ @$event->event_fname }}" target="_blank">View {{ @$event->event_fname }}</a>
	                            </div>
	                        </div>
                        @endif
                        
                        <div class="form-group row">
                            <b for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.status') }}</b>
                            <div class="col-md-6">
                                {{ @$event->event_status }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <b for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.created_at') }}</b>
                            <div class="col-md-6">
                               {{ @$event->created_at }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <b for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.updated_at') }}</b>
                            <div class="col-md-6">
                               {{ @$event->updated_at }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <b for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.user_viewed') }}</b>
                            <div class="col-md-6">
                               <a href="{{ route('viewers_list',array(LERHelper::encryptUrl(@$event->id))) }}">{{ @$viewedCont->count() }}</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <b for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.no_of_likes') }}</b>
                            <div class="col-md-6">
                               <i class="fa fa-thumbs-up" id="setDataLk" data-lk="1"></i> {{ @$viewedLCont->count() }}
                            </div>
                        </div>
                        
                        </div>
                        <div class="form-group row">
                            <b for="name" class="col-md-4 col-form-label text-md-right"></b>
                            <div class="col-lg-offset-2 col-md-7">
                                <a href="{{ route('event.edit',array(LERHelper::encryptUrl(@$event->id))) }}" class="btn btn-primary">Edit Event</a>
                                <a href="{{ route('event.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
