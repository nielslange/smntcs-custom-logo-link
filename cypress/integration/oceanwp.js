describe( 'OceanWP', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the OceanWP theme is activated', () => {
		cy.checkThemeActivation( 'OceanWP' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '#site-logo-inner a' );
	} );
} );
