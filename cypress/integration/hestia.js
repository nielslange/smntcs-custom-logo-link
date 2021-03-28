describe('Hestia', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Hestia theme is activated', () => {
		cy.checkThemeActivation('hestia');
	});

	it('can ensure the site title or logo shows the custom link', () => {
		cy.checkSiteTitleLink('.title-logo-wrapper a');
	});

});
