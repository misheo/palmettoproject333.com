<?php
$xmlDoc=new DOMDocument();

try {
  require('connection.php');
  $sql = $db->query("SELECT * FROM menu");
  while($res = $sql->fetch(PDO::FETCH_ASSOC)){
    extract($res);
    $a[]=$name;
  }

} catch (PDOException $e) {
  echo $e->getMessage();
}


$q=$_GET["q"];

if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<count($a); $i++)
  {
  if (strtolower($q)==strtolower(substr($a[$i],0,strlen($q))))
    {
   	 if ($hint=="")
      	$hint = "<a href='menu.php#".$a[$i]."'>".$a[$i]."</a>";
    	else
     	 $hint=$hint." <br><a href='manu.php#".$a[$i]."'>".$a[$i]."</a> ";
    }
  }

}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="Dishes..";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>
