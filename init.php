<?php
require "db.php";
class operation extends Database1{

    public function selectall($tablename){
        $con=$this->connect();
        $str="select * from ".$tablename;
        $r=mysqli_query($con,$str);
        mysqli_close($con);
        return $r;
        
    }
    public function select_with_join($select,$table1,$join,$table2,$condition){
        $con=$this->connect();
        $temp=implode(",",$select);
        $str="select $temp from $table1 $join $table2 on $condition;";
        $r=mysqli_query($con,$str);
        mysqli_close($con);
        return $r;
        
    }
    public function select_with_join_condition($columns,$table1,$join,$table2,$condition,$where){
        $con=$this->connect();
        if(is_array($columns))$columns=implode(",",$columns);
        $str="select $columns from $table1 $join $table2 on $condition where $where;";
        $r= mysqli_query($con,$str);
        mysqli_close($con);
        return $r;
        
    }
    public function select_with_condition($columns,$tablename,$where){
        $con=$this->connect();
        if(is_array($columns))$columns=implode(",",$columns);
        $str="select $columns from $tablename where $where;";
        $r= mysqli_query($con,$str);
        mysqli_close($con);
        return $r;
        
    }
    public function update($tableName,$columns,$whereConditon){
        
        $con = $this->connect();
        if(is_array($columns))$columns=implode(",",$columns);
        $str= "UPDATE $tableName set $columns WHERE $whereConditon"; 
        $r= mysqli_query($con,$str);
        mysqli_close($con);
        return $r;
    } 
    
    public function insert($columns,$tableName,$val){
        
        $con = $this->connect();
        if(is_array($columns))$columns=implode(',',$columns);
        if(is_array($val))$val=implode(',',$val);
        $str="insert into $tableName ({$columns}) values ({$val});";
        // echo $str;
        $r= mysqli_query($con,$str) or die("$");
        mysqli_close($con);
        return $r;
    }
    public function delete($tableName,$whereConditon)
    {
        $con = $this->connect();
        $sql = "DELETE from $tableName WHERE $whereConditon";
        $r= mysqli_query($con,$sql);
        mysqli_close($con);
        return $r;
    }
    
}
?>