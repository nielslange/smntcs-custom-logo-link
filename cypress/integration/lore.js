describe.skip('Lore', () => {

	before(function () {
		cy.login();
	});

	it('can ensure the Lore theme is activated', () => {
		cy.checkThemeActivation('lore');
	});
	
	it('can ensure the site title shows the custom link', () => {
		cy.checkSiteTitleLink('a.header-title__link');
	});
	
	it('can ensure the site logo shows the custom link', () => {
		cy.checkSiteLogoLink('a.header-logo__image');
	});
	
});