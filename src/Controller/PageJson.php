<?php
/**
* @file
* Contains \Drupal\custom_siteinfo_configuration\Controller\PageJson class.
*/
namespace Drupal\custom_siteinfo_configuration\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
  * Controller which extend ControllerBase and gives desire output.
  */
class PageJson extends ControllerBase {
/**
  * @param $apikey
  * @param $page
  * @return: page JsonResponse array and throws access denied if condition gets false
  */
  public function Build($apikey, $page) {
    $siteapikey = \Drupal::config('custom.settings')->get('siteapikey');
    $entity_type = $page->getType();
    if (!empty($siteapikey)) {
      if ($apikey ==  $siteapikey && $entity_type == 'page') {
        return new JsonResponse( $page->toArray() );
      }
      else {
        throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
      }
    }
    else {
      throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }
  }

}


