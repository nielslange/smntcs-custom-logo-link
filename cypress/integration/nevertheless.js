describe('Nevertheless', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Astra theme is activated', () => {
		cy.checkThemeActivation('nevertheless');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('#site-title a');
	});
	
});