<?php

### Konfiguration ###

# Bitte passen Sie die folgenden Werte an, bevor Sie das Script benutzen!

# An welche Adresse sollen die Mails gesendet werden?
$strEmpfaenger = 'info@ralfhage.de';

# Welche Adresse soll als Absender angegeben werden?
# (Manche Hoster lassen diese Angabe vor dem Versenden der Mail ueberschreiben)
$strFrom       = '"Formmailer" <info@ralfhage.de>';

# Welchen Betreff sollen die Mails erhalten?
$strSubject    = 'Feedback';

# Zu welcher Seite soll als "Danke-Seite" weitergeleitet werden?
# Wichtig: Sie muessen hier eine gueltige HTTP-Adresse angeben!
 $strReturnhtml = 'danke.html';

# Welche(s) Zeichen soll(en) zwischen dem Feldnamen und dem angegebenen Wert stehen?
$strDelimiter  = ":\t";

### Ende Konfiguration ###

if($_POST)
{
 $strMailtext = "";

 while(list($strName,$value) = each($_POST))
 {
  if(is_array($value))
  {
   foreach($value as $value_array)
   {
    $strMailtext .= $strName.$strDelimiter.$value_array."\n";
   }
  }
  else
  {
   $strMailtext .= $strName.$strDelimiter.$value."\n";
  }
 }

 if(get_magic_quotes_gpc())
 {
  $strMailtext = stripslashes($strMailtext);
 }

 mail($strEmpfaenger, $strSubject, $strMailtext, "From: ".$strFrom)
  or die("Die Mail konnte nicht versendet werden.");
 header("Location: $strReturnhtml");
 exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
    <head>
        <title>Einfacher PHP-Formmailer</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
    <div id="header">
                         <div id="header-kontakt"><a href="https://www.facebook.com" target="_blank" alt="Facebook"><img src="images/facebook.png" alt="Mein Facebook-Kanal" width="30"></a> / <a class="header-kontakt" href="tel: 004917212345678">+49 172 12345678</a> / <a class="header-kontakt" href="mailto:mailadresse">E-Mail-Adresse</a></div>
                         <div id="weiss">
                                 <div id="navigation">
                                         <a class="navigation" href="index.html">Euer Name</a> /
                                         <a class="navigation" href="anschreiben.html">Anschreiben</a> /
                                         <a class="navigation" href="lebenslauf.html">Lebenlauf</a> /
                                         <a class="navigation" href="zeugnisse.html">Zeugnisse</a> /
                                         <a class="navigation" href="kontakt.html">Kontakt</a>
                                 </div>
                         </div>
                                 <div id="header-image"><h1 class="header-image">Kontakt</h1></div>
                 </div>

        
     <div id="inhalt">
                 Ich freue mich auf Ihre Nachricht und auf ein Bewerbungsgespr&auml;ch. Nutzen Sie mein Kontaktformular, um mich zu erreichen.
                 <br>
        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- Hier die eigentlichen Formularfelder eintragen. Die folgenden sind Beispielangaben. -->
        
            <dl>
                  <dt>Firma:*</dt>
                  <dd><input type="text" name="Firma"  placeholder="Firma eingeben" required /></dd>
                  
                  <dt>Vorname:*</dt>
                  <dd><input type="text" name="Vorname" placeholder="Vorname eingeben" required /></dd>
                 
                  <dt>Nachname:*</dt>
                  <dd><input type="text" name="Nachname"  placeholder="Nachnname eingeben" required></dd>
                 
                  <dt>E-Mail:*</dt>
                  <dd><input type="email" name="E-Mail"  placeholder="E-Mail-Adresse eingeben" required /></dd>
                   
                <dt>Telefon:</dt>
                <dd><input type="tel" name="Telefon"  placeholder="Telefonnummer eingeben" /></dd>
                
                <dt>Betreff:*</dt>
                <dd><input type="text" name="Betreff"  placeholder="Betreff eingeben" required /></dd>

                <dt>Datum:</dt>
                <dd><input type="date" name="Datum" min="2022-01-01" /></dd>
                
                <dt>Uhrzeit:</dt>
                <dd><input type="time" name="Uhrzeit" /></dd>
              
                <dt>Ihre Nachricht:</dt>
                <dd><textarea name="Ihre Nachricht" rows="4" cols="80"></textarea></dd>
              
                 </dl>
            <!-- Ende der Beispielangaben -->
            <p>
            <input type="submit" value="Senden" />
            <input type="reset" value="Zurücksetzen" />
            </p>
        </form>

</inhalt>
    </body>
</html>