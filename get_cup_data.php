
<?php


ini_set('display_errors',1);
error_reporting(E_ALL);
echo"in get_cup_data.php";

$str_json = file_get_contents('php://input');
//echo $str_json;
$filesize = filesize("Pipers_task_29-11-2021.cup");
echo $filesize;
$mydate = date('d-m-Y');
$mytaskwps = '"Pipers Field",';
$count = 0;

$response = json_decode($str_json, true); // decoding received JSON to array

 $fp = fopen('Pipers_task_'.$mydate.'.cup', 'w+');///// open csv file  ////////////////////////////////////////
fwrite($fp,"name,code,country,lat,lon,elev,style,rwdir,rwlen,freq,desc"."\n");///// header for cup file
fwrite($fp,'"Pipers Field",,,3322.718S,14931.075E,657m,1,,,,'."\n");

for ($i=0; $i < count($response) ; $i++) { 
	$mynum1 = $response[$i][0];
	$mynum2 = $response[$i][1];
	$mytaskwps = $mytaskwps.'"'.$response[$i][2].'",';

	fwrite($fp,'"'.$response[$i][2].'",,,'.$mynum1.'S,'.$mynum2.'E,'.$response[$i][3].',1,,,,'."\n");
	$count = $i;

}

fwrite($fp,'-----Related Tasks-----'."\n");

fwrite($fp,',"Pipers Field",'.$mytaskwps.'"Pipers Field"'."\n");
// fwrite($fp,'Options'."\n");
// fwrite($fp,'ObsZone=0,Style=0,R1=1000m,A1=180'."\n");

// for ($i=1; $i < $count+1 ; $i++) { 
// 	fwrite($fp,'ObsZone='.$i.',Style=1,R1=10000m,A1=45'."\n");

// }
// $count = $count + 1;
// fwrite($fp,'ObsZone='.$count.',Style=3,R1=1000m,A1=180'."\n");



fclose($fp);
?>
