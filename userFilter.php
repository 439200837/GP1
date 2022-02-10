<?php
require 'config.php';
$id=20;
// run query
$sql="SELECT name,id,type,preferences FROM `program` where id=$id";
$result=mysqli_query($connection,$sql);
// set array
$pArray = array();
// look through query
while($row=mysqli_fetch_assoc($result)){
  // add each row returned into an array
  $pArray[] = $row;
}
//save an array for enrolled volunteers for a specific program
$sql3="SELECT enroll.Vemail_address, qualification.qualifications, volunteer.cumlativeRating, volunteer.numvolunteer FROM ((enroll INNER JOIN qualification ON enroll.Vemail_address = qualification.Vemail_address)INNER JOIN volunteer ON enroll.Vemail_address = volunteer.email_address) Where program_id=$id ORDER BY volunteer.cumlativeRating DESC , volunteer.numvolunteer ASC";
$result3=mysqli_query($connection,$sql3);
// set array
$EArray = array();
// look through query
while($row=mysqli_fetch_assoc($result3)){
  // add each row returned into an array
  $EArray[] = $row;
// echo var_dump($EArray[1]);
}
/*$arrLength = count($pArray);
for ($i = 0; $i < $arrLength; $i++) {
  echo print_r($pArray[$i]);    
}
//echo var_dump($pArray[0]);*/

$arrLength = count($EArray);
 $sql4="select Vemail_address, group_concat(Preferences) AS Preferences from preference WHERE Vemail_address IN (SELECT Vemail_address FROM enroll WHERE program_id=20) group by Vemail_address";
          $result4 = mysqli_query( $connection, $sql4);
  // output data of  row
  $preference = array(); 
  while($row = mysqli_fetch_assoc($result4)) {
    // $preference[] = $row;
     for ($i = 0; $i < $arrLength; $i++) {
  if($EArray[$i]['Vemail_address']===$row['Vemail_address']){
      array_push($EArray[$i],$row['Preferences']);
     // $EArray[$i]+= $row['Preferences'];
     //echo 'test';
  }  
  }}
/*$arrLength = count($EArray);
for ($i = 0; $i < $arrLength; $i++) {
 echo print_r($EArray[$i]).'<br>';    
}*/
 
?>

<script type="text/javascript">
  
// Access the array elements    
var program = <?php echo json_encode($pArray);?>;
var volunteers = <?php echo json_encode($EArray);?>;  
// Display the array elements
/*for(var i = 0; i < passedArray.length; i++){
    document.write(result);
}*/
result=checkPreferences(program,volunteers);
document.write(result); //Just check it it return a true array
ratingResult=ratingFiltter(result);
function checkPreferences(program,volunteers){//check if preferences are match with program's preferences
    var text=program[0]['preferences'].toString();
    var array1 = text.split(",");
     var count=0;
    var newArray=[];
    for(var i = 0; i < volunteers.length; i++){
        var pref=volunteers[i][0].toString();
        var array2 = pref.split(",");
         for(var j = 0; j < array1.length; j++){
         var found = array2.includes(array1[j]);
         if(found){//if it is matched
            count++;
            }
        
        }
    if(count>0){//if only 1 is matched
    newArray.push([volunteers[i]['Vemail_address'],count,volunteers[i]['qualifications'],volunteers[i]['cumlativeRating'],volunteers[i]['numvolunteer']]);//I need to add rating 
    }
    count=0;//clear counter for next volunteer
    }
 return newArray;//return array of volunteer that their preferences matched
}

function QuliFiltter(array,program){
 var text=program[0]['type'].toString();
 var typeList = text.split(",");   
 var Q = [
        {    			
        qualifications: ["tag01","tag02","tag03"],
        tag: "name01"
        },
        {
        qualifications: ["tag04","tag05","tag06"],
        tag: "name02"
        },
        {
        qualifications: ["tag02","tag04","tag06"],
        tag: "name03"
        },
        {
        qualifications: ["tag01","tag03","tag05"],
        tag: "name04"
        },
        ]   
        
   
    var count=0;
    var newArray=[];
    for(var i = 0; i < array.length; i++){
        var qulification=array[i][4];
        for(var j = 0; j < typeList.length; j++){
           var found = Q.includes(array[j]);
           if(found){//if it is matched
            count++;
           }
        
        }
    if(count>0){//if only 1 is matched
    newArray.push([volunteers[i]['Vemail_address'],count,volunteers[i]['qualifications'],volunteers[i]['cumlativeRating'],volunteers[i]['numvolunteer']]);//I need to add rating 
    }
    count=0;//clear counter for next volunteer
    }
 return newArray;//return array of volunteer that their preferences matched
}//end of the method
    




</script>

