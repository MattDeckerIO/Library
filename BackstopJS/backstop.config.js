// INSTALLATION:
// backstop init
// Enter environment domains and scenarios.
// Put cookie authentication data into /backstop_data/engine_scripts/cookies.json

// USAGE:
// backstop test --env=dev
// backstop reference

var envs = {
  'lcl' : 'http://local.domain.com',
  'dev' : 'https://user:pass@dev.domain.com',
  'stg' : 'https://user:pass@stg.domain.com',
  'prd' : 'https://www.domain.com'
}

var env = 'prd';
var argv = process.argv.slice(2);
var testURL = envs[env];

argv.forEach(function (e) {
  var dat = e.split('=');
  if (dat.length == 2 && dat[0] == '--env') { env = dat[1]; }
});

if (env && envs[env] !== undefined) { testURL = envs[env] }

module.exports = {
  "id": "backstop_default",
  "viewports": [
    {
      "label": "phone",
      "width": 360,
      "height": 640
    },
    {
      "label": "tablet",
      "width": 768,
      "height": 1024
    },
    {
      "label": "desktop_large",
      "width": 1920,
      "height": 1080
    }
  ],
  "scenarioDefaults": {
    // Remove the element and retain the space.
    "hideSelectors": [
      ""
    ],
    // Remove the element and retain the space.
    "removeSelectors": [
      "svg.ext",
    ],
    "delay": 5000,
    "cookiePath": "backstop_data/cookies/env.project.json",
    "onBeforeScript": "puppet/onBefore.js",
  },
  "scenarios": [
    {
      "label": "Home",
      "url": `${testURL}/`,
      "referenceUrl": 'https://www.domain.com',
    },
  ],
  "paths": {
    "bitmaps_reference": "backstop_data/bitmaps_reference",
    "bitmaps_test": "backstop_data/bitmaps_test",
    "engine_scripts": "backstop_data/engine_scripts",
    "html_report": "backstop_data/html_report",
    "ci_report": "backstop_data/ci_report"
  },
  "report": ["browser"],
  "engine": "puppeteer",
  "engineOptions": {
    "args": ["--no-sandbox"]
  },
  "asyncCaptureLimit": 1,
  "asyncCompareLimit": 10,
  "debug": false,
  "debugWindow": false
}
