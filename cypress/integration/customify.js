describe( 'Customify', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Customify theme is activated', () => {
		cy.checkThemeActivation( 'Customify' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-title a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteLogoLink( '.site-branding a' );
	} );
} );
