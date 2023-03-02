<?php

declare(strict_types=1);

namespace Hhcom\ContaoProjectBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Contao\Config;
use Contao\System;
use Contao\File;
use Contao\Files;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Hook("initializeSystem")
 */
class InitializeSystemListener
{
 
    public function __construct()
    {}

    public function __invoke(): void
    {
		Files::getInstance()->rrdir('var/cache/dev/contao', true);
		Files::getInstance()->rrdir('var/cache/prod/contao', true);

			
        
        if (System::getContainer()->get('request_stack')->getCurrentRequest()) {
			

			// echo '<pre>';
			// var_dump( !System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create('')) );

			// var_dump(System::getContainer()->getParameter('kernel.debug') || Config::get('cssCacheBuster'));
			// var_dump( Config::get('cssCacheBuster'));

			// exit;

			// Only in the frontend
			if (!System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''))) { 

				if (System::getContainer()->getParameter('kernel.debug') || Config::get('cssCacheBuster')) {
					$this->updateCacheBuster();
				}

			}
			
			

		
			if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''))) {			
				$GLOBALS["TL_CSS"][] = "bundles/contaoproject/style/backend.scss|static";
				$GLOBALS["TL_JAVASCRIPT"][] = "bundles/contaoproject/script/backend.js";
            } else {

				#$GLOBALS["TL_CSS"][] = "bundles/contaoproject/style/cachebuster.scss|static";
				#$GLOBALS["TL_JAVASCRIPT"][] = "bundles/contaoprojectbundle/script/whatever.js";
            }
			
			// foreach([
			// "$fontPath/opensans-light-webfont",
			// "$fontPath/opensans-regular-webfont",
			// "$fontPath/opensans-bold-webfont",
			// "$libPath/fontawesome-pro/webfonts/fa-brands-400",
			// "$libPath/fontawesome-pro/webfonts/fa-regular-400",
			// "$libPath/fontawesome-pro/webfonts/fa-light-300",
			// "$libPath/fontawesome-pro/webfonts/fa-solid-900",
			// ] as $fontFile) {
			// 	$GLOBALS["TL_HEAD"][] = "<link rel='preload' href='$fontFile.woff2' as='font' type='font/woff2' crossorigin='anonymous'>";
			// }


        }
    }



	/**
	 * Regenerate the CSS permanently, also in production mode.
	 * Include the file _cachebuster.scss in your Layout as external SCSS File
	 */
	public function updateCacheBuster() {
		$cacheBusterFilePath = System::getContainer()->getParameter('kernel.project_dir'). "/files/project/style/_cachebuster.scss";
		@ file_put_contents ($cacheBusterFilePath, " .cachebuster::before{content:'".time()."'};" ); 
	}
}

?>