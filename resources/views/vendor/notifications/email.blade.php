@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# Whoops!
@else
# Hola soy el respondedor automático de Valentí Gàmez,
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Saludos,<br>
Respondedor automático de Valentí Gàmez.
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
Si tienes problemas al hacer click al botón \"{{ $actionText }}\", copia y pega la URL siguiente
en tu navegador: [{{$actionUrl}}]({{$actionUrl}})
@endslot
@endisset
@endcomponent
