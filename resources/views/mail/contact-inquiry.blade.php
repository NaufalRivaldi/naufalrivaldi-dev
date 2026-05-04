@component('mail::message')
# New Contact Inquiry

You received a new message from your portfolio contact form.

| Field | Value |
|-------|-------|
| **Name** | {{ $senderName }} |
| **Email** | {{ $senderEmail }} |
| **Topic** | {{ $topic }} |

---

**Message:**

{{ $body }}

---

*Reply directly to this email to respond — it will go to {{ $senderEmail }}.*
@endcomponent
