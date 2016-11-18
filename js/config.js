
$(document).ready(function () {
	$('#country').change(function () {
/*
 * В переменную country_id положим значение селекта
 * (выбранная страна)
 */
		var country_id = $(this).val();
/*
 * Если значение селекта равно 0,
 * т.е. не выбрана страна, то мы
 * не будем ничего делать
 */
		if (country_id == '0') {
			$('#city').html('<option>- выберите страну -</option>');
			$('#city').attr('disabled', true);
			$('#lang').html('<option>- выберите страну -</option>');
			$('#lang').attr('disabled', true);
            $('#full_lang').html('');
			return(false);
/*
 * Очищаем второй селект с регионами
 * и блокируем его через атрибут disabled
 * туда мы будем класть результат запроса
 */
		}
		$('#city').attr('disabled', true);
		$('#city').html('<option>загрузка...</option>');
/*
 * url запроса регионов
 */
		var url = 'http://localhost/country/ajax/city/'+ country_id;
        var url1 = 'http://localhost/country/ajax/lang/'+ country_id;
        
/*
 * GET'овый AJAX запрос
 * подробнее о синтаксисе читайте
 * на сайте http://docs.jquery.com/Ajax/jQuery.get
 * Данные будем кодировать с помощью JSON
 */
		$.get(
			url,
			function (result) {
				if (result.type == 'error') {
					alert('error');
					return(false);
				}
				else {
/*
 * проходимся по пришедшему от бэк-энда массиву циклом
 */
					var options = ''; 
                    i = 0;

					$(result).each(function() {
/*
 * и добавляем в селект по региону
 */                     options += '<option value="' + result[i][0] + '">' + result[i][1] + '</option>';
                        i++;
					});
                   
					$('#city').html('<option value="0">- выберите город -</option>'+options);
					$('#city').attr('disabled', false);
					}
			},
			"json"
		);
        $.get(
			url1,
			function (result) {
				if (result.type == 'error') {
					alert('error');
					return(false);
				}
				else {
                    i = 0;
					var options = ''; 
                     var text = ''; 
					$(result).each(function() {
						options += '<option value="' + result[i][0] + '">' + result[i][1] + '</option>';
                          text += result[i][1] + ',';
                          
                        i++;
					});
                    if(options == '<option value="null">null</option>'){
                        options = '<option value="0">----Введите язык(и) для страны----</option>';
                    }
                    $('#lang').html(options);
					$('#lang').attr('disabled', false);
                    text = text.substring(0, text.length - 1); 
                    if(text =='null'){
                        text="Введите язык(и) для страны";
                    }
                    $('#full_lang').html(text);
                }
			},
			"json"
		);
    
    $('#lang').attr('disabled', true);
    $('#lang').html('<option>загрузка...</option>');
        
	});


    
});
    

    
//------------------------формы----------------------------------------------------------------------------------------------

function openbox(id){
    display = document.getElementById(id).style.display;

    if(display=='none'){
       document.getElementById(id).style.display='block';
    }else{
       document.getElementById(id).style.display='none';
    }
}
    
function add_country() {
        var msg = $('#form_add_country').serialize();
         $.ajax({
          type: 'POST',
          url: 'http://localhost/country/ajax/addcountry',
          data: msg,
          success: function(data) {
         alert('Страна добавлена');
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
 
    }
function add_city() {
    var msg   = $('#form_add_city').serialize();
    $.ajax({
          type: 'POST',
          url: 'http://localhost/country/ajax/addcity',
          data: msg,
          success: function(data) {
            alert('Город добавлен');
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
 
    }
function add_lang() {
    var msg   = $('#form_add_lang').serialize();
    $.ajax({
          type: 'POST',
          url: 'http://localhost/country/ajax/addlang',
          data: msg,
          success: function(data) {
            alert('Язык добавлен');
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
 
    }
function del_country() {
    var msg   = $('#form_del_country').serialize();
    $.ajax({
          type: 'POST',
          url: 'http://localhost/country/ajax/delcountry',
          data: msg,
          success: function(data) {
            alert('Страна удалена');
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
 
    }
function del_city() {
    var msg   = $('#form_del_city').serialize();
    $.ajax({
          type: 'POST',
          url: 'http://localhost/country/ajax/delcity',
          data: msg,
          success: function(data) {
            alert('Город удалён');
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
 
    }
function del_lang() {
    var msg   = $('#form_del_lang').serialize();
    $.ajax({
          type: 'POST',
          url: 'http://localhost/country/ajax/dellang',
          data: msg,
          success: function(data) {
            alert('Язык удалён');
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
 
    }
function upd_country() {
    var msg   = $('#form_upd_country').serialize();
    $.ajax({
          type: 'POST',
          url: 'http://localhost/country/ajax/updcountry',
          data: msg,
          success: function(data) {
            alert('Старана переименована');
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
 
    }
function upd_city(){
    var msg   = $('#form_upd_city').serialize();
    $.ajax({
          type: 'POST',
          url: 'http://localhost/country/ajax/updcity',
          data: msg,
          success: function(data) {
            alert('Город переименован');
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
    
}
function upd_lang(){
    var msg   = $('#form_upd_lang').serialize();
    alert(msg);
    $.ajax({
          type: 'POST',
          url: 'http://localhost/country/ajax/updlang',
          data: msg,
          success: function(data) {
            alert('Язык переименован');
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
}
    

 