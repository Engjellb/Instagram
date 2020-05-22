@component('mail::message')
# Welcome {{ $email }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ $name }}
@endcomponent
