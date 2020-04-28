describe('Colormag', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Colormag theme is activated', () => {
		cy.checkThemeActivation('colormag');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('#site-title a');
	});
	
});
