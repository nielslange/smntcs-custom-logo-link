describe( 'Twenty Sixteen', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Twenty Sixteen theme is activated', () => {
		cy.checkThemeActivation( 'Twenty Sixteen' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-title a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteTitleLink( 'a.custom-logo-link' );
	} );
} );
