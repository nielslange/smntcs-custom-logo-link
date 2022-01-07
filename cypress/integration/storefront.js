describe( 'Storefront', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Storefront theme is activated', () => {
		cy.checkThemeActivation( 'Storefront' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-title a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteTitleLink( 'a.custom-logo-link' );
	} );
} );
