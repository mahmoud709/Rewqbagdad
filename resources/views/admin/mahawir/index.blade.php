@extends('layout.admin.app')
@section('title', __('global.mahwiers'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('global.mahwiers') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('mahawirs.create')}}">
        {{ __('global.mahwier_add') }}</a></li>
@endsection

@section('datatable-css')
    @include('layout.admin.datatable-css')
@endsection

@section('datatable-js')
    @include('layout.admin.datatable-js')
@endsection

@section('content')
    
{{-- <form action="{{url('/admin/center-team/update/description')}}" class="row mb-2" method="post">@csrf
    <div class="col-md-6 mb-2">
        <label for="">{{ __('global.book_team.description_page') }} ({{ LangNative('ar') }}) <b class="text-danger">*</b></label>
        <textarea name="description_ar" required maxlength="900" class="form-control" rows="3"></textarea>
    </div>
    <div class="col-md-6 mb-2">
        <label for="">{{ __('global.book_team.description_page') }} ({{ LangNative('en') }}) <b class="text-danger">*</b></label>
        <textarea name="description_en" required maxlength="900" class="form-control" rows="3"></textarea>
    </div>

    <div class="col-md-12 text-center">
        <button onclick="if(confirm(`{{__('global.alert_update')}}`)){return true;}else{return false;}" class="btn btn-secondary">{{__('global.btn_update')}}</button>
        <a class="btn btn-success" href="{{ url('/admin/center-team/create') }}">{{__('global.center_member.add_new')}}</a>
    </div>

     --}}
</form>

    <div class="mb-2">
        <a class="btn btn-secondary" href="{{ route('mahawirs.create') }}">{{ __('global.mahwier_add') }}</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped data-table text-md-nowrap" width="100%">
            <thead>
                <tr>
                    <th>{{ __('global.id') }}</th>
                    <th>{{ __('global.mahwier_title') }}</th>
                    <th>{{ __('global.mahwier_description') }}</th>
                    <th>{{ __('global.media.created_at') }}</th>
                    <th>{{ __('global.actions') }}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [1, 'desc']
                ],
                dom: 'lBfrtip',
                buttons: {
                    buttons: [{
                            extend: 'copyHtml5',
                            text: '{{ __('global.copy') }}',
                            className: 'btn btn-sm'
                        },
                        {
                            extend: 'excelHtml5',
                            text: '{{ __('global.excel') }}',
                            className: 'btn btn-sm'
                        },
                        {
                            extend: 'print',
                            text: '{{ __('global.print') }}',
                            className: 'btn btn-sm'
                        }
                    ]
                },
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "{{ __('global.view_all') }}"],
                ],
                @if (app()->getLocale() == 'ar')
                    language: {
                        "url": "{{ url('/admin/assets/plugins/datatable/Arabic.json') }}"
                    },
                @endif
                ajax: "{{ url('/admin/mahawirs/json') }}",
                scrollY: 550,
                scrollX: true,
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'translation.title',
                        name: 'translation.title'
                    },
                    {
                        data: 'translation.description',
                        name: 'translation.description'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ],
                columnDefs: [
                    // {
                    //     targets: 2,
                    //     render: function (data, type, row, meta) {
                    //         return "<a target='_blank' href='{{ url('/') }}/media/news/"+data+"'><i class='fa-solid fa-up-right-from-square'></i></a>";
                    //     }
                    // },
                    {
                        targets: 3,
                        render: function(data, type, row, meta) {
                            return data.substr(0, 10);
                        }
                    },
                    {
                        targets: 4,
                        render: function(data, type, row, meta) {
                            var editUrl = "{{ route('mahawirs.edit', ':id') }}".replace(':id', row
                                .id);
                            var deleteUrl = "{{ route('mahawirs.destroy', ':id') }}".replace(':id',
                                row.id);
                            var btns = '';

                            if (@json(auth('admin')->user()->hasPermission('edit-mediaNews') || auth('admin')->user()->is_superadmin)) {
                                btns += '<a href="' + editUrl +
                                    '" class="btn mb-1 btn-sm btn-info"><i class="fa-fw fas fa-pen-alt"></i></a> ';
                            }

                            if (@json(auth('admin')->user()->hasPermission('delete-mediaNews') || auth('admin')->user()->is_superadmin)) {
                                btns += '<form style="display:inline-block" action="' + deleteUrl +
                                    '" method="post">@csrf {{ method_field('DELETE') }} <button onclick="return confirm(\'{{ __('global.alert_delete') }}\')" class="btn btn-sm mb-1 btn-danger"><i class="far fa-fw fa-trash-alt"></i></button></form>';
                            }

                            return btns;
                        }
                    },

                ]
            });
        });
    </script>
@endsection
