<?
include_once ROOT. '/models/Table.php';

class CountryController
{
    public function actionIndex($id = 0)
    {
    $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
    $countrys = $obj->get_country();
    $citys = $obj->get_city($id);
    $langs = $obj->get_lang($id);
    $langs_string = $obj->get_lang_string($id);
    $city_lists = $obj->get_city_list();
    $lang_lists = $obj->get_lang_list();
    require_once(ROOT.'/views/dropdown.php');  
    }
    
       
  
}