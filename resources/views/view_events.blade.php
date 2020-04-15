@extends('layouts.app')
@section('title', trans('main.event_title'))
@section('content')
@php use App\Helpers\LERHelper; @endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ @$event->event_name }}
                    <a href="{{ route('list_events') }}" class="btn btn-info float-right">{{ trans('main.event_title') }}</a> 
                </div>
                <div class="card-body">
                    @if(!empty($event))
                        <div style="" align="center">
                            @if(!empty(@$event->event_fname))
                                <video width="320" height="240" controls>
                                  <source src="{{ asset('/public/uploads/events') }}/{{ @$event->event_fname }}">
                                  Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>
                        <div class="w-25">
                            <i onclick="setLikefn(this)" class="fa fa-thumbs-up" id="setDataLk" data-lk="{{ @$liked_video->count() }}" data-eveid="{{ @$event->id }}">
                                <span id="setLVal">{{ @$liked_video->count() }}</span>
                            </i>
                        </div>
                        <div>
                            <p>{{ @$event->event_description }}</p>
                        </div>
                    @else
                        No Data
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function setLikefn(x) {
    var existingLike = $(x).attr('data-lk');
    $("#setLVal").text("");
    formData = {
        'user_id':"{{ @Auth::user()->id }}",
        'event_id':"{{ @$event->id }}",
        "_token": "{{ csrf_token() }}",
    }
    $.ajax({
        url: "{{ route('like_video') }}",
        type: "POST",
        data: formData,
        success: function(data){
            var jsonData = JSON.parse(data);
            $("#setLVal").text(jsonData.get_liked);
            $("#setDataLk").attr('data-lk',jsonData.get_liked);
        }
    });
}
</script>
@endsection
