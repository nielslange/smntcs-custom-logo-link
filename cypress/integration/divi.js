describe('Divi → ElegantThemes', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Divi theme is activated', () => {
		cy.checkThemeActivation('Divi');
	});

	it('can ensure the site logo shows the custom link', () => {
		cy.checkSiteLogoLink('.logo_container a');
	});

});
