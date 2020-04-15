@extends('layouts.app')
@section('title','Edit Event')
@section('content')
    {!! Form::open(array('route' => array('event.update',$event->id),'method'=>'PUT','id' => 'eventEditForm','class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}

    @include('admin/events/form', ['btn'=>'Update'])
    
    {!! Form::close() !!}
@stop
