<?php
include_once("../session.php");
?>
<html lang="en" class=""><head>

    <meta charset="UTF-8">
    <title>Přidání události</title>
  
    <meta name="robots" content="noindex">
  
  
    
    
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,700">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/events/search.js"></script>
  <link rel="stylesheet" href="../css/events/addEventForm.css">
    
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-7549a40147ccd0ba0a6b5373d87e770e49bb4689f1c2dc30cccc7463f207f997.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-4793b73c6332f7f14a9b6bba5d5e62748e9d1bd0b5c52d7af6376f3d1c625d7e.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js"></script>
  <style>.mM{display:block;border-radius:50%;box-shadow:0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);position:fixed;bottom:1em;right:1em;-webkit-transform-origin:50% 50%;transform-origin:50% 50%;-webkit-transition:all 240ms ease-in-out;transition:all 240ms ease-in-out;z-index:9999;opacity:0.75}.mM svg{display:block}.mM:hover{opacity:1;-webkit-transform:scale(1.125);transform:scale(1.125)}</style></head>
  
  <body>
    <form action="addEvent.php" method="POST" class="form">
        
        <label class="label required" for="">Přidání Události</label>
        <p class="field required"></p>
    <p class="field required ">
        
      <label class="label required" for="name">Název</label>
      <input class="text-input" name="name" required="" type="text" value="">
    </p>
    
    <p class="field">
        <label class="label" for="description">Popis</label>
        <textarea class="textarea" cols="50" name="description" rows="4"></textarea>
      </p>

      <div class="field half">
        <label class="label">Začátek Události</label>
        <input class="text-input" name="time_start" type="datetime-local">
      </div>

      <div class="field half">
        
      </div>

    <p class="field half required">
      <label class="label" for="password">Firma</label>
      <input class=" text-input" placeholder="Vyhledávaní" id="search-bt" type="text" value="">
      <select class="firms firmy-s" multiple>
      <?php
                include_once("../conn.php");
                $sql = "SELECT id,name FROM firm order by name";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
                    <?php
                }
                } else {
                    ?>

                    <option value="0"> Žádne firmy</option>
                    <?php
                }
                ?>
  </select>
  </p>
  <p class="field half">
  <label class="label" for="password">Firmy v události</label>
    <select class="firms-in-event firmy-s" multiple>
    </select>
  </p>
    <p class="field half">
    <button class="button" id="add-btn">Přidat</button>
  </p>
  <p class="field half">
    <button class="button" id="remove-btn">Odebrat</button>
  </p>
    
    <p class="field ">
      <input class="button" id="submit" type="submit" value="Vytvořit">
    </p>
    <input type="hidden" class="hid-input" name="firms_in_event">
  </form>
  
    
  <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.customSelect/0.5.1/jquery.customSelect.min.js"></script>
    <script src="https://cdpn.io/cpe/boomboom/pen.js?key=pen.js-b03f86d6-2f3e-cc9b-ec5e-0c681121e029" crossorigin=""></script><a href="https://codepen.io/mican/" target="_blank" class="mM"><svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><title>codepen-logo</title><path d="M16 32C7.163 32 0 24.837 0 16S7.163 0 16 0s16 7.163 16 16-7.163 16-16 16zM7.139 21.651l1.35-1.35a.387.387 0 0 0 0-.54l-3.49-3.49a.387.387 0 0 0-.54 0l-1.35 1.35a.39.39 0 0 0 0 .54l3.49 3.49a.38.38 0 0 0 .54 0zm6.922.153l2.544-2.543a.722.722 0 0 0 0-1.018l-6.582-6.58a.722.722 0 0 0-1.018 0l-2.543 2.544a.719.719 0 0 0 0 1.018l6.58 6.579c.281.28.737.28 1.019 0zm14.779-5.85l-7.786-7.79a.554.554 0 0 0-.788 0l-5.235 5.23a.558.558 0 0 0 0 .789l7.79 7.789c.216.216.568.216.785 0l5.236-5.236a.566.566 0 0 0 0-.786l-.002.003zm-3.89 2.806a.813.813 0 1 1 0-1.626.813.813 0 0 1 0 1.626z" fill="#FFF" fill-rule="evenodd"></path></svg></a>
  
  
  </body></html>
  