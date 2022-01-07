describe( 'Neve', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Neve theme is activated', () => {
		cy.checkThemeActivation( 'Neve' );
	} );

	it( 'can ensure the site title or logo shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-logo a' );
	} );
} );
