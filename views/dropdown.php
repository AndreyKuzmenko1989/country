<?php
//print_r($city_lists);
?>
<!DOCTYPE html>
<html lang="ru">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="http://localhost/phone_book/css/style.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="../country/js/config.js"></script>
<head>
<meta charset="utf-8">
<title>Сайт городов и языков</title>
</head>
<body>
    <div class="vertical-center">
  
        <div class="container">
    <div class="row">
    <div id="add" style="display: none;">
    <div class="col-md-4">
        <p> 
         <div class=""  id="add_country" > 
        <div class="panel panel-primary">
       
            <div class="panel-heading">
            <h4>Добавить страну</h4>
            </div>
            <div class="panel-body">
            <form action="javascript:void(null);" method="post" id="form_add_country"  onsubmit= "add_country()" >
                <p><input type="text" name="add_country_name" id="add_country_name" value="" placeholder="Введите данные"> Название страны</p>
                <button type="submit">Добавить страну</button>
            </form>
        </div>
        </div>
        </div>
        </p>
    </div>
    <div class="col-md-4">
        <p>
        <div class=""  id="add_city" >
        <div class="panel panel-primary">
        <div class="panel-heading">
        <h4>Добавить город</h4>
        </div>
        <div class="panel-body">
            <form action="javascript:void(null);" method="post" id="form_add_city"  onsubmit="add_city()" >
                <p><input type="text" name="name_city" value="" placeholder="Введите данные"> Название города</p>
       <?php
        echo "<select type=text name='country_city' id ='country_city'>
        <option selected value = 0 >- выберите страну -</option>
        ";
    if($countrys != NULL){
    foreach($countrys as $country) {
        
   echo '<option  value="'.$country[0].'" >'.$country[1];
        } 
    }
    echo "</select>\n";       
    ?> Страна</p>
        <button type="submit">Добавить город</button>
    </form>
    </div>
    </div>
    </div>
     </p>
     </div>
     <div class="col-md-4">
   <p>  <div class=""  id="add_lang">
     <div class="panel panel-primary">
    <div class="panel-heading">
    <h4>Добавить язык</h4>
    </div>
     <div class="panel-body">
    <form action="javascript:void(null);" method="post" id="form_add_lang" onsubmit="add_lang()">
        <p><input type="text" name="name_lang" value="" placeholder="Введите данные"> Название Языка</p>
       <?php
        echo "<select type=text name='idcountry_lang' id ='idcountry_lang'>
        <option selected value = 0 >- выберите страну -</option>
        ";
    if($countrys != NULL){
    foreach($countrys as $country) {
        
   echo '<option  value="'.$country[0].'" >'.$country[1];
        } 
    }
    echo "</select>\n";       
    ?> страна</p>
        <button type="submit">Добавить язык</button>
    </form>
    </div>
    </div>
    </div>
    </p>
     </div>
    </div>
    <div id="delete" style="display: none;">
    <p><div class="col-md-4">
        <div class="panel panel-danger">
    <div class="panel-heading">    
    <h4>Удалить страну</h4>
    </div>
    <div class="panel-body">
    <form action="javascript:void(null);" method="post" id="form_del_country"   onsubmit="del_country()">
    <?php
        echo "<select type=text name='idcountry_del' id ='idcountry_del' >
        <option selected value = 0 >- выберите страну -</option>
        ";
    if($countrys != NULL){
    foreach($countrys as $country) {
        
   echo '<option  value="'.$country[0].'" >'.$country[1];
        } 
    }
    echo "</select>\n";       
    ?>
    <button type="submit">Удалить выбранную страну</button>
    </form>
    </div>
    </div>
    </div>
    </p>
    <p><div class="col-md-4">
         <div class="panel panel-danger">
    <div class="panel-heading">
     <h4>Удалить город</h4>
    </div>
    <div class="panel-body">
    <form action="javascript:void(null);" method="post" id="form_del_city"  onsubmit="del_city()">
    <?php
        echo "<select type=text name='idcity_del' id ='idcity_del'>
        <option selected value = 0 >- выберите город -</option>
        ";
    if($city_lists != NULL){
    foreach($city_lists as $city_list) {
        
   echo '<option  value="'.$city_list[0].'" >'.$city_list[1];
        } 
    }
    echo "</select>\n";       
    ?>
    <button type="submit">Удалить выбранный город</button>
    </form>
    </div>
    </div>
    </div>
    </p>
    <p><div class="col-md-4">
    <div class="panel panel-danger">
    <div class="panel-heading">
    <h4>Удалить язык</h4>
    </div>
    <div class="panel-body">
    <form action="javascript:void(null);" method="post" id="form_del_lang"  onsubmit="del_lang()">
    <?php
        echo "<select type=text name='idlang_del' id ='idlang_del'>
        <option selected value = 0 >- выберите язык -</option>
        ";
    if($lang_lists != NULL){
    foreach($lang_lists as $lang_list) {
        
   echo '<option  value="'.$lang_list[0].'" >'.$lang_list[1];
        } 
    }
    echo "</select>\n";       
    ?>
    <button type="submit">Удалить выбранный язык</button>
    </form>
    </div>
    </div>
    </div>
    </p>
    </div>
    </div>
    <div class="row">
        <div id="update" style="display: none;">
            <p><div class="col-md-4">
                <div class="panel panel-success">
                <div class="panel-heading">
                <h4>Изменить страну</h4>
                </div>
                <div class="panel-body">
                <form action="javascript:void(null);" method="post" id="form_upd_country"  onsubmit="upd_country()">
                <?php
                    echo "<p><select type=text name='idcountry_upd' id ='idcountry_upd'>
                            <option selected value = 0 >- выберите страну -</option>";
                if($countrys != NULL){
            foreach($countrys as $country) {
            echo '<option  value="'.$country[0].'" >'.$country[1];
            } 
        }
    echo "</select></p>"; 
    ?>
    <p><input type="text" name="name_coutry_new"  placeholder="Впишите новое название" > </p>
    <button type="submit">Нажмите для обновления</button>
            </form>
            </div>
            </div>
            </div>
            </p>    
       <p> <div class="col-md-4">
            <div class="panel panel-success">
            <div class="panel-heading">    
            <h4>Изменить город</h4>
            </div>
            <div class="panel-body">
            <form action="javascript:void(null);" method="post" id="form_upd_city"  onsubmit="upd_city()" >
     <?php
        echo "  <p><select type=text name='id_city_upd' id ='id_city_upd'>
        <option selected value = 0 >- выберите город для изменеия -</option>
        ";
    if($city_lists != NULL){
    foreach($city_lists as $city_list) {
        
   echo '<option  value="'.$city_list[0].'" >'.$city_list[1];
        } 
    }
    echo "</select>  </p>";       
    ?>
     <p><input type="text" name="name_city_new" placeholder="Впишите новое название"> </p>
        <button type="submit">Нажмите для обновления</button>
            </form>
        </div>
         </div>
         </div>
        </p>
       <p> <div class="col-md-4">
         <div class="panel panel-success">
         <div class="panel-heading">    
        <h4>Изменить язык</h4>
        </div>
        <div class="panel-body">
            <form action="javascript:void(null);" method="post" id="form_upd_lang"  onsubmit="upd_lang()" >
        <?php
        echo "<p><select type=text name='id_lang_upd' id ='id_lang_upd'>
        <option selected value = 0 >- выберите язык -</option>
        ";
                if($lang_lists != NULL){
        foreach($lang_lists as $lang_list) {
        
        echo '<option  value="'.$lang_list[0].'" >'.$lang_list[1];
        } 
    }
    echo "</select></p";       
    ?>
        <p><input type="text" name="name_lang_new" placeholder="Впишите новое название"> </p>
                <button type="submit">Нажмите для обновления</button>
            </form>
        </div>
         </div>
    </div>
        </p>
     </div>
    </div>
    <div class="text-center">
    <p>
    <a href="#" class="btn btn-info" onclick="openbox('add'); return false">Форма добавления</a>
    <a href="#" class="btn btn-info" onclick="openbox('delete'); return false">Форма удаления</a>
    <a href="#" class="btn btn-info" onclick="openbox('update'); return false">Форма изменения</a>
    </p>
    </div>
   
    
     <table id="data" class="table table-bordered table-hover table-striped  " >
        <thead>
		<tr>
            <th>Страна</th>
            <th>Город</th>
            <th>Язык</th>
            <th>Все языки в строчку</th>
        </tr>
	</thead>
     
       <tbody>
	<tr>
        <td>
        <?php
        echo "<select type=text name='country' id ='country'>
        <option selected value = 0 >- выберите страну -</option>
        ";
    if($countrys != NULL){
    foreach($countrys as $country) {
        
   echo '<option  value="'.$country[0].'" >'.$country[1];
        } 
    }
    echo "</select>\n";       
        ?>
        </td>
        <td>
        
       <select type=text name='city' id ='city'>
       <option selected value = 0 >- выберите страну -</option> 
       </select>
        </td>
        <td>
        <select type=text name='lang' id ='lang'>
      
        <option selected value = 0 >- выберите страну -</option>
     </select>  
        
        </td>
        <td>
            <p id ="full_lang"></p>
        </td>
        
	</tr>
	</tbody>
    </table>

        <div class="text-center">
            <a href="http://localhost/phone_book/add"  class="btn btn-success">  Добавить новую запись в книгу </a> 
        </div>
        
    
</div>
</body>
</html>