describe('Shapely', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Shapely theme is activated', () => {
		cy.checkThemeActivation('shapely');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('a.custom-logo-link');
	});
	
});