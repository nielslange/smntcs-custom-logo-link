/**
 * Playwright E2E suite against the wp-env tests site (`pnpm test:e2e`). Start the site first: `pnpm wp-env start`.
 *
 * WP_BASE_URL points the suite at another site, for example when a different project holds port 8889:
 * `WP_ENV_PORT=9400 WP_ENV_TESTS_PORT=9401 pnpm wp-env start`, then `WP_BASE_URL=http://localhost:9401 pnpm test:e2e`.
 *
 * Shared template: smntcs/e2e/template in github.com/nielslange/smntcs.
 */
import { defineConfig } from '@playwright/test';

// @wordpress/e2e-test-utils-playwright reads WP_BASE_URL itself (REST discovery), so set it for the library too.
process.env.WP_BASE_URL ??= 'http://localhost:8889';
// The admin session global-setup.mjs saves, which every test starts with (the library's requestUtils reads it too).
process.env.STORAGE_STATE_PATH ??= 'artifacts/storage-states/admin.json';

export default defineConfig( {
	testDir: 'tests/e2e',
	outputDir: 'test-results',
	globalSetup: './tests/e2e/global-setup.mjs',
	// One worker: the specs change site-wide settings (options, active theme, plugins) of the one test site.
	fullyParallel: false,
	workers: 1,
	forbidOnly: !! process.env.CI,
	retries: process.env.CI ? 1 : 0,
	timeout: 60000,
	reporter: process.env.CI
		? [ [ 'list' ], [ 'html', { open: 'never' } ] ]
		: 'list',
	use: {
		browserName: 'chromium',
		baseURL: process.env.WP_BASE_URL,
		storageState: process.env.STORAGE_STATE_PATH,
		trace: 'retain-on-failure',
	},
} );
