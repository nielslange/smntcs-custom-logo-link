describe( 'Blocksy', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Blocksy theme is activated', () => {
		cy.checkThemeActivation( 'Blocksy' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-title a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteLogoLink( 'a.custom-logo-link' );
	} );
} );
