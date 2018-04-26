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
    $response = $this->fb->get(
      '/'.$ig_business_id.
      '?fields=biography,followers_count,follows_count,id,ig_id,media_count,name,profile_picture_url,username,website'
    );
    return $response;
  }

  public function getDailyImpressions(string $ig_business_id) {
    $date = new DateTime();
    $range = $this->genSinceUntil($date);
    $response = $this->fb->get(
      '/'.$ig_business_id.
      '/insights?metric=impressions,reach,profile_views&period=day'.
      '&since='.$range['since'].'&until='.$range['until']
    );
    return $response;
  }

  public function genSinceUntil(DateTime $date){
    $range = Map{
      'until' => $date->getTimestamp(),
      'since' => $date->modify('-30 day')->getTimestamp()
    };
    return $range;
  }
}
