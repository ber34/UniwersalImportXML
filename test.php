<?php
?>
<form id="" method="post" action="test-post.php" enctype="multipart/form-data"><label>Wczytaj Plik Obcy:</label><br>
<input type="text" name="ZBIOR" placeholder="ZBIOR && PODZBIÃ“R" required="required" /><b style="color:red;">* ZbiÃ³r znacznikÃ³w podzielony &&</b><br>
<input type="text" name="MARKA" placeholder="MARKA" required="required" /><b style="color:red;">* TytuÅ‚</b><br>
<input type="text" name="MODEL" placeholder="MODEL" required="required" /><b style="color:red;">*</b><br>
<input type="text" name="CENA" placeholder="CENA" required="required" /><b style="color:red;">*</b><br>
<input type="text" name="CENA_NETTO" placeholder="CENA_NETTO"" /><br><input type="text" name="VAT" placeholder="VAT"" /><br>
<input type="text" name="URL_IMG" placeholder="URL_IMG" required="required" /><b style="color:red;">*</b><br>
<input type="text" name="URL_PROD" placeholder="URL_PROD"" /><br>
<input type="text" name="OPIS" placeholder="OPIS" required="required" /><b style="color:red;">*</b><br>
<input type="file" name="fileimportxml" accept="text/xml" placeholder="wczytaj plik" required="required" />
<input type="submit" id="" value="Zapisz >>" class="przycisk" /></form>
    <br><br><hr>
    <form method="post" action="test-post.php" enctype="multipart/form-data">
    <label>Wczytaj Plik:</label>
    <br><input type="file" name="filexml" accept="text/xml" placeholder="wczytaj plik" required="required" />
    <input type="submit" id="" value="Zapisz >>" class="przycisk" /></form>
