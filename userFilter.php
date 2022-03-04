<?php
session_start();
$id=$_GET['id'];
$_SESSION['program_id']=$id;
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<?php
require 'config.php';
//$id=20;
// run query
$sql="SELECT name,id,type,preference FROM `program` where id=$id";
$result=mysqli_query($connection,$sql);
// set array
$pArray = array();
// look through query
while($row=mysqli_fetch_assoc($result)){
  // add each row returned into an array
  $pArray[] = $row;
}
//save an array for enrolled volunteers for a specific program
$sql3="SELECT enroll.Vemail_address, qualification.qualifications, volunteer.cumlativeRating,volunteer.first_name,volunteer.last_name,volunteer.phone_number,volunteer.gender, volunteer.numvolunteer FROM ((enroll INNER JOIN qualification ON enroll.Vemail_address = qualification.Vemail_address)INNER JOIN volunteer ON enroll.Vemail_address = volunteer.email_address) Where program_id=$id AND status='قيد الانتظار' ORDER BY volunteer.cumlativeRating DESC , volunteer.numvolunteer ASC";
$result3=mysqli_query($connection,$sql3);
// set array
$EArray = array();
// look through query
while($row=mysqli_fetch_assoc($result3)){
  // add each row returned into an array
  $EArray[] = $row;
//echo var_dump($EArray[0]);
}
/*$arrLength = count($pArray);
for ($i = 0; $i < $arrLength; $i++) {
  echo print_r($pArray[$i]['preferences']);    
}*/
//echo var_dump($pArray[0]);
 $sql4="select Vemail_address, group_concat(Preferences) AS Preferences from preference WHERE Vemail_address IN (SELECT Vemail_address FROM enroll WHERE program_id=$id) group by Vemail_address";
          $result4 = mysqli_query( $connection, $sql4);
  $arrLength = count($EArray);
  // output data of  row
  $preference = array();
  while($row = mysqli_fetch_assoc($result4)) {
    // $preference[] = $row;
     for ($i = 0; $i < $arrLength; $i++) {
  if($EArray[$i]['Vemail_address']===$row['Vemail_address']){
      array_push($EArray[$i],$row['Preferences']);
     // $EArray[$i]+= $row['Preferences'];
     //echo var_dump($EArray[0]);
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
//document.write(volunteers);
// Display the array elements
/*for(var i = 0; i < passedArray.length; i++){
    document.write(result);
}*/
result=checkPreferences(program,volunteers);
//document.write(result); //Just check it it return a true array
q=QuliFiltter(result,program);
//document.write(q);
//here I will arrange the array and send it back to PHP to print it
var finalArray=[];
for(var i = 0; i < q.length; i++){
//alert(i);
if(i == q.length-1){
finalArray.push(q[i]);
//document.write(finalArray);
//alert(finalArray);
//console.log(finalArray);
var arr=JSON.stringify(finalArray);
//console.log(JSON.stringify(finalArray));
var s="volenteerShowPrograms.php?finalArray="+arr;
window.location.href=s;
}
if(q[i][1]>=q[i + 1][1]){
finalArray.push(q[i]);
}
else{
var b = q[i +1];
finalArray.push(q[i + 1]);
q[i+1]=q[i];
q[i]=b;
}
}
function checkPreferences(program,volunteers){//check if preferences are match with program's preferences
    var text=program[0]['preference'].toString();
    //alert(volunteers[0]['Vemail_address']);
    var array1 = text.split(",");
     //alert(array1);
    var count=0;
    var newArray=[];
    for(var i = 0; i < volunteers.length; i++){
        var pref=volunteers[i][0].toString();
        var array2 = pref.split(",");
       //alert(array2);
         for(var j = 0; j < array1.length; j++){
         var found = array2.includes(array1[j]);
         if(found){//if it is matched
            count++;
            }
        
        }
    if(count>0){//if only 1 is matched
    newArray.push([volunteers[i]['Vemail_address'],1,volunteers[i]['qualifications'],volunteers[i]['cumlativeRating'],volunteers[i]['numvolunteer'],volunteers[i]['first_name'],volunteers[i]['last_name'],volunteers[i]['gender']]);//I need to add rating 
    }
    count=0;//clear counter for next volunteer
    }
 //alert(newArray);
 return newArray;//return array of volunteer that their preferences matched
}

function QuliFiltter(array,program){
 /*var text=program[0]['type'].toString();
 var typeList = text.split(",");   */
 array1=array;       
 var Q = [
        {    			
        qualifications: ["تقنية معلومات","tag02","tag03"],
        tag: "هات يدك"
        },
        {
        qualifications: ["تربية خاصة","علم نفس","الخدمة الاجتماعية"],
        tag: "تاج الهمم"
        },
        {
        qualifications: ["tag02","tag04","tag06"],
        tag: "لنكن معهم"
        },
        {
        qualifications: ["علم نفس","خدمة اجتماعية"],
        tag: "الوحدة النفسية"
        },
        {
        qualifications: ["علم نفس","خدمة اجتماعية","تربية خاصة","رياض أطفال"],
        tag: "تاج تنمية انسان"
        },
        ]   
        
   
    var count=0;
    var counter=0;
    var newArray=[];
    for(var j = 0; j < Q.length; j++){
      if(program[0]['name']===Q[j]['tag']){
     // alert(Q[j]['tag']);
      counter++; 
      var x=j;
      }   
    }
    if(counter!==0){
    //alert("program");
    for(var i = 0; i < array.length; i++){
      //document.write(array[i][1]); 
        for(var j = 0; j < Q.length; j++){
           var found = Q[x]['qualifications'].includes(array[i][2]);
           if(found){//if it is matched
            count++;
            //alert(array[i][2]);
          
           }
        
        }
    if(count>0){//if only 1 is matched
   // alert(array[i][0]+count);
    array[i][1]+=1;
    }
    count=0;//clear counter for next volunteer
   
    }
    }
    else{
    //alert("matched");
    for(var i = 0; i < array.length; i++){
    array[i][1]+=1;  
    }   
    }
    
 return array;//return array of volunteer that their preferences matched
}//end of the method
    
</script>


