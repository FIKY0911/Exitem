<x-mail::message>
# New Contact Message

You have received a new message from the contact form.

**Name:** {{ $contactName }}
**Email:** {{ $contactEmail }}
**Phone:** {{ $contactPhone ?? 'N/A' }}

**Message:**
{{ $contactMessage }}

<x-mail::button :url="route('contact')">
View Contact Form
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
