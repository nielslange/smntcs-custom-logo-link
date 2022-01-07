describe( 'Astra', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Astra theme is activated', () => {
		cy.checkThemeActivation( 'Astra' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-title a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteLogoLink( 'a.custom-logo-link' );
	} );
} );
