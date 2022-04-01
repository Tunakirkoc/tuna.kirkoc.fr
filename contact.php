<?php
//=======================================================================================================
// 
//=======================================================================================================

$nom = $_POST['nom'];
$email = $_POST['email'];
$texte = $_POST['texte'];

//=======================================================================================================
// Create new webhook in your Discord channel settings and copy&paste URL
//=======================================================================================================

$webhookurl = "";

//=======================================================================================================
// Compose message. You can use Markdown
// Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
//========================================================================================================

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([
  // Message
  // "content" => "Hello World! This is message line ;) And here is the mention, use userID <@12341234123412341>",

  // Username
  "username" => "Tuna Contact",

  // Avatar URL.
  // Uncoment to replace image set in webhook
  "avatar_url" => "https://raw.githubusercontent.com/Tunakirkoc/Tunakirkoc/main/PopCat.gif",

  // Text-to-speech
  "tts" => false,

  // File upload
  // "file" => "",

  // Embeds Array
  "embeds" => [
    [
      // Embed Title
      "title" => "Contact from $nom",

      // Embed Type
      "type" => "rich",

      // Embed Description
      "description" => "**$texte**",

      // URL of title link
      "url" => "https://tuna.kirkoc.fr/",

      // Timestamp of embed must be formatted as ISO8601
      "timestamp" => $timestamp,

      // Embed left border color in HEX
      "color" => hexdec("5865f2"),

      // Footer
      "footer" => [
        "text" => "tuna.kirkoc.fr",
        "icon_url" => "https://raw.githubusercontent.com/Tunakirkoc/Tunakirkoc/main/PopCat.gif"
      ],

      // Image to send
      // "image" => [
      //     "url" => "https://raw.githubusercontent.com/Tunakirkoc/Tunakirkoc/main/PopCat.gif"
      // ],

      // Thumbnail
      //"thumbnail" => [
      //    "url" => "https://raw.githubusercontent.com/Tunakirkoc/Tunakirkoc/main/PopCat.gif"
      //],

      // Author
      "author" => [
        "name" => "Tuna Kirkoc",
        "url" => "https://tuna.kirkoc.fr/"
      ],

      // Additional Fields array
      // "fields" => [
      //     // Field 1
      //     [
      //         "name" => "Field #1 Name",
      //         "value" => "Field #1 Value",
      //         "inline" => false
      //     ],
      //     // Field 2
      //     [
      //         "name" => "Field #2 Name",
      //         "value" => "Field #2 Value",
      //         "inline" => true
      //     ]
      //     // Etc..
      // ]
    ]
  ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


$ch = curl_init($webhookurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close($ch);

?>

<!--
  Credit for this part goes to Konstantinos Krevatas 
  https://codepen.io/kostas-krevatas/pen/VyXvqa
-->

<div style="text-align: center; font-family: 'Open Sans', sans-serif;">
  <br />
  <h1>Merci d'avoir pris contact avec moi </h1>
  <p>Vous serez redirigé dans <span id="seconds-holder"></span> secondes.<br /><br /> Si votre navigateur ne vous redirige pas automatiquement, cliquez sur <a href="" id="link">here</a>.
  </p>
</div>
<script>
  class countdownTimer {
  constructor(elementId, seconds, redirectUrl) {
    this._newUrl = redirectUrl;
    this._intvl = null;
    this._selector = elementId;
    this._seconds = seconds;

    document.getElementById("link").href = this._newUrl;
    this.start();
  }
  start() {
    var _this = this;
    _this.updateSecs();
    this._intvl = setInterval(function() {
      _this.updateSecs();
    }, 1000);
  }
  updateSecs() {
    document.getElementById(this._selector).innerHTML = this._seconds;
    this._seconds--;
    if (this._seconds == -1) {
      clearInterval(this._intvl);
      this.redirect();
    }
  }
  redirect() {
    document.location.href = this._newUrl;
  }
}

//And now invoke
var co = new countdownTimer("seconds-holder", 5, 'https://tuna.kirkoc.fr/');
</script>
