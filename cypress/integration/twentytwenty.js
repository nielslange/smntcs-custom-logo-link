describe( 'Twenty Twenty', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Twenty Twenty theme is activated', () => {
		cy.checkThemeActivation( 'Twenty Twenty' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-title a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteTitleLink( 'a.custom-logo-link' );
	} );
} );
