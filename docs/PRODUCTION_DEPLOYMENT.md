# LTL production deployment record

Updated: 2026-08-21 JST

## Status

- Test acceptance: complete.
- Production release approval: received.
- Production deployment: completed on 2026-08-21 JST.
- Production QA: complete; the site was reopened after cleanup and verification.
- Production WordPress path: `/wp/`; public home remains `http://ltl.co.jp/`.
- PHP remains 7.4.33. WordPress was updated from 5.0.22 to 7.1 and the
  database revision was updated from 43764 to 61833.

## Immutable pre-deployment backup

- WordPress tree manifest: 10,221 remote files, 2,305,859,935 bytes.
- WordPress tree manifest SHA-256:
  `fa4b82d59020920815c78d435f5a7ab9fe80b69f957b0702831f0a50f5fb883c`.
- Public-root manifest SHA-256:
  `bcfd3435960a73cc4896fab0176ade8ef6cac2e33f551c6b60e28090d9e08b2c`.
- Unicode-collision supplement manifest SHA-256:
  `5370df70c304252d2117e0380e08a3726186c57c7d0b27c44c7fdab324aad17e`.
- Permission-recovery supplement: 36 files, 332,027 bytes, with the remote
  mode restored to `0100` after each read.
- Permission-recovery manifest SHA-256:
  `801b2b86dd0d65e6ae3fe294b202820228564f448c35d0529045ebcc5f2a8aa0`.
- Database archive: 16 tables, 2,178 posts, 4,228 postmeta rows.
- Database archive SHA-256:
  `9c50407ac8776af0cd84e58ca176aa0b13243d420f26325130ddeb3fbe38f445`.
- The database archive passed gzip validation and a full isolated MySQL 8
  restore with non-strict legacy-date handling.
- A second just-in-time database backup was taken immediately before
  maintenance mode: 16 tables, 124,255 rows, and 3,105,530 compressed bytes.
- Just-in-time database archive SHA-256:
  `597af8aea146a7227070f36132f0a4ea3232133c473b0b899d112d31cd736188`.
- The just-in-time archive passed gzip validation and a full isolated MySQL 8
  restore: 16 tables, 2,178 posts, 4,228 postmeta rows, 238 options, and
  116,992 login-log rows.
- Local backup root:
  `work/ltl-production/backups/20260821/pre-deployment/`.

## Production-specific findings

- Production contains newer posts and uploads than the accepted test copy.
  Production content and uploads must be retained; the test database must never
  be imported into production.
- The existing inquiry page and Contact Form 7 records were retained. Contact
  Form 7 6.1.7 now renders the form in place instead of its literal shortcode.
- Crazy Bone, Ktai Entry, and WP Multibyte Patch were removed. Ktai Entry's
  five-minute Cron event, options, and stored mailbox credentials were removed.
- The inactive `wik4` directory contained two obfuscated PHP payloads,
  `cf.php` and `ww-te.php`. Its hash-backed backup was retained locally and the
  full remote directory was removed.
- Public `phpinfo.php`, `backwpup_lifetecklab.zip`, `wp-config_bk.php`, and
  WordPress readme files were removed and verified as HTTP 404.
- The backed-up phpMyAdmin 5.1.1 directory was changed to mode `0700` and is
  HTTP 403. It must not be made public again.

## Pre-deployment validation

- WordPress 7.1 was reconfirmed as the current release and requires PHP 7.4.
- All 3,338 non-content WordPress core files match the official 7.1 checksum
  set.
- Official plugin versions and PHP requirements were reconfirmed on 2026-08-21;
  the production set is recorded in `PLUGIN_INVENTORY_PRODUCTION.tsv`.
- The updated code was loaded against an isolated clone of the current
  production database on PHP 7.4.33.
- The database upgrade completed from revision 43764 to 61833.
- Public home, inquiry, REST API, and WP-Cron returned HTTP 200.
- Dashboard, plugins, updates, and Site Health returned HTTP 200 while
  authenticated, without timeout.
- Chrome checked 11 production routes at desktop and mobile widths: all 22
  loads returned HTTP 200 with no broken image, console error, or JavaScript
  exception. The Contact Form 7 fields rendered on the inquiry page.
