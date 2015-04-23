<?php
    class product{

        private $id;

        public function __construct($nid){
            $this->id = $nid;
        }

        public function __set($name,$value){
            global $db;
            if ($this->id != NULL) {
                switch($name){
                    default :
                        $db->query("update product set ".$name."='".$db->real_escape_string($value)."' where (id='".$this->id."')");
                    break;
                }
            }
        }

        public function __get($name){
            global $db;
            if ($this->id != NULL) {
                switch($name){
                    case "id":
                        return $this->id;
                    break;
                    /*
                    case "property":
                        $q=$db->query("select property from product where (id='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
                    */
                    default:
                        $q=$db->query("select ".$name." from product where (id='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
                    break;
                }
            }else{
                return NULL;
            }
        }

        public static function create($param){
            global $db;
            $nid=newguid();
            $db->query("insert into product (col) values('".$db->real_escape_string($param)."')");
            return new user($nid);
        }

        public function delete(){
            global $db;
            $db->query("delete from product where id='".$this->id."'");
        }

    }
?>
