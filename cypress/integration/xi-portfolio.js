describe('xi Portfolio', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the xi Portfolio theme is activated', () => {
		cy.checkThemeActivation('xi-portfolio');
	});

	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('.site-title a');
	});

	it('can ensure the site logo shows the custom link', () => {
		cy.checkSiteTitleLink('a.custom-logo-link');
	});

});
