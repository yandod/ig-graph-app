<?hh
require_once '../vendor/autoload.php';
require_once '../vendor/hh_autoload.php';

$target_account = '17841401630294015';

$model = new Model();
$response = $model->getBasicInfo($target_account);
$basic_info = $response->getGraphNode()->asArray();
$response = $model->getDailyImpressions($target_account);
$daily_imps = $response->getGraphEdge();

echo View::genIndex($basic_info, $daily_imps);
