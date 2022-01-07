describe( 'Nevertheless', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Nevertheless theme is activated', () => {
		cy.checkThemeActivation( 'Nevertheless' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '#site-title a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteLogoLink( 'a.custom-logo-link' );
	} );
} );
