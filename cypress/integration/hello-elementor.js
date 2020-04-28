describe('Hello Elementor', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Hello Elementor theme is activated', () => {
		cy.checkThemeActivation('hello-elementor');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('.site-header a');
	});
	
});