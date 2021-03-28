// ***********************************************************
// This example support/index.js is processed and
// loaded automatically before your test files.
//
// This is a great place to put global configuration and
// behavior that modifies Cypress.
//
// You can change the location of this file or turn off
// automatically serving support files with the
// 'supportFile' configuration option.
//
// You can read more here:
// https://on.cypress.io/configuration
// ***********************************************************

// Import commands.js using ES2015 syntax:
import './commands'

describe('Admin', () => {

	beforeEach(function () {
		cy.login();
	});

	it('can ensure the SMNTCS Custom Logo Link is activated', () => {
		cy.checkPluginActivation();
	});

	it( 'can access plugin settings', () => {
		cy.checkPluginSettings();
	});

});
