# Mail QA requirement

Contact Form 7 6.1.7 generates both the administrator notification and requester
auto-reply in local integration testing. No SMTP plugin is added by default.

After every WordPress, PHP, form, or mail-related update, submit the public form
and confirm both messages arrive in their real mailboxes. If native delivery on
the target fails, investigate From, Return-Path, SPF, DKIM, DMARC, and server
mail logs before adding an authenticated SMTP plugin. Credentials must never be
committed to this repository.
