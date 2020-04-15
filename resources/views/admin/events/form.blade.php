@php
    use App\Helpers\LERHelper;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Add {{ trans('main.event_title') }}
                    <a href="{{route('event.index')}}" class="btn btn-primary float-right">List {{ trans('main.event_title') }}</a>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="form_validation">
                        {!! Form::token() !!}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.event_name') }}</label>
                            <div class="col-md-6">
                                {!! Form::text('event_name', @$event->event_name, array('class'=>'form-control', 'id' => 'event_name','placeholder' => 'Event Name','maxlength'=>'100')) !!}
                                @error('event_name')
                                    <span class="invalid-feedback" role="alert" style="display: inline !important;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.event_description') }}</label>
                            <div class="col-md-6">
                                {!! Form::textarea('event_description', @$event->event_description, array('class'=>'form-control', 'id' => 'event_description','placeholder' => 'Event Description','maxlength'=>'500')) !!}
                                @error('event_description')
                                    <span class="invalid-feedback" role="alert" style="display: inline !important;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.event_fname') }}</label>
                            <div class="col-md-4">
                                {!! Form::file('event_fname', array('class'=>'form-control', 'id' => 'event_fname','accept'=>'video/mp4,video/x-m4v,video/*')) !!}
                                {!! Form::hidden('existing_event_fname', @$event->event_fname, array('class'=>'form-control')) !!}
                                @error('event_fname')
                                    <span class="invalid-feedback" role="alert" style="display: inline !important;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                @if(!empty($event->event_fname))
                                    <a href="{{ asset('/public/uploads/events') }}/{{ $event->event_fname }}" target="_blank" class="btn btn-sm btn-primary">View Existing File</a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.event_scheduled') }}</label>
                            <div class="col-md-6">
                                {!! Form::text('event_scheduled_date', (@$event->event_scheduled_date) ? LERHelper::manuFormatDate(@$event->event_scheduled_date): '', array('class'=>'form-control', 'id' => 'event_scheduled_date','placeholder' => 'Ex: 12-12-2020 9:30','maxlength'=>'100')) !!}
                                @error('event_scheduled_date')
                                    <span class="invalid-feedback" role="alert" style="display: inline !important;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.event_scheduled_time') }}</label>
                            <div class="col-md-6">
                                {!! Form::text('event_scheduled', (@$event->event_scheduled) ? LERHelper::formatMysqlTime(@$event->event_scheduled) : '', array('class'=>'form-control', 'id' => 'event_scheduled','placeholder' => 'Ex: 12-12-2020 9:30','maxlength'=>'100')) !!}
                                @error('event_scheduled')
                                    <span class="invalid-feedback" role="alert" style="display: inline !important;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('main.status') }}</label>
                            <div class="col-md-6">
                                <input name="event_status" type="radio" id="radio_3" value="Active" <?php if(@$event->event_status == 'Active' ){ echo 'checked';} ?> checked="checked" />
                                <label for="radio_3">Active</label>

                                <input name="event_status" type="radio" id="radio_4" value="Inactive" <?php if(@$event->event_status == 'Inactive' ){ echo 'checked';} ?> />
                                <label for="radio_4">Inactive</label>
                                @if ($errors->has('event_status'))
                                    <span class="help-block" style="display: inline !important;">
                                        <strong>{{ $errors->first('event_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-lg-offset-2 col-md-7">
                                {!! Form::submit((@$event->id) ? 'Update' : 'Save',['class' => 'btn btn-primary']) !!}
                                <a href="{{ URL::to('event') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#event_scheduled_date').datetimepicker({
            timepicker:false,
            format: 'd-m-Y',
            minDate:0,
            lang: 'en',
            // formatTime: 'g:i',
        });

        $('#event_scheduled').datetimepicker({
            datepicker:false,
            format:'H:i'
        });

        $("#event_scheduled_date").attr( 'readOnly' , 'true' );

        //$("#event_scheduled").attr( 'readOnly' , 'true' );
    });
</script>