// INSTALLATION:
// backstop init — This creates the necessary scripts.
// Enter environment domains and scenarios.
// Put cookie authentication data into /backstop_data/engine_scripts/cookies.json

// USAGE:
// backstop test --env=int --filter=test
// backstop reference

var defaultDelay        = 5000;
var defaultCaptureLimit = 1;

var envs = {
  'lcl' : {
    'path': 'http://local.domain.com',
    'cookies': 'lcl.cookies.json',
    'delay' : 1,
    'asyncCaptureLimit': 10,
  },
  'dev' : {
    'path': 'https://user:pass@dev.domain.com',
    'cookies': 'dev.cookies.json',
  },
  'stg' : {
    'path': 'https://user:pass@stg.domain.com',
    'cookies': 'stg.cookies.json',
  },
  'prd' : {
    'path': 'https://www.domain.com',
    'cookies': 'prd.cookies.json',
  },
}

var argv = process.argv.slice(2);
argv.forEach(function (e) {
  var dat = e.split('=');
  if (dat.length == 2 && dat[0] == '--env') { env = dat[1]; }
});

var env = env ?? 'prd';
var path = String(envs[env]['path']);
var delay = envs[env]['delay'] ?? defaultDelay;
var asyncCaptureLimit = envs[env]['asyncCaptureLimit'] ?? defaultCaptureLimit;
var cookiePath = String(envs[env]['cookies']);

console.log('');
console.log('--')
console.log('Analyzing domain:',path);
console.log('Capturing',asyncCaptureLimit,'screen','per',delay,'ms');
console.log('With cookie file:',cookiePath);
console.log('--')
console.log('');

module.exports = {
  "id": "backstop_default",
  "viewports": [
    {
      "label": "phone",
      "width": 360,
      "height": 800,
      "source" : "https://gs.statcounter.com/screen-resolution-stats/mobile/worldwide",
    },
    {
      "label": "tablet",
      "width": 768,
      "height": 1024,
      "source": "https://gs.statcounter.com/screen-resolution-stats/tablet/worldwide",
    },
    {
      "label": "desktop_large",
      "width": 1920,
      "height": 1080,
      "source": "https://gs.statcounter.com/screen-resolution-stats/desktop/worldwide",
    }
  ],
  "scenarioDefaults": {
    // Removes the element and retains the space.
    "hideSelectors": [
      ""
    ],
    // Removes the element and the space.
    "removeSelectors": [
      ""
    ],
    "delay": delay,
    "requireSameDimensions": false,
    "cookiePath": 'backstop_data/cookies/'+cookiePath,
    "onBeforeScript": "puppet/onBefore.js",
    "onReadyScript": "puppet/onReady.js",
  },
  "scenarios": [
    {
      'label': 'UserAgent',
      'url': 'https://dnschecker.org/user-agent-info.php',
      'referenceUrl': 'https://dnschecker.org/user-agent-info.php',
      'delay': 0,
    },
    {
      // You must have at least one scenario with a 'test' keyword:
      'label': 'Homepage test',
      'url': path+'/',
      'referenceUrl': path+'/',
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
  "asyncCaptureLimit": asyncCaptureLimit,
  "asyncCompareLimit": 10,
  "debug": false,
  "debugWindow": false
}
