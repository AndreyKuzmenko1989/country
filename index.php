<?
//Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);
//Подключение файлов систем
define('TEMPLATE_DIR', $_SERVER['DOCUMENT_ROOT']."/templates/", false);
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/DB.php');
//Вызов контроллера
$router = new Router();
$router->run();
?>