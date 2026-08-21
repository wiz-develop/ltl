# LTL WordPress maintenance source

This repository records the custom source and migration evidence for the Life
Tech Lab WordPress site.

## Branches

- `main`: production baseline for `www.ltl.co.jp`; production deployment is not
  performed without explicit approval.
- `test`: upgraded source prepared for `ltl.wiz-services.com`; deployment is
  gated on the target runtime matching PHP 7.4.

## Tracked scope

- `theme/main/lifetechlab/`: production custom-theme baseline.
- `plugin-patches/`: compatibility and security patches retained for future
  plugin upgrades.
- `mu-plugins/`: host-limited safeguards used only on the test site.
- `plugin-notes/`: decisions for abandoned or locally maintained plugins.
- `docs/`: version inventories, QA, deployment, and rollback records.

Databases, WordPress core, third-party plugin packages, uploads, credentials,
configuration files, logs, caches, and backups are intentionally excluded.

The migration target uses PHP 7.4.33 to match production. Test-only files,
including `mu-plugins/wiz-staging-safety.php`, and target database URLs must
never be deployed to production.
