<?php
session_start();
$ind=$_GET['ind'];
     //echo($ind);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
     if($ind==1){
?>
    <input type="button" name="twocity" value="未來兩天天氣" onclick="location.href='weather.php?ind=2'">
    <input type="button" name="weekcity" value="一週天氣" onclick="location.href='weather.php?ind=3'">
    <input type="button" name="nowcity" value="重新選擇縣市" onclick="location.href='index.php'"><br>
<?php
     if(isset($_SESSION['city'])){
        $handle = fopen("https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-C0032-001?Authorization=CWB-57C07FAB-F956-4AF9-8639-492D280DA675","rb");
        $content = "";
        while (!feof($handle)) {
            $content .= fread($handle, 10000);
        }
        fclose($handle);
        $content = json_decode($content,false);
        foreach($content->records->location as $i){
            if($i->locationName==$_SESSION['city']){
                //var_dump($i);
                echo $i->locationName."<br>";
                echo ($i->weatherElement[0]->time[0]->startTime)."~".($i->weatherElement[0]->time[0]->endTime)."<br>";
                echo ($i->weatherElement[0]->elementName)."：".($i->weatherElement[0]->time[0]->parameter->parameterName)."<br>";
                echo ($i->weatherElement[1]->elementName)."：",($i->weatherElement[1]->time[0]->parameter->parameterName).($i->weatherElement[1]->time[0]->parameter->parameterUnit)."<br>";
                echo ($i->weatherElement[2]->elementName)."：",($i->weatherElement[2]->time[0]->parameter->parameterName).($i->weatherElement[2]->time[0]->parameter->parameterUnit)."<br>";
                echo ($i->weatherElement[4]->elementName)."：",($i->weatherElement[4]->time[0]->parameter->parameterName).($i->weatherElement[4]->time[0]->parameter->parameterUnit)."<br>";
                echo ($i->weatherElement[3]->elementName)."：",($i->weatherElement[3]->time[0]->parameter->parameterName)."<br>";

                
                //." ".($i->weatherElement[0]->elementName->time[0]->parameter->parameterName).($i->weatherElement[0]->elementName->time[0]->parameter->parameterUnit);
                // foreach($i['weatherElement'] as $locate2)
                //     foreach($locate2['time'] as $locate3){
                //         echo $locate3['startTime'];
                //         echo $locate3['endTime'];
                        //
                //echo $locate2['endTime']."<br>";
        
            }
         }
        }
    }
     if($ind==2){
?>
        <input type="button" name="nowcity" value="現在天氣" onclick="location.href='weather.php?ind=1'">
        <input type="button" name="weekcity" value="一週天氣" onclick="location.href='weather.php?ind=3'">
        <input type="button" name="nowcity" value="重新選擇縣市" onclick="location.href='index.php'"><br>
<?php
     if(isset($_SESSION['city'])){
        $handle = fopen("https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-089?Authorization=CWB-57C07FAB-F956-4AF9-8639-492D280DA675","rb");
        $content = "";
        while (!feof($handle)) {
            $content .= fread($handle, 10000);
        }
        fclose($handle);
        $content = json_decode($content,false);
        //var_dump($content);
        foreach($content->records->locations[0]->location as $i){
            if($i->locationName==$_SESSION['city']){
                //var_dump($i);
                echo $i->locationName."<br>";
                // echo ($i->weatherElement[0]->time[0]->startTime)."~".($i->weatherElement[0]->time[0]->endTime);
                // echo ($i->weatherElement[0]->elementName)."(".($i->weatherElement[0]->description).")";
                // foreach($i['weatherElement'] as $locate2)
                //     foreach($locate2['time'] as $locate3){
                //         echo $locate3['startTime'];
                //         echo $locate3['endTime'];
                        //
                //echo $locate2['endTime']."<br>";
        
            }
         }
        }
    }
    ?>
</body>
</html>
