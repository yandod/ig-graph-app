<?hh
require '../vendor/autoload.php';

$model = new Model();
$response = $model->getBasicInfo('17841405662728164');

var_dump($response->getGraphNode()->asArray());

//View::render();
