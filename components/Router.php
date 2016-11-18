<?
class Router
{
    private $routes;
     
    public function __construct()
    {
    $routesPath = ROOT.'/config/routes.php';
    $this->routes = include($routesPath);
    }
    
    
    private function getURL(){
        if(!empty($_SERVER['REQUEST_URI'])) {
            $url = trim($_SERVER['REQUEST_URI']);
            if($url == "/country/" || $url == "/country/index.php"){
                $url = "/country/index";
            }
         
            return $url;
                    
        }
        
    }
    
    public function run()
    {
        $url = $this->getURL(); 
       // echo $url;
        foreach($this->routes as $urlPattern => $path){
            if(preg_match("~$urlPattern~", $url)){
                $internalRoute = preg_replace("~$urlPattern~",$path,$url);
                $internalRoute = substr($internalRoute,1);    
                $segments = explode("/", $internalRoute);
                
                $controllerName = ucfirst(array_shift($segments)).'Controller';
                $actionName = 'action'.ucfirst(array_shift($segments));
                $parameters = $segments;
                $controllerFile = ROOT.'/controllers/'.
                $controllerName.'.php';
                    if(file_exists($controllerFile)){
                        include_once($controllerFile);
                    }
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject,$actionName),$parameters);
                    if($result!=NULL){
                        break;
                    }
            }
            
        }
    }
}