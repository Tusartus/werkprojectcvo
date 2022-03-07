<?php  


class History{


    
    protected $id=null;
    protected $title;
    protected $description;
    

    static $dbTable = 'history';


    /*
    this functie zal automatisch een object opvullen met de nodige variabelen 
    */
    public function __construct($hiArray=[])
    {
        if(!empty($hiArray)){
            $this->setTitle($hiArray['title']);
            $this->setDescription($hiArray['description']);
         
        }
        
    }


    //getter setter 
    public function getId(){
         return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getTitle(){
        return $this->title;
   }
   public function setTitle($title){

       $this->title = $title;
   }


   public function getDescription(){
    return $this->description;
   }
    public function setDescription($description){
        $this-> description = $description;
    }

    //save  form 
    public function save()
    {
        //id is ingevuld dan update 
        if($this->id){
            $query = "UPDATE " .self::$dbTable . "SET title=:title, description=:description WHERE id=" . $this->id;    
        }else{
            //geen id , dan  insert
            $query = "INSERT INTO ". self::$dbTable . " (title, description ) VALUES (:title, :description)";
        }
  
        $db = new DB;
        $result = $db->doQuery($query, ['title'=>$this->title, 'description'=>$this->description] );
  
        if($result->rowCount()){
            if(!$this->id){
                $this->id = $db->lastInsertId();
            }
            return true;
        }
  
        return false;
  
  
    }





   
//get all (display)

static function getAll($options=[]){

    $query = "SELECT * FROM "  .self::$dbTable;
  
    if(isset($options['orderby'])){
         $query .= " ORDER BY " . $options['orderby'];
    }
  
    if(isset($options['limit'])){
      $query .= " LIMIT " . $options['limit'];
    }
  
    $db = new DB;
  
    $result = $db->doQuery($query);
  
    return $result->fetchAll(PDO::FETCH_CLASS, get_called_class());
  
  }


  
  //find  partner By id 
static function findById($id){
    $query = "SELECT * FROM " .self::$dbTable . " WHERE id=" . $id;

    $db = new DB;
    $result = $db->doQuery($query);
    
    return $result->fetchObject(get_called_class());
 
   
}

//delete 
public  function delete(){

    if($this->id){
         $query = "DELETE FROM " .self::$dbTable . " WHERE  id=" .$this->id;
         $db = new DB;
         $result = $db->doQuery($query);

         if($result->rowCount()){
             return true;
         }
        
    }


    return false;
}


  
    //validatie voor foutmelding in form html 
public function validate(){
    $formerrors = [];

    if(empty($this->getTitle)){
        $formerrors['title'] = 'Title is  required';
    }
    if(empty($this->getDescription)){
      $formerrors['description'] = ' Description field is  required';
    }

    return $formerrors;
    
}





















}
































?>

