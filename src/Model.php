<?hh

class Model {

  private Facebook\Facebook $fb;

  public function __construct() {
    $this->fb = $this->initFB();
  }

  public function initFB() {
    return new Facebook\Facebook([
      'app_id' => getenv('APP_ID'),
      'app_secret' => getenv('APP_SECRET'),
      'default_graph_version' => 'v2.12',
      'default_access_token' => getenv('APP_USER_TOKEN'),
    ]);
  }

  public function getBasicInfo(string $ig_business_id) {
    $response = $this->fb->get('/'.$ig_business_id.'?fields=biography,followers_count,follows_count,id,ig_id,media_count,name,profile_picture_url,username,website');
    return $response;
  }

}
