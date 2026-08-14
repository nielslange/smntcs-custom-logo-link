import './commands';

// Third-party themes (e.g. Blocksy's customizer JS) throw their own
// uncaught exceptions, which are unrelated to this plugin. Don't let
// them fail the tests.
Cypress.on( 'uncaught:exception', () => false );

describe( 'Admin', () => {
	beforeEach( function () {
		cy.login();
	} );

	it( 'can ensure the SMNTCS Custom Logo Link is activated', () => {
		cy.checkPluginActivation();
	} );

	it( 'can access plugin settings', () => {
		cy.checkPluginSettings();
	} );
} );
