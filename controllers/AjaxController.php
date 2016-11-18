<?
include_once ROOT. '/models/Table.php';
class AjaxController
{
    public function actionGetcity($id=1)
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $citys = $obj->get_city($id);
        print json_encode($citys);
        
    }
    public function actionGetlang($id=1)
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $lang = $obj->get_lang($id);
        print json_encode($lang);
        
        
    }
      public function actionGetcountry($id=1)
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $country = $obj->get_country();
        print json_encode($country);
        
    }
    public function actionAddcountry()
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $name = $_POST['add_country_name'];
        $add = $obj->add_row_country($name);
    }
    public function actionAddcity()
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $id_country = $_POST['country_city'];
        $name_city = $_POST['name_city'];
        $add1 = $obj->add_row_city($name_city,$id_country);
       
    }
    public function actionAddlang()
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $id_country = $_POST['idcountry_lang'];
        $name_lang = $_POST['name_lang'];
        $add = $obj->add_row_lang($name_lang,$id_country);
    }
    public function actionDelcountry()
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $id_country = $_POST['idcountry_del'];
        $del = $obj->del_country($id_country);
    }
    public function actionDelcity()
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $id_city = $_POST['idcity_del'];
        $del = $obj->del_city($id_city);
    }
    public function actionDellang()
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $id_lang = $_POST['idlang_del'];
        $del = $obj->del_lang($id_lang);
    }
    public function actionUpdcountry()
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $id_country = $_POST['idcountry_upd'];
        $new_name = $_POST['name_coutry_new'];
        $del = $obj->upd_country($id_country,$new_name);
    }
     public function actionUpdcity()
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $id_city = $_POST['id_city_upd'];
        $new_name = $_POST['name_city_new'];
        $del = $obj->upd_city($id_city,$new_name);
    }
    public function actionUpdlang()
    {
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        $id_lang = $_POST['id_lang_upd'];
        $new_name = $_POST['name_lang_new'];
        $del = $obj->upd_lang($id_lang,$new_name);
    }
}