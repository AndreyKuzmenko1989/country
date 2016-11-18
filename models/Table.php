<?php
 class Table {
	
	public $pdo;
    
    
	public function __construct($dns,$user,$pass) {
		try {
        $this->pdo = new PDO($dns, $user, $pass);
        }
		catch(Exception $e) {
			exit($e->getMessage());
		}
		
		
	}
    
	public function get_table() 
    {
	   foreach($this->pdo->query('
    SELECT country.name,GROUP_CONCAT(lang.name),citys.citys
    FROM country LEFT JOIN country_lang on country.id = country_lang.id_country
    LEFT JOIN lang on country_lang.id_lang = lang.id 
    LEFT JOIN ( SELECT city.id_country,GROUP_CONCAT(city.name) as citys 
    FROM `city`GROUP BY city.id_country) as citys ON citys.id_country = country.id
    GROUP by country.id
    ',PDO::FETCH_NUM) as $row) {
        $rows[] = $row;
        }
    return ($rows);
		
	}
     
     public function get_country() 
     {
	   foreach($this->pdo->query('SELECT country.id,country.name FROM `country` ORDER By country.id',PDO::FETCH_NUM) as $row) {
        $rows[] = $row;
        }
            if (empty($rows)){
                $rows=0;
            }   
    return ($rows);
		
	}
     
     public function get_country_id($id) 
     {
         if ($id == 0){
        foreach($this->pdo->query("SELECT country.id,country.name FROM `country` ",PDO::FETCH_NUM) as $row) {
                $rows[] = $row;
        }
            if (empty($rows)){
                $rows=0;
            }    
       }
        else{
	       foreach($this->pdo->query("SELECT country.id,country.name FROM `country` WHERE country.id = $id",PDO::FETCH_NUM) as $row) {
           $rows[] = $row;
        }
             if (empty($rows)){
                $rows=0;
            }   
        }
	   
    return ($rows);
		
	}
     
      public function get_city_id($id,$id_country) 
    {
       if ($id == 0){
        foreach($this->pdo->query("SELECT city.id,city.name,city.id_country  FROM `city` WHERE id_country = $id_country",PDO::FETCH_NUM) as $row) {
       $rows[] = $row;
        }
            if (empty($rows)){
                $rows=0;
            }    
       }
        else{
	       foreach($this->pdo->query("SELECT city.id,city.name,city.id_country  FROM `city` WHERE id = $id AND id_country = $id_country",PDO::FETCH_NUM) as $row) {
            $rows[] = $row;
            }
            if (empty($rows)){
                $rows=0;
            }
        }
     return ($rows);
		
	}
     
     public function get_city($id) 
    {
          
	   foreach($this->pdo->query("SELECT city.id,city.name  FROM `city` WHERE id_country = $id",PDO::FETCH_NUM) as $row) {
       $rows[] = $row;
        }
            if (empty($rows)){
                $rows=0;
            }
     return ($rows);
		
	}
     public function get_lang($id) 
    {
      foreach($this->pdo->query("
       SELECT  lang.id , lang.name 
       FROM country LEFT JOIN country_lang ON country.id = country_lang.id_country 
       LEFT JOIN lang  ON country_lang.id_lang = lang.id
       WHERE country.id = $id
       ",PDO::FETCH_NUM) as $row) {
        $rows[] = $row;
        }
        if (empty($rows)){
        $rows=0;
        }
   return ($rows);
		
	}
     
     public function get_lang_id($id,$id_lang) 
    {
      foreach($this->pdo->query("
       SELECT  lang.id , lang.name 
       FROM country LEFT JOIN country_lang ON country.id = country_lang.id_country 
       LEFT JOIN lang  ON country_lang.id_lang = lang.id
       WHERE country.id = $id
       AND lang.id = $id_lang
       ",PDO::FETCH_NUM) as $row) {
        $rows[] = $row;
        }
        if (empty($rows)){
        $rows=0;
        }
   return ($rows);
		
	}
     
     
     public function get_lang_string($id) 
    {
       foreach($this->pdo->query("
       SELECT  GROUP_CONCAT(lang.name) as langs FROM country LEFT JOIN country_lang ON country.id = country_lang.id_country 
       LEFT JOIN lang  ON country_lang.id_lang = lang.id
       WHERE country.id = $id
       ",PDO::FETCH_NUM) as $row) {
        $rows[] = $row;
        }
       if (empty($rows)){
        $rows=0;
        }
    return ($rows);
		
	}
    public function add_row_city($name,$id) 
    {
        $name_add = '"';
        $name_add .= $name;
        $name_add .= '"'; 
        $this->pdo->query("INSERT INTO `city`(`name`, `id_country`) VALUES ($name_add,$id)") ;
    }
    public function add_row_country($name) 
    {
        $name_add = '"';
        $name_add .= $name;
        $name_add .= '"'; 
       // echo $name_add ;
	   $this->pdo->query("INSERT INTO `country`(`name`) VALUES ($name_add)") ;
    }
    public function get_max_country() 
    {
        foreach($this->pdo->query("
        SELECT MAX(id) FROM `country`",PDO::FETCH_NUM) as $row) {
        $rows[] = $row;
        }
        $max = $rows[0][0];
        return ($max);
    }
    public function get_max_city() 
    {
        foreach($this->pdo->query("
        SELECT MAX(id) FROM `city`",PDO::FETCH_NUM) as $row) {
        $rows[] = $row;
        }
        $max = $rows[0][0];
        return ($max);
    }
     public function get_max_lang() 
    {
        foreach($this->pdo->query("
        SELECT MAX(id) FROM `lang`",PDO::FETCH_NUM) as $row) {
        $rows[] = $row;
        }
        $max = $rows[0][0];
        return ($max);
    }
        
    public function add_row_lang($name,$id) 
    {
        $name_add = '"';
        $name_add .= $name;
        $name_add .= '"'; 
        $this->pdo->query("INSERT INTO `lang`(`name`) VALUES ($name_add)") ;
        foreach($this->pdo->query("
        SELECT MAX(id) FROM `lang`",PDO::FETCH_NUM) as $row) {
        $rows[] = $row;
        }
        $max = $rows[0][0];
        $this->pdo->query("INSERT INTO `country_lang`(`id_lang`,`id_country`) VALUES ($max,$id)") ;
        
    }
    
     public function get_city_list() 
    {
       
        foreach($this->pdo->query("SELECT city.id,city.name  FROM `city`",PDO::FETCH_NUM) as $row) {
       $rows[] = $row;
        }
            if (empty($rows)){
                $rows=0;
            }    
             
     return ($rows);
		
	}
     public function get_lang_list() 
    {
       
        foreach($this->pdo->query("SELECT lang.id , lang.name  FROM `lang`",PDO::FETCH_NUM) as $row) {
       $rows[] = $row;
        }
            if (empty($rows)){
                $rows=0;
            }    
             
     return ($rows);
		
	}
     public function del_country($id)
     {
        foreach($this->pdo->query("
        SELECT id FROM `country_lang` WHERE id_country = $id",PDO::FETCH_NUM) as $row) {
        $rows[] = $row[0];
        }
        if (!empty($rows))
        {
            foreach($rows as $id_c_l){
                $this->pdo->query("DELETE FROM `country_lang` WHERE id = $id_c_l",PDO::FETCH_NUM);
            }
               
        }
        foreach($this->pdo->query("
        SELECT id FROM `city` WHERE id_country = $id",PDO::FETCH_NUM) as $row_city) {
        $rows_city[] = $row_city[0];
        }
        if (!empty($rows_city))
        {
            foreach($rows_city as $id_city){
                $this->pdo->query("DELETE FROM `city` WHERE id = $id_city",PDO::FETCH_NUM);
            }
               
        }
        $this->pdo->query("DELETE FROM `country` WHERE id = $id",PDO::FETCH_NUM);
                 
     }
     public function del_city($id)
     {
        
        $this->pdo->query("DELETE FROM `city` WHERE id = $id",PDO::FETCH_NUM);
                 
     }
     public function del_lang($id)
     {
        foreach($this->pdo->query("
        SELECT id FROM `country_lang` WHERE id_lang = $id",PDO::FETCH_NUM) as $row) {
        $rows[] = $row[0];
        }
        if (!empty($rows))
        {
            foreach($rows as $id_c_l){
                $this->pdo->query("DELETE FROM `country_lang` WHERE id = $id_c_l",PDO::FETCH_NUM);
            }
               
        }
        
        $this->pdo->query("DELETE FROM `lang` WHERE id = $id",PDO::FETCH_NUM);
                 
     }
     public function upd_country($id,$name)
     {
        $name_add = '"';
        $name_add .= $name;
        $name_add .= '"'; 
        $this->pdo->query("UPDATE `country` SET name = $name_add WHERE id = $id",PDO::FETCH_NUM);
                 
     }
     public function upd_city($id,$name)
     {
        $name_add = '"';
        $name_add .= $name;
        $name_add .= '"'; 
        $this->pdo->query("UPDATE `city` SET name = $name_add WHERE id = $id",PDO::FETCH_NUM);
                 
     }
     public function upd_lang($id,$name)
     {
        $name_add = '"';
        $name_add .= $name;
        $name_add .= '"'; 
        $this->pdo->query("UPDATE `lang` SET name = $name_add WHERE id = $id",PDO::FETCH_NUM);
                 
     }
     
     
     
     

    
 }
 
    