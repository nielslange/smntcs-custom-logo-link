const { defineConfig } = require('cypress')

module.exports = defineConfig({
  screenshots: false,
  video: false,
  numTestsKeptInMemory: 0,
  e2e: {
    experimentalMemoryManagement: true,
    // We've imported your old cypress plugins here.
    // You may want to clean this up later by importing these.
    setupNodeEvents(on, config) {
      return require('./cypress/plugins/index.js')(on, config)
    },
  },
})
