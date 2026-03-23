<x-mail::message>
# {{ $mailData['title'] ?? 'Introduction' }}

{{ $mailData['body'] ?? 'The body of your message.' }}

<x-mail::button :url="$mailData['url'] ?? ''">
{{ $mailData['button_text'] ?? 'Button Text' }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
