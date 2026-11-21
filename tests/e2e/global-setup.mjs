/**
 * Logs the wp-env admin (admin / password) in once through the REST login of
 * `@wordpress/e2e-test-utils-playwright` and saves the session to STORAGE_STATE_PATH. Every test starts logged in;
 * a test that needs a visitor uses `test.use( { storageState: { cookies: [], origins: [] } } )`.
 */
import { request } from '@playwright/test';
import { RequestUtils } from '@wordpress/e2e-test-utils-playwright';

export default async function globalSetup() {
	const requestContext = await request.newContext( {
		baseURL: process.env.WP_BASE_URL,
	} );
	const requestUtils = new RequestUtils( requestContext, {
		storageStatePath: process.env.STORAGE_STATE_PATH,
	} );
	await requestUtils.setupRest();
	await requestContext.dispose();
}
