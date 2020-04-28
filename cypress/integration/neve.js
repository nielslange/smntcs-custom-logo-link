describe('Neve', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Neve theme is activated', () => {
		cy.checkThemeActivation('neve');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('.site-logo a');
	});
	
});