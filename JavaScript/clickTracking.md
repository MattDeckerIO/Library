# Google Analytics Click Tracking
> Enable click tracking for user interactive events

Examples of click tracking:
* Activating search facets
* Clicking buttons
* Clicking carousel elements
* Clicking pagers
* Expanding/Collapsing sections

Google Analytics:
* [Google gtag.js](https://developers.google.com/analytics/devguides/collection/gtagjs/events)
* [Google analytics.js](https://developers.google.com/analytics/devguides/collection/analyticsjs/events)

Browser Debuggers:
* [Google Analytics Debugger Chrome](https://chrome.google.com/webstore/detail/google-analytics-debugger/jnkmfdileelhofjcijamephohjechhna?hl=en)

* [Google Analytics Debugger Firefox](https://addons.mozilla.org/en-US/firefox/addon/ga-debugger/)

### click-tracking.js
```javascript
<script>
jQuery(document).ready(function(){

  // Apply click tracking to an element
  jQuery('WRAPPER ELEMENT').on('click', 'TARGET ELEMENT', function() {
    var title= jQuery(this).text();
    // console.log(title);
    var page=window.location.pathname;
    // console.log(page);
    gtag('event', 'EVENT TYPE', {
      'event_category': page,
      'event_label': title,
      'value': state // OPTIONAL: Numeric value
    });
  });

});
</script>
```
## Variables:
### WRAPPER ELEMENT
The selector of element that contains the element that is going to be clicked. e.g. a div.

### TARGET ELEMENT
The selector of the element that will be interacted with e.g. `a` or `button`.

### EVENT TYPE
The grouping that this event belongs to. e.g. `clicks` or `facets` or `carousel` or `expand/collape`.

### event_category
Required. Set to any variable or value to group these events. e.g. the page that they happened on.

### event_label
Required. Set to an identifier for the clicked element e.g. the `button text` or `facet term id`.

### value
OPTIONAL. Can be used to track a numeric value e.g. 1 if a facet is enabled and 0 if a facet is disabled.

Example of using a value:
```javascript
    var state=-1; // Default invalid value

    // This seems backwards, but it is correct.
    if (jQuery(this).find('a.is-active').length > 0)
    {
      state = 0; // Facet is enabled
    } else {
      state = 1; // Facet is disabled
    }
    ...
    'event_category': var1,
    'event_label': var2,
    'value' = state // Set the value
    ...
```

## Debugging:
1. Activate the Google Analytics Debugger. You should see Google Analytics code and tracking information in the Web Developer Toolsbar console.
2. Trigger the event.
3. View the console to see if the event was tracked.
4. If the wrong information was passed or it did not trigger properly:
   1. Locate and open the javascript file in the Web Developer Toolbar's Sources tab.
   2. Make changes to the file within the sources tab and hit save.
   3. Trigger the event.
   4. Once the event is working as intended copy the new code from the sources tab into your code editor.