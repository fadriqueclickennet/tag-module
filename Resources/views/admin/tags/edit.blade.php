@extends('layouts.master')

@section('content-header')
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> {{ trans('tag::tags.edit tag') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i>
                            {{ trans('core::core.breadcrumb.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.tag.tag.index') }}">{{ trans('tag::tags.tags') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('tag::tags.edit tag') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.tag.tag.update', $tag->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="card card-primary tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('tag::admin.tags.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger float-right" href="{{ route('admin.tag.tag.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
        <div class="col-md-3">
            <div class="card card-primary" style="margin-top: 42px;">
                <div class="card-body">
                    <div class="form-group {{ $errors->has('namespace') ? 'has-error' : '' }}">
                        {!! Form::label('namespace', trans('tag::tags.namespace')) !!}
                        {!! Form::select('namespace', $namespaces, old('namespace', $tag->namespace) , ['class' => 'selectize']) !!}
                        {!! $errors->first('namespace', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.selectize').selectize();
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.tag.tag.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
