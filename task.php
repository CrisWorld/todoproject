<?php
     error_reporting(0);
    
     $countTask = 0;
     $totalTask = 0;
     $totalEst = 0;

     if(!isset($_POST['save'])){
         $title=$_POST['title'];
         $note=$_POST['note'];
         $est=$_POST['est'];
         if($est = null || $est = ''){
            $est = 1;
         }
         if($title!="" && $note!=""&&$est!="")
         {
             $arr_taskItem=[$title,$note,$est];
             $Task[] = $arr_taskItem;
            //  header("location:index.php");
         }
         else{
             echo"<script> alert('Vui lòng điền đầy đủ thông tin ')</script>";
         }
     }
     function countTask(){
            
     }
     function totalTask(){
        $totalTask = 0;
     }
     function totalEst(){
        for($i = 0; $i < sizeof($Task["est"]); $i++){
            $totalEst = $Task["est"] + $totalEst;
        }
        return $totalEst;
     }
     function caculateTime(){
            $caculateTime = time()
     }
?>
