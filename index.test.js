describe.skip('Google', () => {

  beforeAll(async () => {
    await page.goto('https://google.com');
  });

  it('should be titled "Google"', async () => {
    await expect(page.title()).resolves.toMatch('Google');
  });

});

describe('Admin', () => {

  it( 'can log in', async () => {
    await page.goto( 'https://smntcs.local/wp-login.php', {
			waitUntil: 'networkidle0',
		} );

		await expect( page.title() ).resolves.toMatch( 'Log In' );

		await page.type( '#user_login', 'admin' );
		await page.type( '#user_pass', 'password' );

		await Promise.all( [
			page.click( 'input[type=submit]' ),
			page.waitForNavigation( { waitUntil: 'networkidle0' } ),
		] );
  });

  it( 'can make make sure the plugin is activates, otherwise activates it', async () => {
    await page.goto( 'https://smntcs.local/wp-admin/plugins.php', {
			waitUntil: 'networkidle0',
    } );
    
		const slug = 'smntcs-custom-logo-link';
		const disableLink = await page.$( `tr[data-slug="${ slug }"] .deactivate a` );
		if ( disableLink ) {
			return;
    }
    
		await Promise.all( [
      page.click( `tr[data-slug="${ slug }"] .activate a` ),
      page.waitForSelector( `tr[data-slug="${ slug }"] .deactivate a` ),
		] );    
	});    

  it( 'can make make sure the plugin settings can be accessed', async () => {
    await page.goto( 'https://smntcs.local/wp-admin/customize.php?autofocus[control]=smntcs_custom_logo_link_url', {
			waitUntil: 'networkidle0',
		} );

		await expect( page ).toMatch( 'Logo Link' );
    
    await page.type( '#_customize-input-smntcs_custom_logo_link_url', 'https://google.com' );
    await page.click( 'input[type=submit]' );
  });    

});
