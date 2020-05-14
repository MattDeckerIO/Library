jQuery(function($){

  // Expand/Collapse CEEDAR Dashboard Blocks
  expandCollapse('.my-cslg-groups .view-header','table', 2);
  expandCollapse('.my-inactive-cslg-groups .view-header','table', 2);

});

/**
 * Attaches expand and collapse functionality to the target elements.
 *
 * The selector string is the element that the user clicks with the keyboard
 * or mouse. This element is automatically given a tab index, aria state, a
 * cursor pointer, and a chevron. The aria state and chevron automatically
 * toggles appropriately.
 *
 * @param String e CSS Selector of clickable elements
 * @param String t CSS Selector of collapsible content
 * @param String l Number of levels to search for the collapsible content
 *
 * @author Matt Decker <mdecker@air.org>
 */
function expandCollapse(e, t, l)
{
  // Identify elements
  var elem = jQuery(e).not('[tabinde

  // Set tab index
  elem.attr('tabindex',0);

  // Set ARIA
  elem.attr('aria-expanded', true);

  // Set chevron
  elem.append('<i class="expandCollapseChevron fas fa-chevron-up" style="position: absolute; right: 0;" ></i>');

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
    locateElement(targ, 'i', 1).toggleClass('fa-chevron-down').toggleClass('fa-chevron-up');
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
