describe( 'Education Hub', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Education Hub theme is activated', () => {
		cy.checkThemeActivation( 'Education Hub' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '#site-title a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteLogoLink( 'a.custom-logo-link' );
	} );
} );
