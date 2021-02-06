<?php
function imgNodeRemove($xmlFile)
{
	$xmlDoc = new SimpleXMLElement($xmlFile, 0, true);

	foreach ($xmlDoc as $profile){
		if (isset($profile->img)) {
			$xmlDOM = dom_import_simplexml($profile);
			$xmlDOM->parentNode->removeChild($xmlDOM);
		}

	}

	return $xmlDoc->saveXML($xmlFile);

}


imgNodeRemove('profile.xml');
