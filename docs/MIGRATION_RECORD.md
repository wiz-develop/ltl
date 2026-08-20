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

## Changes prepared

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

## Pending release gate

- Change the target host from PHP 8.5.9 to PHP 7.4 before deployment. A fresh
  runtime probe on 2026-08-21 still reported PHP 8.5.9; the probe was deleted
  immediately and its URL returned HTTP 404 afterward.
- Import the prepared database and files to the target.
- Verify target outbound HTTP, loopback, WP-Cron, Site Health, and logs.
- Send the real form and confirm delivery in both administrator and requester
  mailboxes. `wp_mail()` success alone is not acceptance.
- Repeat Chrome desktop and mobile QA against the deployed target.

## Rollback

1. Put the target in maintenance mode.
2. Restore the file tree from the pre-migration manifest-backed backup.
3. Drop the migrated `wp_1*` tables and import the recorded SQL archive.
4. Restore the original source URLs with serialized-data-aware replacement.
5. Remove any temporary importer or maintenance script.
6. Confirm public, admin, REST, Cron, form, mail, and logs before reopening.
