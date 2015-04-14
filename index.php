<?php
  header("Content-type:text/html;charset=utf-8");
  $base_url = "http://www.webxml.com.cn/WebServices/WeatherWebService.asmx?wsdl";
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
            $client = new SoapClient($base_url);
            try {
                $parameter = array("theCityName"=>$_REQUEST['theCityName']);
                $funcs = $client->__getFunctions();
                var_dump($funcs);
                var_dump($parameter);
                $result = $client->getWeatherbyCityName($parameter);
                var_dump($result);
            } catch(SoapFault $e) {
                print "Sorry an error was caught executing your request: {$e->getMessage()}";
            }
        }
        ?>
    </div>
</body>
</html>
