<!-- example select2, single !-->
<!-- Bookable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bookable_id', __('models/bookableBookings.fields.bookable_id').':') !!}
    {!! Form::select('bookable_id', $bookableItems, null, ['class' => 'form-control select2']) !!}
</div>
<!-- example select2, using ajax as source data !-->
<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', __('models/bookableBookings.fields.customer_id').':') !!}
    {!! Form::select('customer_id', [], null, array_merge(['class' => 'form-control select2', 'data-url' => route('selectAjax'), 'data-repository' => 'CustomersRepository' ], config('local.select2.ajax')) ) !!}
</div>

<!-- example select2, using tag !-->
<!-- Specification Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('specification', __('models/resources.fields.specification').':') !!}
    {!! Form::select('specification[]',$optionItems, array_keys($optionItems) , array_merge(['class' => 'form-control select2', 'multiple' => 'multiple'], ['data-optionselect' => json_encode(config('local.select2.tag'))] )) !!}
</div>

<!-- example single datepicker !-->
<!-- Starts At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('starts_at', __('models/bookableBookings.fields.starts_at').':') !!}
    {!! Form::text('starts_at', null, ['class' => 'form-control datetime', 'data-optiondate' => json_encode( ['locale' => ['format' => config('local.date_format_javascript') ]]),'id'=>'starts_at']) !!}
</div>

<!-- example single datepicker with time !-->
<!-- Starts At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('starts_at', __('models/bookableBookings.fields.starts_at').':') !!}
    {!! Form::text('starts_at', null, ['class' => 'form-control datetime', 'data-optiondate' => json_encode( ['timePicker' => true, 'locale' => ['format' => config('local.datetime_format_javascript') ]]),'id'=>'starts_at']) !!}
</div>


<!-- example daterangepicker !-->
<!-- Ends At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ends_at', __('models/bookableBookings.fields.ends_at').':') !!}
    {!! Form::text('ends_at', null, ['class' => 'form-control datetime', 'data-optiondate' => json_encode( ['singleDatePicker' => false, 'locale' => ['format' => config('local.date_format_javascript') ]]),'id'=>'ends_at']) !!}
</div>

<!-- example inputmask using currency format !-->
<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', __('models/bookableBookings.fields.price').':') !!}
    {!! Form::number('price', null, ['class' => 'form-control inputmask', 'data-unmask' => 1, 'data-optionmask' => json_encode(config('local.number.currency')) ]) !!}
</div>

<!-- example texteditor using ckeditor !-->
<!-- Notes Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('notes', __('models/bookableBookings.fields.notes').':') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control editor']) !!}
</div>

<!-- Calendar, must set id attribute  -->
<div class="calendar" id="calendar1" data-eventurl="{{ route('events') }}"></div>
<div class="calendar" id="calendar2"></div>    

<!-- Options Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('options', __('models/bookableBookings.fields.options').':') !!}
    {!! Form::textarea('options', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12 mt-2">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('bookableBookings.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
