<div class="row">
    <div class="col-xl-6">

        <label>{{ __('global.role_name') }} <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" name="name" required="required"
            value="{{ old('name', $role->name ?? '') }}" />
        <br />

    </div>
    <div class="col-xl-6">

        <label>{{ __('global.role_description') }} <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" name="description" required="required"
            value="{{ old('description', $role->description ?? '') }}" />
        <br />

    </div>

    <div class="col-12 text-center">
        <button onclick="if(confirm(`{{ __('global.alert_create') }}`)){return true;}else{return false;}"
            class="btn btn-primary">{{ __('global.btn_create') }}</button>
    </div>
</div>
    <div class="row" style="margin-top: 20px">
        <div class="col-lg-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>

                <div class="card-body">

                    <div class="form-group clearfix">


                        <input type="checkbox" data-selector="checkbox" class="checkAllItemm" />
                        
                        <label for="">{{ __('global.all') }}</label>
                    </div>

                </div>
            </div>
    </div>
    @foreach (config('permissions.roles') as $key => $values)
        <div class="col-lg-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ trans($values['name']) }}</h3>
                </div>

                <div class="card-body">

                    <div class="form-group clearfix">

                      
                        <input type="checkbox" data-selector="checkbox{{ $key }}" class="checkAll" />
                        <label for="">{{ __('global.all') }}</label>
                    </div>
                    @foreach ($values['permission'] as $value)
                        <div class="form-group clearfix">
                            <div class="">

                                <input type="checkbox" class="checkbox{{ $key }}"
                                    {{ isset($role) ? ($role->hasPermission($value['permission'] . '-' . $key) ? 'checked' : '') : '' }}
                                    name="permissions[]" value="{{ $value['permission'] . '-' . $key }}">
                                <label for="">{{ $value['name'] }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>{{-- End Row --}}
