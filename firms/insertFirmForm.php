<?php
include_once("../session.php");
?>
<html lang="en" class=""><head>

  <meta charset="UTF-8">
  <title>Přidání firmy</title>

  <meta name="robots" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,700">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="../css/firms/insertFirmForm.css">

<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-7549a40147ccd0ba0a6b5373d87e770e49bb4689f1c2dc30cccc7463f207f997.js"></script>
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-4793b73c6332f7f14a9b6bba5d5e62748e9d1bd0b5c52d7af6376f3d1c625d7e.js"></script>
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js"></script>
<style>.mM{display:block;border-radius:50%;box-shadow:0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);position:fixed;bottom:1em;right:1em;-webkit-transform-origin:50% 50%;transform-origin:50% 50%;-webkit-transition:all 240ms ease-in-out;transition:all 240ms ease-in-out;z-index:9999;opacity:0.75}.mM svg{display:block}.mM:hover{opacity:1;-webkit-transform:scale(1.125);transform:scale(1.125)}</style></head>

<body>
  <form action="insertFirm.php" method="POST" class="form">
    <p class="field">
      <h2 class="label" style="font-size:30px">Přidání firmy</h2>
    </p>
  <p class="field required">
    <label class="label required" for="name">Firma</label>
    <input class="text-input" id="name" name="name" required="" type="text" value="">
  </p>
  <p class="field half">
    <label class="label" for="surname">Kontaktní Osoba</label>
    <input class="text-input" name="surname" type="text">
  </p>
  <p class="field half">
    <label class="label" for="email">E-mail</label>
    <input class="text-input" name="email" type="email">
  </p>
  <p class="field half">
    <label class="label" for="phone">Telefon</label>
    <input class="text-input" name="phone" type="tel" value="">
  </p>
  <p class="field half">
    <label class="label" for="source">Zdroj</label>
    <input class="text-input" name="source" type="text">
  </p>
  <div class="field">
    <label class="label">Předmět</label>
    <select class="select" name="subject_id-">
      <?php
      include_once("../conn.php");
      
      $sql = "SELECT id, name FROM subject";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
         ?>
         <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
         <?php
        }
      }
      ?>
    </select>
  </div>

  <div class="field half">
    <label class="label">Datum 1. Kontaktu</label>
    <input class="text-input" name="date_of_contact" type="date">
  </div>

  <div class="field half">
    <label class="label">Datum 2. Kontaktu</label>
    <input class="text-input"name="date_of_2_contact" type="date">
  </div>

  <div class="field half">
    <label class="label">Datum Schůzky</label>
    <input class="text-input" name="date_of_meeting" type="date">
  </div>

  <div class="field half">
    <label class="label">Výsledek</label>
    <input class="text-input" name="result" type="text">
  </div>

  <div class="field half">
    <label class="label">Workshop</label>
    <input class="text-input" name="workshop" type="text">
  </div>

  <div class="field half">
    <label class="label">Brigáda</label>
    <input class="text-input" name="brigade" type="text">
  </div>

  <div class="field half">
    <label class="label">Praxe</label>
    <input class="text-input" name="practice" type="text">
  </div>
 <div class="field half">
    <label class="label">CV</label>
    <select class="select" name="cv-">
      <option value="1">ANO</option>
      <option value="0">NE</option>
    </select>
  </div>
  <p class="field">
    <label class="label" for="about">Poznámka</label>
    <textarea class="textarea" cols="50" id="about" name="note" rows="4"></textarea>
  </p>
<?php
$sql = "SELECT columns.name, columns.id, type_of_column.type from columns inner join type_of_column on columns.type = type_of_column.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    ?>
    <p class="field half">
    <label class="label"><?php echo $row["name"]; ?></label>
    <input class="text-input column" name="<?php echo "c".$row["id"]; ?>" type="<?php echo $row["type"]; ?>">
  </p>
    <?php
  }
}
?>
<p class="field half">
    
  </p>
<p class="field half">
    <input class="button" type="submit" value="Vytvořit">
  </p>
</form>

  
<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.customSelect/0.5.1/jquery.customSelect.min.js"></script>
  <script src="https://cdpn.io/cpe/boomboom/pen.js?key=pen.js-b03f86d6-2f3e-cc9b-ec5e-0c681121e029" crossorigin=""></script><a href="https://codepen.io/mican/" target="_blank" class="mM"><svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><title>codepen-logo</title><path d="M16 32C7.163 32 0 24.837 0 16S7.163 0 16 0s16 7.163 16 16-7.163 16-16 16zM7.139 21.651l1.35-1.35a.387.387 0 0 0 0-.54l-3.49-3.49a.387.387 0 0 0-.54 0l-1.35 1.35a.39.39 0 0 0 0 .54l3.49 3.49a.38.38 0 0 0 .54 0zm6.922.153l2.544-2.543a.722.722 0 0 0 0-1.018l-6.582-6.58a.722.722 0 0 0-1.018 0l-2.543 2.544a.719.719 0 0 0 0 1.018l6.58 6.579c.281.28.737.28 1.019 0zm14.779-5.85l-7.786-7.79a.554.554 0 0 0-.788 0l-5.235 5.23a.558.558 0 0 0 0 .789l7.79 7.789c.216.216.568.216.785 0l5.236-5.236a.566.566 0 0 0 0-.786l-.002.003zm-3.89 2.806a.813.813 0 1 1 0-1.626.813.813 0 0 1 0 1.626z" fill="#FFF" fill-rule="evenodd"></path></svg></a>


</body></html>
