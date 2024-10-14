const defaultConfig = require( '@wordpress/prettier-config' );

module.exports = {
	...defaultConfig,

	overrides: [
		{
			files: '*.yml',
			options: {
				tabWidth: 2,
			},
		},
	],
};
