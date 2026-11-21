/**
 * The custom logo link across themes: for each theme the site title link (no logo set) and the logo link (logo set
 * through core's site_logo setting, which every theme's custom_logo reads) must point to the custom URL. Each check
 * needs at least one matching link, so a selector that no longer matches fails instead of passing silently.
 *
 * To cover another theme: add its zip to .wp-env.json and a row to THEMES (the links a visitor sees around the site
 * title and the logo).
 */
import path from 'node:path';
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

const URL = 'https://example.com/custom-logo-link/';
const LOGO = path.join( __dirname, 'fixtures', 'logo.png' );

// name: theme name as WordPress lists it. title / logo: selectors of the links without and with a logo.
// bug: a known plugin gap; the theme's check is marked fixme until the plugin's selectors cover it.
const THEMES = [
	{ name: 'Astra', title: '.site-title a', logo: 'a.custom-logo-link' },
	{
		name: 'Atomic Blocks',
		title: '.site-title a',
		logo: 'a.custom-logo-link',
	},
	{
		name: 'Blocksy',
		title: '.site-title a',
		logo: 'a.site-logo-container',
		bug: 'the logo link (a.site-logo-container) is not among the selectors the plugin rewrites',
	},
	{
		name: 'ColorMag',
		title: '.cm-site-title a',
		logo: 'a.custom-logo-link',
		bug: 'ColorMag 4 renamed #site-title to .cm-site-title; the plugin still targets #site-title a',
	},
	{ name: 'Customify', title: '.site-title a', logo: '.site-branding a' },
	{
		name: 'Education Hub',
		title: '.site-title a',
		logo: 'a.custom-logo-link',
	},
	{ name: 'GeneratePress', title: '.main-title a', logo: '.site-logo a' },
	{
		name: 'Hello Elementor',
		title: '.site-title a',
		logo: 'a.custom-logo-link',
	},
	{
		name: 'Hestia',
		title: '.title-logo-wrapper a',
		logo: '.title-logo-wrapper a',
	},
	{
		name: 'Kadence',
		title: '.site-branding a.brand',
		logo: '.site-branding a.brand',
	},
	{ name: 'Neve', title: '.site-logo a', logo: '.site-logo a' },
	{
		name: 'Nevertheless',
		title: '#site-title a',
		logo: 'a.custom-logo-link',
	},
	{
		name: 'OceanWP',
		title: '#site-logo-inner a',
		logo: '#site-logo-inner a',
	},
	{
		name: 'Shapely',
		title: 'a.custom-logo-link',
		logo: 'a.custom-logo-link',
	},
	{ name: 'Storefront', title: '.site-title a', logo: 'a.custom-logo-link' },
	{ name: 'Suffice', title: '.site-title a', logo: 'a.custom-logo-link' },
	// Sydney's header builder keeps the site title when a core logo is set.
	{ name: 'Sydney', title: '.site-title a', logo: '.site-branding a' },
	{
		name: 'XI Portfolio',
		title: '.site-title a',
		logo: 'a.custom-logo-link',
	},
	{
		name: 'Yuki',
		title: '.yuki-site-branding a',
		logo: '.yuki-site-branding a',
	},
	{
		name: 'Twenty Fifteen',
		title: '.site-title a',
		logo: 'a.custom-logo-link',
	},
	{
		name: 'Twenty Sixteen',
		title: '.site-title a',
		logo: 'a.custom-logo-link',
	},
	{
		name: 'Twenty Seventeen',
		title: '.site-title a',
		logo: 'a.custom-logo-link',
	},
	{
		name: 'Twenty Nineteen',
		title: '.site-title a',
		logo: 'a.custom-logo-link',
	},
	{
		name: 'Twenty Twenty',
		title: '.site-title a',
		logo: 'a.custom-logo-link',
	},
	{
		name: 'Twenty Twenty-Five',
		title: '.wp-block-site-title a',
		logo: '.wp-block-site-logo a',
	},
];

async function saveSettings( page, { url, newWindow = false } ) {
	await page.goto(
		'/wp-admin/customize.php?autofocus[control]=smntcs_custom_logo_link_url'
	);
	await page
		.locator( '#_customize-input-smntcs_custom_logo_link_url' )
		.fill( url );
	await page
		.locator( '#_customize-input-smntcs_custom_logo_link_target' )
		.setChecked( newWindow );
	const save = page.locator( '#save' );
	if ( await save.isEnabled() ) {
		await save.click();
		await expect( save ).toHaveValue( 'Published' );
	}
}

