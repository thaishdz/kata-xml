<?php

function imgNodeRemove($xmlFile)
{
	$xmlDoc = new SimpleXMLElement($xmlFile, 0, true);
	$nodesToDelete = array();

	/**
	 * First, I do a search for those nodes
	 * that contain an image node.
	 */
	foreach ($xmlDoc as $profile){

		if (isset($profile->img)) {
			$nodesToDelete[] = $profile; // add the parent node that contains image node
		}
	}
	/**
	 * Then, I remove from the array those nodes
	 * that contain an image node
	 */
	foreach ($nodesToDelete as $node) {
		/**
		 * I need to do this because the SimpleXMLElement class has a method
		 * called upset() but for any reason doesn't work, then I import to
		 * a DOMElement that contains the removeChild() method
		 */
		$xmlDOM = dom_import_simplexml($node);
		$xmlDOM->parentNode->removeChild($xmlDOM);
	}
	// overwriting the file without the image nodes
	return $xmlDoc->saveXML($xmlFile);

}


imgNodeRemove('profile.xml');
