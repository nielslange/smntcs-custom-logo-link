describe( 'Atomic Blocks', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Atomic Blocks theme is activated', () => {
		cy.checkThemeActivation( 'Atomic Blocks' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-title a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteLogoLink( 'a.custom-logo-link' );
	} );
} );
