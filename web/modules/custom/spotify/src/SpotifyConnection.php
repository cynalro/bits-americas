<?php

namespace Drupal\spotify;

use SpotifyWebAPI;

class SpotifyConnection 
{   

    public function connection()
  {
    $client_id = getenv('SPOTIFY_CLIENT_ID');
    $client_secret = getenv('SPOTIFY_CLIENT_SECRET');

    $session = new SpotifyWebAPI\Session($client_id, $client_secret);
    
    if (!$session->requestCredentialsToken()) {
      return null;
    }

    $accessToken = $session->getAccessToken();

    if($accessToken == null)
      return null;
      
    $api = new SpotifyWebAPI\SpotifyWebAPI(["return_assoc"=>true]);
    $api->setAccessToken($accessToken);
    
    return $api;        
  }
}