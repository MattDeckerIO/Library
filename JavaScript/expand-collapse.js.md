# Accessible Expand/Collapse
> Creates expand/collapse sections with a label and a body.

### expand_collapse.html.twig
```html
<div class="expand-collapse wrapper">
  <div class="expand-collapse label">
    {{ content.label }}
  </div>
  <div class="expand-collapse body">
    {{ content.body }}
  </div>
</div>
```

### expand-collapse.sass
```scss
/* Styles for when the button is active */
.expand-collapse.wrapper
{
  .label
  {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    cursor: pointer;
    &[aria-expanded='true'],
    &:hover
    {
      /* Styles for the active/hover buton. */
    }
  }
  .body
  {
    /* Styles for the body. */
  }
}
```

### [theme].layouts.yml
```yaml
expand_collapse:
  label: Expand Collapse
  category: Layouts
  template: layouts/expand_collapse
  regions:
    label:
      label: Label
    body:
      label: Body
```

### theme.libraries.yml
```yaml
global-styling:
  version: VERSION
  js:
    js/global.js: {}
  css:
    component:
      css/styles.css: {}
      //netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css: {}
```

### global.js
```javascript
jQuery(function($){

  // Attach expand/collapse handlers
  expandCollapse(true, '.expand-collapse.label','.expand-collapse.body', 2);

});

/**
 * Attaches expand and collapse functionality to the target elements.
 *
 * The selector string is the element that the user clicks with the keyboard
 * or mouse. This element is automatically given a tab index, aria state, a
 * cursor pointer, and a chevron. The aria state and chevron automatically
 * toggles appropriately. The number of levels is the number of levels to go
 * up through the dom then search all of the children. Only go as high as
 * needed in order to find the common parent.
 *
 * @param String d Default state; true = closed, false = open
 * @param String e CSS Selector of clickable elements
 * @param String t CSS Selector of collapsible content
 * @param String l Number of levels to search for the collapsible content
 *
 * @author Matt Decker <mdecker@air.org>
 */
function expandCollapse(d, e, t, l)
{
  // Identify elements
  var elem = jQuery(e).not('[tabindex]');

  // Set tab index
  elem.attr('tabindex', 0);

  // Set role
  elem.attr('role','link');

  // Set ARIA
  if (d)
  {
    elem.attr('aria-expanded', false);
  } else
  {
    elem.attr('aria-expanded', true);
  }

  // Set chevron
  if (d)
  {
    elem.append('<i class="expandCollapseChevron icon-chevron-down" style="pointer-events: none;" ></i>');
  } else {
    elem.append('<i class="expandCollapseChevron icon-chevron-up" style="pointer-events: none;"></i>');
  }

  // Set cursor
  elem.css('cursor', 'pointer');

  // Set click handler
  elem.on('keypress click', {target: t, limit: l}, toggleContent);

}

/**
 * Toggles content, chevron, and aria state. Along with the clicked element
 * this function requires e.data.target which is the content to toggle, and
 * e.data.limit which is the number of levels to search for that content.
 *
 * @param Object e DOM Object that was clicked
 *
 * @author Matt Decker <mdecker@air.org>
 */
function toggleContent(e)
{
  // Identify elements
  var targ = jQuery(e.target);
  var content = locateElement(targ, e.data.target, e.data.limit);

  // Toggle content
  try {
    content.toggle();
  } catch(e)
  {
    console.error('Could not toggle content.');
  }

  // Toggle chevron
  try {
    locateElement(targ, 'i', 1).toggleClass('icon-chevron-down').toggleClass('icon-chevron-up');
  } catch(e)
  {
    console.error('Could not toggle chevron.');
  }

  // Toggle ARIA
  try {
    targ.attr('aria-expanded', function (i, attr) {
      return attr == 'true' ? 'false' : 'true'
    });
  } catch(e)
  {
    console.error('Could not toggle ARIA.');
  }

}

/**
 * Searches for a CSS selector given a starting element and number
 * of parents to search through.
 *
 * @param Object e Object from which to start earching
 * @param Object n CSS Selector to locate
 * @param Integer l Number of parents to search through
 * 
 * @return Object Returns the found element or false.
 *
 * @author Matt Decker <mdecker@air.org>
 */
function locateElement(e, n, l = 2)
{
  var limit = l;
  var i = 0;

  while (i < limit)
  {
    var elem = e.find(n);
    if (elem.length != 0)
    {
      return elem;
    } else {
      e = e.parent();
    }
    i++;
  }

  return false;
}
```