<?php
  $base_url = "http://www.webxml.com.cn/WebServices/WeatherWebService.asmx/getWeatherbyCityName";
  # has the data
  $hasName = false;
  if(isset($_REQUEST['theCityName'])){
     $hasName = true;
  }
?>
<html>
<head>
    <title>Simple Weather</title>
</head>
<body>
    <!-- action is self -->
    <form action="index.php" method="post">
        <input type="text" name="theCityName" value=<?php if($hasName)echo $_REQUEST['theCityName'];
        else echo "";
        ?>>
        <input type="submit" value="submit">
    </form>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: Maybe霏
 * Date: 2015/4/13
 * Time: 19:42
 */

?>