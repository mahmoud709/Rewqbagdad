@component('mail::message')
# <center>{{ __('global.password_new') }}</center>
## <center>{{ $data['new_password'] }}</center>


@if ($data['is_admin'] == 'yes')
@component('mail::button', ['url' => url('/admin/auth')])
    {{ __('global.login') }}
@endcomponent
@endif


{{ __('global.thanks') }},<br>
<a style="text-decoration: none" href="{{url('/')}}">{{ $SiteData->name }}</a>
@endcomponent
