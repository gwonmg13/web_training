<!DOCTYPE html>
<html>
   <head>
      <meta charset = "utf-8"/>
      <title>result of DB</title>
   </head>
   <body>
      <?php
         $DBname = $_POST["database"];
         $Query = $_POST["query"];
         $db_host = "localhost";
         $db_user = "root";
         $db_pw = "root";
      ?>
      <h1> input DB : <?= $DBname?></h1>
      <h1> input Query : <?= $Query?></h1>
      <?php
         try{
            $db = new PDO("mysql:host=localhost;dbname=$DBname",$db_user,$db_pw);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare($Query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
            for($i=0;$i<count($result);$i++){?>
                <ul><?=$result[$i]?></ul>
               <?php echo "<br/>";
            }
         }catch(Exception $e){
            echo$e->getMessage();
         }


      ?>
   </body>
</html>
