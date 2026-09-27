import './commands';

// Ignore browser errors that come from WordPress core or third-party themes,
// not from this plugin, so they do not fail unrelated tests:
// - WordPress 7.x admin screens abort View Transitions when Cypress navigates away quickly.
// - The Blocksy theme's Customizer scripts reference its ctEvents global too early.
Cypress.on( 'uncaught:exception', ( error ) => {
	if (
		error.message.includes( 'Transition was aborted because of invalid state' ) ||
		error.message.includes( 'ctEvents is not defined' )
	) {
		return false;
	}
} );

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
