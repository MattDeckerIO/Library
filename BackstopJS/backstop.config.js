var testURL = 'http://'+process.env.VIRTUAL_HOST; // Local
// var testURL = 'https://dev.domain.com'; // Development
// var testURL = 'https://stg.domain.com'; // Staging
// var testURL = 'https://www.domain.com'; // Production

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
  "scenarios": [
    {
      "label": "Home",
      "cookiePath": "backstop_data/engine_scripts/cookies.json",
      "url": `${testURL}/`,
      "referenceUrl": `https://www.domain.com`,
      "delay": 2500
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
  "asyncCaptureLimit": 2,
  "asyncCompareLimit": 10,
  "debug": false,
  "debugWindow": false
}
