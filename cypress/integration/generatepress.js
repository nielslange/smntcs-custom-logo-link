describe( 'GeneratePress', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the GeneratePress theme is activated', () => {
		cy.checkThemeActivation( 'GeneratePress' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '.main-title > a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteLogoLink( 'a.custom-logo-link' );
	} );
} );
