describe( 'XI Portfolio', () => {
	before( function () {
		cy.login();
	} );

	it.skip( 'can ensure the xi Portfolio theme is activated', () => {
		cy.checkThemeActivation( 'XI Portfolio' );
	} );

	it.skip( 'can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink( '.site-title a' );
	} );

	it.skip( 'can ensure the site logo shows the custom link', () => {
		cy.checkSiteTitleLink( 'a.custom-logo-link' );
	} );
} );
