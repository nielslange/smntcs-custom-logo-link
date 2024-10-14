describe( 'Sydney', () => {
	before( function () {
		cy.login();
	} );

	it( 'can ensure the Sydney theme is activated', () => {
		cy.checkThemeActivation( 'Sydney' );
	} );

	it( 'can ensure the site title or logo shows the custom link', () => {
		cy.checkSiteTitleLink( 'header .col-md-4 a' );
	} );
} );
