<?php

/**
 * Contenates the view name and view display
 *
 * @param View $view
 * @return String viewName_viewCurrentDisplay
 */
function designgoggles_views_identifier($view)
{
  $name = isset($view->name)?$view->name:'';
  $display = isset($view->current_display)?$view->current_display:'';
  return sprintf('%s_%s', $name, $display);
}