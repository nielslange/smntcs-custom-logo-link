describe( 'Shapely', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Shapely theme is activated', () => {
		cy.checkThemeActivation( 'Shapely' );
	} );

	it( 'can ensure the site title or logo shows the custom link', () => {
		cy.checkSiteTitleLink( 'a.custom-logo-link' );
	} );
} );
