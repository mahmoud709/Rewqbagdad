<x-mail::message>
# {{$title}}

<center style="margin:10px">
    <img src="{{ url($img) }}" alt="{{$title}}" />
</center>

{!! $content !!}

<center style="margin-top: 30px">
    <a style="
    background: #0d233b;
    color: #FFF;
    text-decoration: none;
    padding: 10px;
    border-radius: 8px;
    display: block;
    margin-top: 10px;
    font-size: 18px;
    font-weight: bold;" target="_blank" href="{{$slug}}">رابط الخبر</a>
</center>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
