# LTL production deployment record

Updated: 2026-08-21 JST

## Status

- Test acceptance: complete.
- Production release approval: received.
- Production deployment: prepared, not yet started at this revision.
- Production WordPress path: `/wp/`; public home remains `http://ltl.co.jp/`.
- PHP remains 7.4.33. The release updates WordPress 5.0.22 to 7.1.

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
- Local backup root:
  `work/ltl-production/backups/20260821/pre-deployment/`.

## Production-specific findings

- Production contains newer posts and uploads than the accepted test copy.
  Production content and uploads must be retained; the test database must never
  be imported into production.
- The inquiry page and Contact Form 7 form records still exist in production,
  but the old plugin entry file is unreadable and the public page displays its
  shortcode. Contact Form 7 6.1.7 will restore the form in place.
- Crazy Bone and Ktai Entry are active legacy plugins. Both will be removed.
  Ktai Entry's five-minute Cron event and stored mailbox credentials will also
  be removed.
- The inactive `wik4` directory contains two obfuscated PHP payloads,
  `cf.php` and `ww-te.php`. The directory will be removed in full after its
  hash-backed backup.
- Public-root `phpinfo.php` and the old `backwpup_lifetecklab.zip` archive will
  be removed after backup.

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

## Rollback

1. Re-enable maintenance mode and capture the failed post-deployment state.
2. Restore the complete `/wp` tree and public-root files from the manifest-backed
   local backup.
3. Restore the pre-deployment SQL archive, preserving its `wp_1` table prefix.
4. Remove files introduced by the failed release and restore original file
   permissions from the manifests.
5. Confirm WordPress 5.0.22, the original plugin inventory, public pages, admin,
   Cron, and logs before reopening.
