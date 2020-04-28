describe('Zerif Lite', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Zerif Lite theme is activated', () => {
		cy.checkThemeActivation('zerif-lite');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('.site-title a');
	});
	
});