@component('mail::message')
# New Contact Message

**From:** {{ $senderName }} ({{ $senderEmail }})
**Topic:** {{ ucwords(str_replace('-', ' ', $topic)) }}

{{ $messageBody }}

@component('mail::button', ['url' => 'mailto:' . $senderEmail])
Reply to {{ $senderName }}
@endcomponent

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