/** Visits the home page as a visitor and returns the hrefs of the links matching selector. */
async function hrefs( browser, selector ) {
	const context = await browser.newContext( {
		storageState: { cookies: [], origins: [] },
	} );
	const page = await context.newPage();
	await page.goto( '/' );
	// The plugin's script rewrites classic themes' links on DOMContentLoaded.
	await page.waitForLoadState( 'domcontentloaded' );
	const values = await page
		.locator( selector )
		.evaluateAll( ( links ) =>
			links.map( ( link ) => link.getAttribute( 'href' ) )
		);
	await context.close();
	return values;
}

test.describe( 'Custom Logo Link', () => {
	let installed;
	let originalTheme;
	let logoId;

	test.beforeAll( async ( { requestUtils, browser } ) => {
		installed = await requestUtils.rest( { path: '/wp/v2/themes' } );
		originalTheme = installed.find(
			( theme ) => theme.status === 'active'
		).stylesheet;
		await requestUtils.deleteAllMedia();
		logoId = ( await requestUtils.uploadMedia( LOGO ) ).id;
		const page = await browser.newPage();
		await saveSettings( page, { url: URL } );
		await page.close();
	} );

	test.afterAll( async ( { requestUtils, browser } ) => {
		await requestUtils.updateSiteSettings( { site_logo: 0 } );
		await requestUtils.deleteAllMedia();
		await requestUtils.activateTheme( originalTheme );
		const page = await browser.newPage();
		await saveSettings( page, { url: '' } );
		await page.close();
	} );

	test( 'adds a Settings link to the Customizer control', async ( {
		page,
	} ) => {
		await page.goto( '/wp-admin/plugins.php' );
		const link = page
			.locator( 'tr[data-slug="smntcs-custom-logo-link"]' )
			.getByRole( 'link', { name: 'Settings' } );
		await expect( link ).toHaveAttribute(
			'href',
			/customize\.php\?autofocus(%5B|\[)control(%5D|\])=smntcs_custom_logo_link_url/
		);
	} );

	for ( const theme of THEMES ) {
		( theme.bug ? test.fixme : test )(
			`${ theme.name }: site title and logo link to the custom URL`,
			async ( { requestUtils, browser } ) => {
				// wp-env installs theme zips as <slug>.latest-stable; core themes keep their slug. Prefer the zip copy.
				const matches = installed.filter(
					( t ) => t.name.rendered === theme.name
				);
				expect(
					matches.length,
					`${ theme.name } is installed`
				).toBeGreaterThan( 0 );
				const stylesheet = (
					matches.find( ( t ) =>
						t.stylesheet.endsWith( '.latest-stable' )
					) || matches[ 0 ]
				).stylesheet;
				await requestUtils.activateTheme( stylesheet );

				await requestUtils.updateSiteSettings( { site_logo: 0 } );
				const title = await hrefs( browser, theme.title );
				expect(
					title.length,
					`site title link (${ theme.title })`
				).toBeGreaterThan( 0 );
				expect( new Set( title ) ).toEqual( new Set( [ URL ] ) );

				await requestUtils.updateSiteSettings( { site_logo: logoId } );
				const logo = await hrefs( browser, theme.logo );
				expect(
					logo.length,
					`logo link (${ theme.logo })`
				).toBeGreaterThan( 0 );
				expect( new Set( logo ) ).toEqual( new Set( [ URL ] ) );
			}
		);
	}

	test( 'opens the link in a new window when enabled', async ( {
		page,
		requestUtils,
		browser,
	} ) => {
		await requestUtils.activateTheme( 'storefront.latest-stable' );
		await requestUtils.updateSiteSettings( { site_logo: 0 } );
		await saveSettings( page, { url: URL, newWindow: true } );

		const context = await browser.newContext( {
			storageState: { cookies: [], origins: [] },
		} );
		const visitor = await context.newPage();
		await visitor.goto( '/' );
		const link = visitor.locator( '.site-title a' );
		await expect( link ).toHaveAttribute( 'target', '_blank' );
		await expect( link ).toHaveAttribute( 'rel', /noopener/ );
		await context.close();

		await saveSettings( page, { url: URL } );
	} );
} );
