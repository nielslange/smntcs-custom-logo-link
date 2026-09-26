describe( 'Yuki', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Yuki theme is activated', () => {
		cy.checkThemeActivation( 'Yuki' );
	} );

	it( 'can ensure the site title or logo shows the custom link', () => {
		cy.checkSiteTitleLink( '.yuki-site-branding a' );
	} );
} );
