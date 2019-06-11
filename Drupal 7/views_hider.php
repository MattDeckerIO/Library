<?php

/**
 * Takes a $view->result array hides nodes based on a given boolean field
 * e.g. "field_private" events that should be excluded from a view.
 *
 * @author Matt Decker <mdecker@deckerwebdesign.com>
 * @param String $checkField A field name
 * @param String $valueIfHidden Hide nodes if the field equals this value
 * @param Array $resultArray $view->result array
 * @param Boolean $debug If debug is true, add debugging output to titles
 * @return Array of view result objects excluding the hidden nodes.
 */
function designgoggles_views_hider($checkField, $valueIfHidden, $resultArray, $debug = FALSE)
{

	// Collector with NIDs as keys and values as result objects
	$inputArray = array();
	foreach($resultArray as $a)
	{
		$nid = $a->nid;
		$inputArray[$nid] = $a;
	}

	// Extract all of the result NIDs
	$inputArrayNIDs = array_keys($inputArray);

	// Load all of the result nodes
	$resultNodes = node_load_multiple($inputArrayNIDs);

	// Loop through each result
	foreach($resultNodes as $k => $result)
	{
		// Extract the value to check
		$field = $result->$checkField;
		$value = $field['und'][0]['value'];

		// If the checked value equals the value to hide
		if ($value == $valueIfHidden)
		{
			// Delete it
			if ($debug)
			{
				$inputArray[$k]->node_title = sprintf('HIDE %s (%s = %s) %s',$checkField, $value, $valueIfHidden, $inputArray[$k]->node_title);
			} else {
				unset($resultNodes[$k]);
			}
		} else {
			if ($debug)
			{
				$inputArray[$k]->node_title = sprintf('SHOW %s (%s != %s) %s',$checkField, $value, $valueIfHidden, $inputArray[$k]->node_title);
			}
		}
	}
	
	// Only return result objects with matching NIDs
	return array_intersect_key($inputArray, $resultNodes);
}