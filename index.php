<?php

function imgNodeRemove($xml)
{
	$xmlDoc = isXMLFileorString($xml);

	$nodesToDelete = array();
	/**
	 * First, I do a search for those nodes
	 * that contain an image node.
	 */
	foreach ($xmlDoc as $profile) {

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
	saveXMLFileorString($xmlDoc, $xml);
}


imgNodeRemove('profile.xml');
// imgNodeRemove('<xml>
// <profile>
// 	<img src="profile"/>
// </profile>
// <profile>
// 	<tag> foo </tag>
// </profile>
// </xml>');

function isXMLFileorString($inputXML)
{
	if ($inputXML === '') {
		var_dump("Not Found XML");
	} elseif (file_exists($inputXML)) {
		$xmlDoc = new SimpleXMLElement($inputXML, 0, true);
	}
	else {
		$xmlDoc = new SimpleXMLElement($inputXML, 0, false);
	}
	return $xmlDoc;
}

function saveXMLFileorString($xmlDoc, $xml)
{
	if (file_exists($xml)) {
		return $xmlDoc->saveXML($xml);
	}
	// var_dump($xmlDoc->asXML());
	return $xmlDoc->asXML();
}
