<?php
  header("Content-type:text/html;charset=utf-8");
  $base_url = "http://www.webxml.com.cn/WebServices/WeatherWebService.asmx?wsdl";
  # has the data
  $hasName = false;
  $weather_infor = array();
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
                $result = $client->getWeatherbyCityName($parameter);
                # result is a stdclass
                $value = get_object_vars($result);
                #var_dump($value);
                $infor = $value['getWeatherbyCityNameResult'];
                # infor is stdclass
                $infor_more = get_object_vars($infor);
                #var_dump($infor_more);
                $weather_infor = $infor_more['string'];
                # var_dump($weather_infor);
                # var_dump($result);
            } catch(SoapFault $e) {
                print "Sorry an error was caught executing your request: {$e->getMessage()}";
            }
        }
        ?>
    </div>
    <table>
        <thead>
         <td>date</td>
         <td>temperature</td>
         <td>wind</td>
        </thead>
        <tbody>
        <?php
        if($hasName)
        echo "<tr>
            <td>".$weather_infor['6']."</td>
            <td>".$weather_infor['5']."</td>
            <td>".$weather_infor['7']."</td>
        </tr>
        <tr>
            <td>".$weather_infor['13']."</td>
            <td>".$weather_infor['12']."</td>
            <td>".$weather_infor['14']."</td>
        </tr>
        <tr>
            <td>".$weather_infor['18']."</td>
            <td>".$weather_infor['17']."</td>
            <td>".$weather_infor['19']."</td>
        </tr>";
        ?>
        </tbody>
    </table>
</body>
</html>
