<?php

/**
 * Takes a $view->result array and eliminates duplicates based on a given key
 *
 * @author Matt Decker <mdecker@deckerwebdesign.com>
 * @param String $uniqueKey Typically 'nid'
 * @param Array $resultArray $view->result array
 * @return Array of view result objects
 */
function designgoggles_views_deduplicator($uniqueKey, $resultArray)
{
  $output = array();
  foreach($resultArray as $result)
  {
    $k = $result->$uniqueKey;
    if (!array_key_exists($k, $output))
    {
      $output[$k] = $result;
    }
  }
  return $output;
}