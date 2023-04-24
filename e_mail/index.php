<!DOCTYPE html>

<html lang="en">
  <head>

  <?php

    require_once("../session.php");
    require_once("../conn.php");

    $ids = $_GET["ids"];

    if (empty($ids)){
        header("Location: /table.php?mssg=Err, no ids in GET");
    }

    /**
     * Zpracování IDs
     */
    $ids = explode(";",$ids);

    if (count($ids) < 1){
      header("Location: /table.php?mssg=Err, nebyl vybrán e-mail");
    }
    /**
     * Není to ideální předání dat JS, ale viděl jsem i horší :))
     */

    ?>
      <script>
        var _data_array = [];
        const data = {name:'null', email:null}
    <?php

      for($x=0; $x<count($ids); $x ++){

        $mysql = "SELECT name,email FROM firm where id = ?";
        $stmt = $conn ->prepare($mysql);
        if($stmt === false){
            echo "err_db";
            die;
        }
        $stmt -> bind_param("i",$ids[$x]);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($name,$email);
        while ($stmt ->fetch())
        {
          echo "const data_".$ids[$x]." = {id:$ids[$x],name:'".$name."', email:'".$email."'};";
          echo "_data_array.push(data_".$ids[$x].");";
        }
      }

      
  ?>

  console.log(_data_array);
  </script>

  

  <meta charset="UTF-8">
  <title>Posílání hromadného e-mailu</title>

  <meta name="robots" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,700">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../css/forms.css">
  <script src="../js/table.js"></script>
  <script src="../js/e_mail/e_mail.js"></script>


  <style class="INLINE_PEN_STYLESHEET_ID">
    html {
  -webkit-font-smoothing: antialiased;
  }


  </style>

  
</head>
<body onload="onLoad()">

<div></div>

<div class="form">

<p class="field">
      <h2 class="label" style="font-size:45px">Hromadný e-mail</h2>
    </p>

  <p class="field required">
    <label class="label required" for="predmet">Příjemci</label>
    <div class="prijemci">
      <div class="prijemce" id="render_prijemci">
      
    </div>
  </div>
  <p class="field">
      <h2 class="label" style="font-size:30px"></h2>
    </p>
  <p class="field required">
    <label class="label required" for="prijemci">Přidat příjemce</label>
    <input class="text-input" id="pridat_prijemce" name="prijemci" required="" type="text" value="">
  </p>
</p>
<p class="field half">
    <input class="button" type="submit" value="Přídat" onclick="pridej()">
  </p>

  <p class="field required">
    <label class="label required" for="predmet">Předmět</label>
    <input class="text-input" id="predmet" name="predmet" required="" type="text" value="">
  </p>

  <p class="field required">
    <label class="label required" for="priloha">Příloha</label>
    <input class="text-input" id="priloha" name="img" required="" type="file" value="">
  </p>

  <p class="field required">
    <label class="label" for="about">Text</label>
    <textarea class="textarea required" cols="50" id="text" name="note" rows="4"></textarea>
  </p>
  <p class="field half">
    <input class="button" type="submit" value="Poslat" onclick="odesli()">
  </p>
</div>

  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.customSelect/0.5.1/jquery.customSelect.min.js"></script>


</body></html>
