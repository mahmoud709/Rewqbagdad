@extends('layout.admin.app')
@section('title', __('global.backup'))

@section('breadcrumb')
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('style')
	<style>
     .load-page {
        position: fixed;
        background-color: rgb(0 0 0 / 69%);
        width: 100%;
        height: 100%;
        top: 0;
        right: 0;
        z-index: 999999;
        color: #FFF;
        text-align: center;
        padding: 10px;
        display: none;
    }
    input[type=checkbox], input[type=radio] {
        transform: scale(1.3);
    }
    </style>
@endsection

@section('script')
<script>
    $('.db-restore').on('click', function() {
        if (confirm(`{{ __('global.alert_recovery') }}`)) {
            $('.load-page').fadeIn(500);
            return true;
        }else{
            return false;
        }
    });
    $('.check-all').on('change', function() {
        if( $(this).is(":checked") )
        {
            $('input[type=checkbox]').prop('checked', true);
        }
        else {
            $('input[type=checkbox]').prop('checked', false);
        }            
    });
</script>
@endsection

@section('content')

<div class="load-page">
    <h2 class="mt-5">{!! __('global.alertBackup') !!}</h2>
    <h3 class="mt-3"><i class="fas fa-spinner fa-spin fa-2x"></i></h3>
</div>

<a class="btn btn-primary mb-3" href="{{ url('/admin/backup/create') }}"><i class="fas fa-fw fa-database"></i> {{ __('global.createBackup') }}</a>
<form style="overflow: auto" action="{{ url('admin/backup/delete') }}" method="post"> @csrf

    <table class="table table-striped data-table text-md-nowrap" width="100%">
        <thead>
            <tr>
                <th style="font-size: 12px;" scope="col">
                    <input type="checkbox" class="btn btn-sm check-all" />
                    <button class="btn btn-danger btn-sm" onclick="if (confirm(`{{__('global.alert_delete')}}`)) {return true;}else{return false;}">
                        <i class="far fa-fw fa-trash-alt"></i>
                    </button>
                </th>
                <th style="font-size: 12px;" scope="col">{{__('global.file_name')}}</th>
                <th style="font-size: 12px;" scope="col">{{__('global.file_size')}}</th>
                <th style="font-size: 12px;" scope="col">{{__('global.actions')}}</th>
            </tr>
        </thead>
        <tbody>

            @foreach( $backupFiles as $index => $file )
                <tr>
                    <td scope="row">
                        <input type="checkbox" name="data[]" class="btn btn-sm" value="{{basename($file)}}" />
                    </td>
                    <td scope="row" dir="ltr">{{ basename($file) }}</td>
                    <td scope="row" dir="ltr">{{ formatSizeUnits($file) }}</td>
                    <td scope="row">
                        <a onclick="if (confirm(`{{__('global.alertDownload')}}`)) {return true;}else{return false;}" href="{{ url('admin/backup/download/'.basename($file)) }}" class="btn btn-sm btn-info"><i class="fas fa-fw fa-download"></i> {{__('global.download')}}</a>
                        <a href="{{ url('admin/db-restore/'.basename($file)) }}" class="btn btn-sm btn-success db-restore"><i class="fas fa-fw fa-reply-all"></i> {{ __('global.recovery') }}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>

@endsection