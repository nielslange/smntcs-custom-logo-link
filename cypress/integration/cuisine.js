describe.skip('Cuisine → ThemeForest', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Cuisine theme is activated', () => {
		cy.checkThemeActivation('cuisine');
	});

	it('can ensure the site title or logo shows the custom link', () => {
		cy.checkSiteTitleLink('a.cuisine-navbar-brand');
	});

});
