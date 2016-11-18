<?
include_once ROOT. '/models/Table.php';
class RestController
{
    public function actionCountries($id = 0,$cities = "default",$id_segm = 0,$lang = "default",$id_lang = 0)
    {
      //  echo "dwdwadd";
        $obj = new Table(DATABASE_DNS, DATABASE_USER, DATABASE_PASS);
        switch ($_SERVER['REQUEST_METHOD']) {
            case "GET":
                if($id == 0 && $cities == 0 && $id_segm == 0 && $lang == "default" ){
                    $countrys = $obj->get_country_id($id);
                        if($countrys[0][0] == NULL){
                            header("HTTP/1.1 404 Not Found");
                        }
                        else{
                            header("HTTP/1.1 200 OK");
                            echo"[";
                            $string_new =" ";
                                foreach($countrys as $country ){
                                    $name = '"';
                                    $name.= $country[1];
                                    $name.= '"';   
                                    $string_new.= "{id:".$country[0].", country :".$name."},";   
                       
                                }
                            $string_new = substr($string_new, 0, -1) ;
                            echo $string_new;
                            echo"]";
                            }
                }
                
               if (ctype_digit($id) && $cities == "default" && $lang == "default"){
                    $country = $obj->get_country_id($id);
                    if($country[0][0] == NULL){
                        header("HTTP/1.1 404 Not Found");
                    }
                    else{
                    header("HTTP/1.1 200 OK");
                    echo"[";
                    $name = '"';
                    $name.= $country[0][1];
                    $name.= '"'; 
                    echo "{id :".$country[0][0].", name :".$name."}";  
                    echo"]";
                    }
                }
                
                
                if($id != 0 && $cities =='cities' && $lang == "default" && $id_segm == 0 ){
                      $citys = $obj->get_city_id($id_segm,$id);
                        if ($citys!=0){
                            $string_new =" ";
                            header("HTTP/1.1 200 OK");
                            echo"[";
                                foreach($citys as $city ){
                                    $name = '"';
                                    $name.= $city[1];
                                    $name.= '"';
                                    $string_new.="{id:".$city[0].", name :".$name.", id_country :".$city[2]."},";   
                                }
                            $string_new = substr($string_new, 0, -1) ;
                            echo $string_new;
                            echo"]";
                        }
                        else{
                            header("HTTP/1.1 404 Not Found");
                        }
                }
                
                if($id != 0 && $cities =='cities' && $lang == "default" && $id_segm != 0 ){
                      $citys = $obj->get_city_id($id_segm,$id);
                        if ($citys!=0){
                            header("HTTP/1.1 200 OK");
                            echo"[";
                                foreach($citys as $city ){
                                    $name = '"';
                                    $name.= $city[1];
                                    $name.= '"';
                                    echo "{id:".$city[0].", name :".$name.", id_country :".$city[2]."}";   
                                }
                            echo"]";
                        }
                        else{
                            header("HTTP/1.1 404 Not Found");
                        }
                }
                
                if($id != 0 && $cities =='cities'  && $id_segm != 0 && $lang == 'lang' && $id_lang == 0){
                   $langs = $obj->get_lang($id);
                   if($langs != 0)
                    {
                        $string_new =" ";
                        header("HTTP/1.1 200 OK");
                        echo"[";
                        foreach($langs as $lang ){
                            $name = '"';
                            $name.= $lang[1];
                            $name.= '"';
                            $string_new.="{id :".$lang[0].", name :".$name."},";   
                        }
                        $string_new = substr($string_new, 0, -1) ;
                        echo $string_new;
                        echo"]";
                    }
                    else{
                         header("HTTP/1.1 404 Not Found");
                    }
                    
                }
                if($id != 0 && $cities =='cities'  && $id_segm != 0 && $lang == 'lang' && ctype_digit($id_lang)){
                    $langs = $obj->get_lang_id($id,$id_lang);
                    if($langs != 0)
                    {
                        header("HTTP/1.1 200 OK");
                        echo"[";
                        foreach($langs as $lang ){
                            $name = '"';
                            $name.= $lang[1];
                            $name.= '"';
                            echo "{id :".$lang[0].", name :".$name."}";   
                        }
                        echo"]";
                    }
                    else{
                         header("HTTP/1.1 404 Not Found");
                    }
                   
                }
               
              
                break;
                
            case "POST":
              //  echo $_POST['country_name'];
                $url_req = $_SERVER['REQUEST_URI'];
                $url_pieces = explode("/", $url_req);
                $size_url = count($url_pieces);
               // echo $size_url;
                for($i=3;$i<$size_url;$i++){
                  $url_need[] = $url_pieces[$i];
                }
                if( count($url_need) ==1  && $url_need[0] == 'countries' ){
                    if(isset($_POST['country_name'])){
                        $new = $obj->add_row_country($_POST['country_name']);
                        $id_new = $obj->get_max_country();
                         header("HTTP/1.1 201 Created");
                         echo"Location: /rest/countries/$id_new";
                    }
                   
                }
                if( count($url_need) == 2 && $url_need[0] == 'countries' && $url_need[1] == ''){
                    
                    if(isset($_POST['country_name'])){
                        $new = $obj->add_row_country($_POST['country_name']);
                        $id_new = $obj->get_max_country();
                         header("HTTP/1.1 201 Created");
                         echo"Location: /rest/countries/$id_new";
                    }
                    
                }
                if( count($url_need) == 2 && $url_need[0] == 'countries' &&  $url_need[1] != ''){
                    
                    header("HTTP/1.1 400 Bad Request");
                                                           
                }
                if( count($url_need) == 3 && $url_need[0] == 'countries' && ctype_digit($url_need[1]) && $url_need[2] == 'cities'){
                    
                     if(isset($_POST['city_name']) && isset($_POST['id_country'])){
                        $new_city = $obj->add_row_city($_POST['city_name'],$_POST['id_country']);
                        $id_new_city = $obj->get_max_city();
                        $id_country =$_POST['id_country'];
                        header("HTTP/1.1 201 Created");
                        echo"Location: /rest/countries/$id_country/cities/$id_new_city";
                    
                    }
                    
                }
                
                if( count($url_need) == 4 && $url_need[0] == 'countries' && ctype_digit($url_need[1]) && $url_need[2] == 'cities' && $url_need[3] == ''){
                    
                     if(isset($_POST['city_name']) && isset($_POST['id_country'])){
                        $new_city = $obj->add_row_city($_POST['city_name'],$_POST['id_country']);
                        $id_new_city = $obj->get_max_city();
                        $id_country =$_POST['id_country'];
                        
                        header("HTTP/1.1 201 Created");
                        echo"Location: /rest/countries/$id_country/cities/$id_new_city";
                    
                    }
                    
                }
                if( count($url_need) == 4 && $url_need[0] == 'countries' && ctype_digit($url_need[1]) && $url_need[2] == 'cities' && $url_need[3] != ''){
                    
                      header("HTTP/1.1 400 Bad Request");
                    
                }
                if( count($url_need) == 5 && $url_need[0] == 'countries' && ctype_digit($url_need[1]) && $url_need[2] == 'cities' && ctype_digit($url_need[3]) && $url_need[4] == 'lang'){
                    
                       if(isset($_POST['lang_name']) && isset($_POST['id_country_lang'])){
                        $new_city = $obj->add_row_lang($_POST['lang_name'],$_POST['id_country_lang']);
                        $id_new_lang = $obj->get_max_lang();
                        $id_country =$_POST['id_country_lang'];
                        
                        header("HTTP/1.1 201 Created");
                        echo"Location: /rest/countries/$id_country/cities/$url_need[3]/lang/$id_new_lang";
                    
                    }
                }
                if( count($url_need) == 6 && $url_need[0] == 'countries' && ctype_digit($url_need[1]) && $url_need[2] == 'cities' && ctype_digit($url_need[3]) && $url_need[4] == 'lang' && $url_need[5] ==''){
                    
                       if(isset($_POST['lang_name']) && isset($_POST['id_country_lang'])){
                        $new_city = $obj->add_row_lang($_POST['lang_name'],$_POST['id_country_lang']);
                        $id_new_lang = $obj->get_max_lang();
                        $id_country =$_POST['id_country_lang'];
                        
                        header("HTTP/1.1 201 Created");
                        echo"Location: /rest/countries/$id_country/cities/$url_need[3]/lang/$id_new_lang";
                    
                    }
                }
                if( count($url_need) == 6 && $url_need[0] == 'countries' && ctype_digit($url_need[1]) && $url_need[2] == 'cities' && ctype_digit($url_need[3]) && $url_need[4] == 'lang' && $url_need[5] !=''){
                    
                      header("HTTP/1.1 400 Bad Request");
                    
                }
                break;
            case "PUT":
                $_PUT = array(); 
               
                    $putdata = file_get_contents('php://input'); 
                    $exploded = explode('&', $putdata);  
                    foreach($exploded as $pair) { 
                    $item = explode('=', $pair); 
                    if(count($item) == 2) { 
                    $_PUT[urldecode($item[0])] = urldecode($item[1]); 
                    } 
                    }  
                //----------------
                $url_request = $_SERVER['REQUEST_URI'];
                $put_pieces = explode("/", $url_request);
                $size_put = count($put_pieces);
                for($i=3;$i<$size_put;$i++){
                  $put[] = $put_pieces[$i];
                }
                if( count($put) == 1 && $put[0] == 'countries'){
                    header("HTTP/1.1 400 Bad Request");
                }
                  if( count($put) == 2 && $put[0] == 'countries' && $put[1] =='') {
                    header("HTTP/1.1 400 Bad Request");
                }
                if( count($put) == 2 && $put[0] == 'countries'  && ctype_digit($put[1]) && $put[1] !='' ){
                    if(isset($_PUT['country_name'] )){
                        header("HTTP/1.1 200 OK");
                        $id = $put[1];
                        $name = $_PUT['country_name'];
                        $obj->upd_country($id,$name);
                    }
                    
                }
                if( count($put) == 3 && $put[0] == 'countries' && ctype_digit($put[1]) && $put[2] == 'cities'){
                    
                      header("HTTP/1.1 400 Bad Request");
                    
                }
                if( count($put) == 4 && $put[0] == 'countries' && ctype_digit($put[1]) && $put[2] == 'cities' && $put[3] ==''){
                    
                      header("HTTP/1.1 400 Bad Request");
                    
                }
                if( count($put) == 4 && $put[0] == 'countries' && ctype_digit($put[1]) && $put[2] == 'cities' && ctype_digit($put[3])  && $put[3] !=''){
                    if(isset($_PUT['city_name'] )){
                        header("HTTP/1.1 200 OK");
                        $id = $put[3];
                        $name = $_PUT['city_name'];
                        $obj->upd_city($id,$name);
                    }
                                        
                }
                if( count($put) == 5 && $put[0] == 'countries' && ctype_digit($put[1]) && $put[2] == 'cities' && ctype_digit($put[3])){
                    
                    header("HTTP/1.1 400 Bad Request");
                    
                }
                if( count($put) == 6 && $put[0] == 'countries' && ctype_digit($put[1]) && $put[2] == 'cities' && ctype_digit($put[3]) && $put[4] == 'lang' && $put[5] ==''){
                    header("HTTP/1.1 400 Bad Request");
                }
                if( count($put) == 6 && $put[0] == 'countries' && ctype_digit($put[1]) && $put[2] == 'cities' && ctype_digit($put[3]) && $put[4] == 'lang' && ctype_digit($put[5])&& $put[5] !=''){
                    
                    if(isset($_PUT['lang_name'] )){
                        header("HTTP/1.1 200 OK");
                        $id = $put[5];
                        $name = $_PUT['lang_name'];
                        $obj->upd_lang($id,$name);
                    }
                }
                
                break;
            case "DELETE":
                    $_DELETE = array(); 
                    $putdata = file_get_contents('php://input'); 
                    $exploded = explode('&', $putdata);  
                    foreach($exploded as $pair) { 
                    $item = explode('=', $pair); 
                    if(count($item) == 2) { 
                    $_DELETE[urldecode($item[0])] = urldecode($item[1]); 
                    } 
                    }
                $url = $_SERVER['REQUEST_URI'];
                $delete_pieces = explode("/", $url);
                $size_delete = count($delete_pieces);
                for($i=3;$i<$size_delete;$i++){
                  $delete[] = $delete_pieces[$i];
                }
                if( count($delete) == 1 && $delete[0] == 'countries'){
                    header(" HTTP/1.1 204 No Content");
                }
                if( count($delete) == 2 && $delete[0] == 'countries'  && ctype_digit($delete[1]) && $delete[1] ==''){
                    header(" HTTP/1.1 204 No Content");                     
                }
                if( count($delete) == 2 && $delete[0] == 'countries'  && ctype_digit($delete[1]) && $delete[1] !='' ){
                    header("HTTP/1.1 200 OK");
                    $obj->del_country($delete[1]);                     
                  }
                if( count($delete) == 3 && $delete[0] == 'countries' && ctype_digit($delete[1]) && $delete[2] == 'cities' ){
                    
                    header(" HTTP/1.1 204 No Content");
                 }
                if( count($delete) == 4 && $delete[0] == 'countries' && ctype_digit($delete[1]) && $delete[2] == 'cities' && $delete[3] =='' ){
                    
                    header(" HTTP/1.1 204 No Content");
                 }
                if( count($delete) == 4 && $delete[0] == 'countries' && ctype_digit($delete[1]) && $delete[2] == 'cities' && ctype_digit($delete[3]) && $delete[3] !=''){
                    
                    header("HTTP/1.1 200 OK");
                    $obj->del_city($delete[3]);
                    
                }
                if( count($delete) == 5 && $delete[0] == 'countries' && ctype_digit($delete[1]) && $delete[2] == 'cities' && ctype_digit($delete[3]) && $delete[4] == 'lang'){
                    
                    header(" HTTP/1.1 204 No Content");
                    
                }
                if( count($delete) == 6 && $delete[0] == 'countries' && ctype_digit($delete[1]) && $delete[2] == 'cities' && ctype_digit($delete[3]) && $delete[4] == 'lang' && $delete[5] ==''){
                    
                    header(" HTTP/1.1 204 No Content");
                    
                }
                if( count($delete) == 6 && $delete[0] == 'countries' && ctype_digit($delete[1]) && $delete[2] == 'cities' && ctype_digit($delete[3]) && $delete[4] == 'lang' && ctype_digit($delete[5]) && $delete[5] !=''){
                    
                    header("HTTP/1.1 200 OK");
                    $obj->del_lang($delete[5]);
                }
                break;
        }
        
      
       
        }
                       
  }