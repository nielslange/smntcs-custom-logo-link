describe( 'Kadence', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Kadence theme is activated', () => {
		cy.checkThemeActivation( 'Kadence' );
	} );

	it( 'can ensure the site title or logo shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-branding a.brand' );
	} );
} );
