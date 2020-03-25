@extends('layouts.master')

@section('content-header')
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> {{ trans('tag::tags.tags') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.index') }}"><i
                                class="fas fa-tachometer-alt"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('tag::tags.tags') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row justify-content-end">
                <div class="btn-group right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.tag.tag.create') }}" class="btn btn-primary" style="padding: 4px 10px;">
                        <i class="fas fa-plus mr-1"></i> {{ trans('tag::tags.create tag') }}
                    </a>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('tag::tags.name') }}</th>
                            <th>{{ trans('tag::tags.slug') }}</th>
                            <th>{{ trans('tag::tags.namespace') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($tags)): ?>
                        <?php foreach ($tags as $tag): ?>
                        <tr>
                            <td>
                                <a href="{{ route('admin.tag.tag.edit', [$tag->id]) }}">
                                    {{ $tag->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.tag.tag.edit', [$tag->id]) }}">
                                    {{ $tag->slug }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.tag.tag.edit', [$tag->id]) }}">
                                    {{ $tag->namespace }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.tag.tag.edit', [$tag->id]) }}" class="btn btn-default"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.tag.tag.destroy', [$tag->id]) }}"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('tag::tags.title.create tag') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.tag.tag.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
