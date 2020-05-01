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
	
	it('can ensure the site logo shows the custom link', () => {
		cy.checkSiteLogoLink('a.custom-logo-link');
	});
	
});