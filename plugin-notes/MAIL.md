# Mail QA requirement

Contact Form 7 6.1.7 generates both the administrator notification and requester
auto-reply in local integration testing. No SMTP plugin is added by default.

On `ltl.wiz-services.com`, `mu-plugins/wiz-staging-safety.php` forces the From
address and envelope sender to `wordpress@ltl.wiz-services.com`. It also adds
the submitted address as Reply-To on the administrator notification and stores
only recipient domains, status, time, and a subject hash for the last 20 mail
attempts. The plugin returns immediately on every other host and must not be
deployed to production.

The deployed target returned `mail_sent` for Contact Form 7 and recorded both
the administrator notice and requester auto-reply as accepted by the local
mailer. Real mailbox arrival remains a manual release-gate item.

After every WordPress, PHP, form, or mail-related update, submit the public form
and confirm both messages arrive in their real mailboxes. If native delivery on
the target fails, investigate From, Return-Path, SPF, DKIM, DMARC, and server
mail logs before adding an authenticated SMTP plugin. Credentials must never be
committed to this repository.
