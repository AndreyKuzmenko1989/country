Сайт запускаеться с дерикторий:
http://localhost/country/index
http://localhost/country/index.php
http://localhost/country
REST интерфейс реализован в такой деритории:
http://localhost/country/rest/
Для GET метода реализвано:
GET /countries или /countries/ -возвращает список всех стран
GET /countries/{id}  - возвращает только информацию по стране (id, название)
GET /countries/{id}/cities или GET /countries/{id}/cities/ - возвращает список городов для конкретной страны
GET /countries/{id}/cities/{id} - возвращает информацию по городу (id, название)
GET /countries/{id}/cities/{id}/lang - возвращает список языков для города
GET /countries/{id}/cities/{id}/lang/{id} - возвращает информацию по языку (id, название)
POST
POST /countries или /countries/ -добовить страну $_POST['country_name']
POST /countries/{id}  - выводит Bad Request
POST /countries/{id}/cities или GET /countries/{id}/cities/ -добовить город ($_POST['city_name'],$_POST['id_country'])
POST /countries/{id}/cities/{id} - выводит Bad Request
POST /countries/{id}/cities/{id}/lang - добовить язык ($_POST['lang_name'],$_POST['id_country_lang'])
POST /countries/{id}/cities/{id}/lang/{id} - выводит Bad Request
PUT
PUT /countries или /countries/ - выводит Bad Request
PUT /countries/{id}-изменить страну $_PUT['country_name']  
PUT /countries/{id}/cities или GET /countries/{id}/cities/ - выводит Bad Request
PUT /countries/{id}/cities/{id}-изменить город ($_PUT['city_name']) 
PUT /countries/{id}/cities/{id}/lang- выводит Bad Request
PUT /countries/{id}/cities/{id}/lang/{id} - изменить язык ($_PUT['lang_name']) 
DELETE
DELETE /countries или /countries/ - выводит No Content(считаю небезопасным реализовывать этот метод)
DELETE /countries/{id}-удалить страну с {id}
DELETE /countries/{id}/cities или GET /countries/{id}/cities/ - выводит No Content(считаю небезопасным реализовывать этот метод)
DELETE /countries/{id}/cities/{id}-удалить город с {id}
DELETE /countries/{id}/cities/{id}/lang -  выводит No Content(считаю небезопасным реализовывать этот метод)
DELETE /countries/{id}/cities/{id}/lang/{id} - удалить язык с {id}

