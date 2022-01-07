import './commands';

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
