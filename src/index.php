<?hh
require_once '../vendor/autoload.php';
require_once '../vendor/hh_autoload.php';


$model = new Model();
$response = $model->getBasicInfo('17841405662728164');
$basic_info = $response->getGraphNode()->asArray();

echo View::genIndex($basic_info);
