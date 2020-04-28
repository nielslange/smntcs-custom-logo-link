describe('Sydney', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Sydney theme is activated', () => {
		cy.checkThemeActivation('sydney');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('.site-title a');
	});
	
});