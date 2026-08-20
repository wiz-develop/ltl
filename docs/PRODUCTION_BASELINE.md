# Production baseline

Recorded: 2026-08-21 JST

## Runtime

- Production URL: `http://www.ltl.co.jp/`
- WordPress directory: `/wp/`
- WordPress: 5.0.22
- PHP: 7.4.33
- Database server: MariaDB 10.11.18
- Active theme: `lifetechlab`

## Source evidence

- All 49 files exposed by the production theme editor were fetched read-only
  and used as the `theme/main/lifetechlab` baseline.
- All 41 theme image assets were compared by SHA-256 against the migration
  source and matched.
- Production `style.css` and the migration-source `style.css` matched by
  SHA-256 before migration work.
- The migration source contains URL-portability changes that are intentionally
  not folded back into this production baseline. Those changes belong on
  `test`.
- Production `works.php` is empty; the migration source contains an implemented
  version. This branch distinction is intentional.

Production FTP was not provided. WordPress core, third-party plugins, database,
uploads, and non-editor server files are therefore represented by inventories
and external backups rather than committed as inferred production source.

## Safety boundary

No production file, database, plugin, or setting was changed while creating
this baseline. Production deployment requires separate explicit approval.

