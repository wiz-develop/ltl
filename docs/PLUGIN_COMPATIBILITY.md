# Plugin compatibility

## Maintained forks

The following abandoned plugins are still required by the theme or stored
content. Their exact patches are retained in `plugin-patches/` and must be
reviewed and reapplied after any upstream replacement.

- Custom Post Templates 1.5.1-wiz: adds nonce, authorization, autosave and
  revision checks, template allowlisting, modern constructor support, and a
  fix for the widget arguments accessor.
- Photospace 2.3.6-wiz: adds authorization, nonce validation, numeric/text input
  sanitization, output escaping, and safe JavaScript string serialization.
- WP PageNavi Style 1.4.1-wiz: removes bundled jQuery 1.5, blocks CSRF and
  unauthorized setting changes, validates every style value, replaces removed
  `eregi()`, and removes the obsolete remote feed from its settings page.
- Archives for a category 1.4.1-wiz: validates category IDs before adding them
  to SQL and uses `add_query_arg()` for archive links.
- WP Total Hacks 4.7.2-wiz: replaces the removed `login_headertitle` filter
  with `login_headertext`, preserving the configured login-logo text without
  generating a WordPress 7.1 deprecation entry.

Each fork declares `Update URI: false` so an unrelated automatic update cannot
overwrite the maintained source.

## Removed from the test target

- Crazy Bone 0.6.0: abandoned login logger with unauthenticated AJAX surface and
  unsafe serialized log handling.
- Ktai Entry 0.9.1.2: abandoned mail-posting code using removed PHP APIs and old
  mail parsers. Its five-minute cron event and stored mailbox credentials were
  removed from the test database.
- Old inactive copies of Limit Login Attempts Reloaded, SiteGuard, WP Downgrade,
  WP Multibyte Patch, WP Rollback, and Hello Dolly.
- Old inactive Twenty Nineteen and Twenty Seventeen themes. Twenty Twenty 3.2 is
  retained as the updated fallback theme.

Ktai Entry was polling a mailbox before migration, but no Ktai-specific post
content or post metadata was found. If mail-to-post is still a business
requirement, it needs a separately approved modern implementation; the old
plugin must not be reactivated.

## Version constraints

- WordPress: 7.1.
- PHP: 7.4.33-compatible runtime.
- WP-PageNavi 3.0.0 is not used because it requires PHP 8.2 and WordPress 6.8 or
  later. Version 2.94.6 is the newest suitable release for PHP 7.4.
- BackWPup 5.7.5 declares PHP 7.4 support. Its vendor tree contains
  `bootstrap80.php`, which intentionally uses PHP 8 syntax and is loaded only
  when `PHP_VERSION_ID >= 80000`; the PHP 7.4 execution branch and all other
  5,785 PHP files pass syntax checks.
- Custom Field Suite is not installed. The active plugin is Custom Field
  Template, which was updated in place and must not be confused with CFS.
