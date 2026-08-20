# LTL WordPress maintenance source

This repository records the custom source and migration evidence for the Life
Tech Lab WordPress site.

## Branches

- `main`: production baseline for `www.ltl.co.jp`; production deployment is not
  performed without explicit approval.
- `test`: upgraded source deployed to `ltl.wiz-services.com`.

## Tracked scope

- `theme/main/lifetechlab/`: production custom-theme baseline.
- `plugin-patches/`: compatibility and security patches retained for future
  plugin upgrades.
- `plugin-notes/`: decisions for abandoned or locally maintained plugins.
- `docs/`: version inventories, QA, deployment, and rollback records.

Databases, WordPress core, third-party plugin packages, uploads, credentials,
configuration files, logs, caches, and backups are intentionally excluded.

The migration target must use PHP 7.4 to match production. Test-only files and
database URLs must never be deployed to production.

