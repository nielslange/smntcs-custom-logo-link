// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************

Cypress.Commands.add("login", () => {
	cy.viewport(1200, 2000);
	cy.visit('http://smntcs.local/wp-login.php');
	cy.wait(500);
	cy.get( '#user_login' ).type( 'admin' );
	cy.get( '#user_pass' ).type( 'password' );
	cy.get( '#wp-submit' ).click();
});

Cypress.Commands.add("checkPluginActivation", () => {
	cy.viewport(1200, 2000);
	cy.visit('http://smntcs.local/wp-admin/plugins.php');
	cy.wait(500);
	cy.get('tr[data-slug="smntcs-custom-logo-link"]').then( ($link) => {
		if ( $link.hasClass('inactive') ) {
			cy.get('tr[data-slug="smntcs-custom-logo-link"] .activate a').click();
		}
	});
});

Cypress.Commands.add("checkPluginSettings", () => {
	cy.viewport(1200, 2000);
	cy.visit( 'http://smntcs.local/wp-admin/customize.php' );
	cy.wait(500);
	cy.get( '#accordion-section-smntcs_custom_logo_link_section' ).click();
	cy.wait(500);
	cy.get( '#_customize-input-smntcs_custom_logo_link_url' ).clear();
	cy.get( '#_customize-input-smntcs_custom_logo_link_url' ).type( 'https://www.instagram.com/' );
	cy.get( '#save' ).click();
});

Cypress.Commands.add("checkThemeActivation", (slug) => {
	cy.viewport(1200, 2000);
	cy.visit('http://smntcs.local/wp-admin/themes.php');
	cy.wait(500);
	cy.get('div[data-slug="' + slug + '"] a.activate').click();
});

Cypress.Commands.add("checkSiteTitleLink", (selector) => {
	cy.viewport(1200, 2000);
	cy.visit('http://smntcs.local/' );
	cy.wait(500);
	cy.get(selector).should('have.attr', 'href', 'https://www.instagram.com/');
});