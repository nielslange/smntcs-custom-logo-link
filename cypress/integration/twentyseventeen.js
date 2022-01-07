describe( 'Twenty Seventeen', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Twenty Seventeen theme is activated', () => {
		cy.checkThemeActivation( 'twentyseventeen' );
	} );

	it( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-title a' );
	} );

	it( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteTitleLink( 'a.custom-logo-link' );
	} );
} );
