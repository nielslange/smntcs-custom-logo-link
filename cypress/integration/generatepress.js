describe('GeneratePress', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the GeneratePress theme is activated', () => {
		cy.checkThemeActivation('generatepress');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('.main-title > a');
	});
	
});
