describe('Astra', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Astra theme is activated', () => {
		cy.checkThemeActivation('astra');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('.site-title a');
	});
	
});