<?php
session_start();
$_SESSION["city"]=$_POST["city"];
//echo $_SESSION["city"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php if(!isset($_POST['city'])){ ?>
<form method="POST" action="index.php">        
<select id="city" name="city" size="1">
        <option>請選擇你的縣市</option>
        <?php
            $handle = fopen("https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-C0032-001?Authorization=CWB-57C07FAB-F956-4AF9-8639-492D280DA675","rb");
            $content = "";
            while (!feof($handle)) {
                $content .= fread($handle, 10000);
            }
            fclose($handle);
            $content = json_decode($content,false);
            foreach($content->records->location as $locate)
            {
        ?>
        <option value="<?=$locate->locationName?>"><?=$locate->locationName;}?></option>
    </select>
    <input type="submit" name="nowcity" value="確認" onclick="location.href='index.php'">
    <?php }else{?>
    <input type="button" name="nowcity" value="現在天氣" onclick="location.href='weather.php?ind=1'">
    <input type="button" name="twocity" value="未來兩天天氣" onclick="location.href='weather.php?ind=2'">
    <input type="button" name="weekcity" value="一週天氣" onclick="location.href='weather.php?ind=3'"><br>
    
    <?php }?>

</body>
</html>