- No Fatal, Warning, Deprecated, Notice, parse error, or uncaught exception was
  logged after public and admin QA.

## Production deployment completed

- The validated 10,862-file release was pre-staged with exact size and SHA-256
  verification, then WordPress core, plugins, themes, languages, and root core
  files were switched under maintenance mode.
- Production uploads, posts, settings, `wp-config.php`, `.htaccess`, and sitemap
  files were retained.
- All 17 expected plugins are active and no inactive plugin remains. The
  deployed versions are recorded in `PLUGIN_INVENTORY_PRODUCTION.tsv`.
- The active `lifetechlab` theme and Twenty Twenty fallback theme are the only
  installed themes.
- The public root front controller now sets `SCRIPT_FILENAME` to the WordPress
  subdirectory entry point before loading WordPress. The tracked source is
  `root-files/index.php`; this prevents `/.htaccess` open_basedir warnings on
  rewritten REST and Site Health requests.
- The maintenance file, migration script, database exporter, remote SQL
  archive, pre-stage directory, and temporary rollback directory were removed.
  Both temporary script URLs return HTTP 404.

## Production QA completed

- Public home, inquiry, REST API, and WP-Cron return HTTP 200.
- Dashboard-authenticated plugins, updates, and Site Health pages return HTTP
  200 without timeout. WordPress reports version 7.1 and 17 active plugins.
- WordPress.org communication, background updates, loopback requests, and the
  Authorization header Site Health tests return HTTP 200 with `good` status.
- Eleven public routes were requested with desktop and mobile user agents: all
  22 responses were HTTP 200 with no public Fatal, Warning, Deprecated, or
  Notice marker. The inquiry form and home slider are present in both sets.
- 144 same-site images, scripts, and stylesheets referenced by those pages were
  requested successfully with no HTTP failure.
- Contact Form 7 form 44 returned `mail_sent` with no invalid field. The test
  used `info@ltl.co.jp` for both the administrator destination and requester
  auto-reply destination.
- One open_basedir Warning from the first Site Health run led to the tracked
  root front-controller fix above. After deploying the fix and rerunning Site
  Health and REST checks, the PHP error log grew by zero bytes. WordPress
  `debug.log` and `/wp/error_log` are absent.

## Deployment sequence

1. Reconfirm the immutable file and database backup hashes.
2. Enable maintenance mode without changing `wp-config.php` or production URLs.
3. Remove Crazy Bone and Ktai Entry from the active plugin list, clear the Ktai
   Cron hook, and replace its stored mailbox credentials with placeholders.
4. Replace WordPress core, then update plugins one directory at a time. Activate
   Contact Form 7 and retain the 17-plugin production inventory.
5. Deploy only the reviewed `lifetechlab` theme changes and install Twenty
   Twenty as the fallback theme. Do not deploy the test-only MU plugin.
6. Run the WordPress database upgrade, clear caches, and remove obsolete core,
   plugins, themes, malware, `phpinfo.php`, and the public backup archive.
7. Remove every temporary maintenance or migration file before reopening.
8. Complete public, admin, Site Health, REST, Cron, form, real mailbox, and log
   QA before ending maintenance mode.

## Known constraints

- PHP 7.4.33 is end-of-life and Site Health correctly flags it. It remains only
  because the production environment cannot currently be upgraded. Moving to a
  supported PHP release should be planned separately.
- WP-PageNavi 2.94.6 is the newest release compatible with PHP 7.4. Version
  3.0.0 requires PHP 8.2, so its update notice is expected and it must not be
  installed on this runtime.
- The site does not currently use HTTPS, which Site Health reports as a
  recommendation. Certificate and URL migration require a separate coordinated
  release.
- The optional PHP `intl` module and a persistent page cache are not available;
  neither blocks current site behavior.

## Rollback

1. Re-enable maintenance mode and capture the failed post-deployment state.
2. Restore the complete `/wp` tree and public-root files from the manifest-backed
   local backup.
3. Restore the pre-deployment SQL archive, preserving its `wp_1` table prefix.
4. Remove files introduced by the failed release and restore original file
   permissions from the manifests.
5. Confirm WordPress 5.0.22, the original plugin inventory, public pages, admin,
   Cron, and logs before reopening.
