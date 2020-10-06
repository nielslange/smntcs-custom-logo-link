describe.skip('Osmosis → ThemeForest', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Osmosis theme is activated', () => {
		cy.checkThemeActivation('osmosis');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('.grve-logo  a');
	});

});