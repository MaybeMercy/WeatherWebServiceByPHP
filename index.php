<?php
  header("Content-type:text/html;charset=utf-8");
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
    <div>
        <?php
        /**
         * Created by PhpStorm.
         * User: Maybe霏
         * Date: 2015/4/13
         * Time: 19:42
         */
        if($hasName){
            $fields=array(
                'theCityName'=>$_REQUEST['theCityName']
            );
            $ch=curl_init();
            curl_setopt($ch,CURLOPT_URL,$base_url);
            curl_setopt($ch,CURLOPT_POST,count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS,$fields);
            ob_start();
            curl_exec($ch);
            $result=ob_get_contents();
            ob_end_clean();
            echo $result;
            curl_close($ch);
        }
        ?>
    </div>
</body>
</html>
