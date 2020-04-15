@extends('layouts.app')
@section('title','Add Event')
@section('content')
    {!! Form::open( array('route' => 'event.store','id' => 'eventForm','class'=>'form-horizontal', 'enctype'=>'multipart/form-data') ) !!}
	
  		@include('admin/events/form', ['btn'=>'Save'])
  	
    {!! Form::close() !!}
@stop
