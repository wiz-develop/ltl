# LTL test migration record

Updated: 2026-08-21 JST

## Scope

- Copy source: `ltl.3d-showcase.net`, WordPress in `/cms/`.
- Test target: `ltl.wiz-services.com`, WordPress in `/cms/`, public home at `/`.
- Production reference: `www.ltl.co.jp`; no production deployment or setting
  change was performed.

## Backups

- File backup: 10,034 files, 2,072,051,604 bytes.
- File manifest SHA-256:
  `c9f88f2d75084366fbd5fc28ca71515ef2a4235ced844acea27ac924aaf680c5`.
- Database backup: 16 tables, 11,599 rows.
- Database archive SHA-256:
  `bd402a7a9bb99e258147571040a3ed54a4840768308bf52e9d1f4a95e72d049a`.
- Local backup directory:
  `work/ltl-migration/backups/20260821/source-pre-migration/`.
- The 924 MB historical `.wpress` archive is retained only in the local source
  backup and is intentionally excluded from deployment.

## Changes deployed to the test target

- WordPress 5.0.22 to 7.1.
- Official plugins updated individually to the versions in
  `PLUGIN_INVENTORY_TEST.tsv`.
- Source-specific `suPHP_ConfigPath` and PHP handler directives removed from
  both `.htaccess` files; permalink rules retained.
- Database URLs replaced with serialized-data-aware tooling.
- Target-ready database archive SHA-256:
  `89107ac5a7dbbed7816d74d62c93eaf3905e8620746a987a3499bfbcd2014fe6`.
- The target-ready database was restored into a separate verification database;
  WordPress 7.1, 31 tables, 17 active plugins, and both target URLs were read
  successfully after the restore.
- Public PHP errors are disabled and logged; the file editors are disabled.
- Theme paths remain portable, the obsolete duplicate jQuery 1.6.2 load was
  removed, and FlexSlider now depends on WordPress jQuery.
- Abandoned required plugins received the security patches documented in
  `PLUGIN_COMPATIBILITY.md`.
- Two automatic BackWPup jobs copied from the source were disabled in the
  target-ready database so the test site cannot contact the old FTP or send
  scheduled backup mail. Manual BackWPup operation remains available.
- One 2018 attachment missing from the source FTP was recovered read-only from
  production. The original and all six metadata-registered image sizes were
  verified and added to the deployment files; uploads remain excluded from Git.
- The target was switched to PHP 7.4.33 before deployment.
- 16,152 files totaling 1,111,162,265 bytes were uploaded with remote-size
  verification. The target-ready database was imported as 319 statements and
  31 tables; the imported Home and Site URL values were verified.
- The target proxy reports HTTP to the origin for HTTPS viewer requests. The
  private target `wp-config.php` therefore recognizes the exact staging host as
  HTTPS, preventing login and admin redirect loops. This configuration and its
  credentials are excluded from Git.
- 182 upload filenames normalized differently by macOS were renamed to NFC on
  the target so their database URLs resolve without 404 responses.
- The obsolete insecure `hei.a.swcs.jp` footer script was removed because its
  provider endpoint no longer exists and has no HTTPS replacement.
- `WIZ Staging Safety` prevents indexing and aligns the test site's From and
  envelope sender with `ltl.wiz-services.com` while preserving the visitor as
  Reply-To on the administrator notification.

## Local QA completed

- Public home: HTTP 200.
- Inquiry page: HTTP 200 and current Contact Form 7 fields rendered.
- REST API root and `/wp/v2/types/post`: HTTP 200.
- Dashboard, plugin list, updates, Site Health, themes, posts, pages, Contact
  Form 7, Photospace, WP PageNavi Style, and WP Total Hacks pages: HTTP 200 with
  no timeout.
- Contact Form 7 REST submission returned `mail_sent`; one administrator notice
  and one requester auto-reply were captured in a temporary local SMTP sink.
- WordPress 7.1 core checksum verification passed.
- PHP 7.4 syntax checks passed for 5,785 runtime-compatible theme and plugin
  files. The only excluded file is BackWPup's guarded PHP 8-only polyfill,
  documented in `PLUGIN_COMPATIBILITY.md`.
- Google Chrome checked 11 public routes at desktop and mobile widths (22 page
  loads): every response was HTTP 200, with no broken image, console error, or
  JavaScript exception. The home slider and inquiry form were present.
- The existing fixed 980 px mobile layout was preserved to avoid an unrelated
  visual redesign.
- After the checked requests, `debug.log` contained no Fatal, Warning,
  Deprecated, or Notice entries.

## Target QA completed

- PHP 7.4.33 and WordPress 7.1 were verified from the deployed runtime.
- Public home, inquiry, REST API, and WP-Cron returned HTTP 200.
- Dashboard, plugins, updates, Site Health, themes, posts, pages, and Contact
  Form 7 returned HTTP 200 while authenticated, without timeout.
- Site Health's WordPress.org communication, background updates, loopback,
  HTTPS, authorization header, and page-cache asynchronous tests all returned
  HTTP 200 with `good` status.
- Google Chrome rechecked 11 routes at desktop and mobile widths: 22 HTTP 200
  responses, no broken images, console errors, or JavaScript exceptions.
- With WordPress debug logging temporarily enabled, the same public, admin,
  REST, Cron, Site Health, and form paths produced no PHP Fatal, Warning,
  Deprecated, or Notice entry. No debug log was created. Debugging was then
  disabled again.
- Contact Form 7 returned `mail_sent`; both the administrator notice and
  requester auto-reply were recorded as accepted by the target local mailer.
- Temporary probes, importer, SQL archive, and QA-status URLs were deleted and
  verified as HTTP 404.

## Remaining release gate

- Confirm the administrator notification and requester auto-reply in their
  real mailboxes. Local mailer acceptance alone is not delivery acceptance.
- Obtain visual and functional acceptance for the test URL before any separate
  production work. No production deployment has been performed.

## Known constraints

- PHP 7.4.33 is end-of-life and Site Health correctly flags it. It is retained
  only because this test must match the current production runtime.
- WP-PageNavi 2.94.6 is the newest PHP 7.4-compatible release. WordPress offers
  3.0.0, but that version requires PHP 8.2, so its update notice is expected.
- Search-engine indexing is intentionally disabled on the test host.
- A persistent object cache is recommended by Site Health but is not required
  for functional acceptance.

## Rollback

1. Put the target in maintenance mode and archive its current files and DB.
2. Drop the migrated `wp_1*` tables.
3. Because the target was empty before this deployment, remove the `/ltl`
   deployment tree to return it to its recorded pre-migration state.
4. For a forward restore instead, redeploy the manifest-backed release and
   import the target-ready database archive whose SHA-256 is recorded above.
5. Remove any temporary importer or maintenance script.
6. Confirm public, admin, REST, Cron, form, mail, and logs before reopening.
