/**
 * Attaches expand and collapse functionality to the target elements.
 *
 * Icons:
 * window.expandCollapseOpen = 'fa-minus'; // Icon to show when an element is collapsed
 * window.expandCollapseClosed = 'fa-plus'; // Icon to show when an element is expanded
 *
 * Default state values:
 * open - All expand/collapse sections are expanded by default
 * closed - All expand/collapse sections are closed by default
 * first - First expand/collapse section is open and the others are closed.
 *
 * Examples:
 * ----
 * <h2 class='expand-collapse' id='section-one'>Section 1</h2>
 * <div class='section-one'>Section one content</div>
 *
 * expandCollapse('h2.expand-collapse', 'id', 'class', 'closed');
 * ----
 * <h5 role='tab' parent='section-two'>Section 2</h2>
 * <div child='section-two'>Section two content</div>
 *
 * expandCollapse("h5[role='tab']", 'parent', 'child', 'closed');
 * ----
 *
 * @param String e CSS Selector of clickable elements
 * @param String eattr Clickable element's attribute that contains the unique id.
 * @param String cattr Collapsible element's attribute that contains the matching unique id.
 * @param String state The default state of collapsible elements: open, closed, first.
 *
 * @author Matt Decker <mdecker@air.org>
 */
function expandCollapse(e, eattr, cattr, state)
{
  // Ensure constants exist
  if (typeof window.expandCollapseOpen === 'undefined') {
    window.expandCollapseOpen = 'fa-minus';
  }

  if (typeof window.expandCollapseClosed === 'undefined') {
    window.expandCollapseClosed = 'fa-plus';
  }

  // Identify clickable elements
  var elem = jQuery(e).not('[tabindex]');

  // Set tab index
  elem.attr('tabindex', 0);

  // Set role
  elem.attr('role','link');

  // Set ARIA
  switch(state)
  {
    case 'closed':
      elem.attr('aria-expanded', false);
      elem.append('<i class="expandCollapseChevron fa '+window.expandCollapseOpen+'" style="pointer-events: none;" ></i>');
      break;
    case 'open':
      elem.attr('aria-expanded', true);
      elem.append('<i class="expandCollapseChevron fa '+window.expandCollapseClosed+'" style="pointer-events: none;"></i>');
      break;
    case 'first':
      jQuery(elem).each(function(i, v) {
        if (i == 0) {
          jQuery(this).attr('aria-expanded', false).attr('first','true');
          jQuery(this).append('<i class="expandCollapseChevron fa '+window.expandCollapseOpen+'" style="pointer-events: none;" ></i>');
        } else {
          jQuery(this).attr('aria-expanded', true).attr('first','false');
          jQuery(this).append('<i class="expandCollapseChevron fa '+window.expandCollapseClosed+'" style="pointer-events: none;"></i>');
        }
      });
      break;
  }

  // Set cursor
  elem.css('cursor', 'pointer');

  // Set click handler
  elem.on('keypress click', {elem: e, eattr: eattr, cattr: cattr, state: state}, toggleContent);

}

/**
 * Toggles content, chevron, and aria state.
 *
 * @param Object e Click event (e.data contains passed values)
 *
 * @author Matt Decker <mdecker@air.org>
 */
function toggleContent(e)
{
  // Identify the clicked object.
  var o = jQuery(this);

  // Get the value of the given attribute from the clicked object.
  var eattrValue = o.attr(e.data.eattr);

  // Find all objects with that attribute and value.
  var childSelector = "["+ e.data.cattr + "='" + eattrValue + "']"; // [aria-labelledby='huzzah']

  // Toggle matching objects
  try {
    jQuery(childSelector).toggle();
  } catch(e)
  {
    console.error('Could not toggle content.');
  }

  // Toggle chevron
  try {
    jQuery(this).children('i').toggleClass(window.expandCollapseOpen).toggleClass(window.expandCollapseClosed); // MODIFIED FOR NCII
  } catch(e)
  {
    console.error('Could not toggle chevron.');
  }

  // Toggle ARIA
  try {
    jQuery(this).attr('aria-expanded', function (i, attr) {
      return attr == 'true' ? 'false' : 'true'
    });
  } catch(e)
  {
    console.error('Could not toggle ARIA.');
  }
}