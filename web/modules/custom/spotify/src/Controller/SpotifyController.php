<?php
namespace Drupal\spotify\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\spotify\SpotifyConnection;
 
class SpotifyController extends ControllerBase { 
  public function content() {        
    $app = new SpotifyConnection();

    $api = $app->connection();

    try {
      $albums = $api->getNewReleases();      
    } catch (SpotifyWebAPIException $e) {
        echo $e;
    }   
    
    return array(
        '#theme' => 'spotify',
        '#albums' => $albums,
    );
  }  

  public function artist($id)
  {    
    $app = new SpotifyConnection();
    $api = $app->connection();

    try {       
      $album = $api->getAlbum($id);
      $artists = $api->getArtist($album['artists'][0]['id']);     
    } catch (SpotifyWebAPIException $e) {
      echo $e;
    } 
    
    return array(
      '#theme' => 'artist',      
      '#artist' => $artists,
      '#album' => $album,      
    );
  }   
}
 
