<?php
//多点乐资源
echo "<style type=\"text/css\">\n<!--\ndiv.special { margin: auto; width:95%; border:1px solid #000000; padding: 2px; }\ndiv.special table { width:100%; border:1px solid #000000; font-size:10px; border-collapse:collapse; }\n.topLeftRight     { border-top:1px solid #000; border-left:1px solid #000; border-right:1px solid #000;}\n.topLeftBottom    { border-top:1px solid #000; border-left:1px solid #000; border-bottom:1px solid #000; }\n.topLeft          { border-top:1px solid #000; border-left:1px solid #000; }\n.bottomLeft       { border-bottom:1px solid #000; border-left:1px solid #000; }\n.topRight         { border-top:1px solid #000; border-right:1px solid #000; }\n.bottomRight      { border-bottom:1px solid #000; border-right:1px solid #000; }\n.topRightBottom   { border-top:1px solid #000; border-bottom:1px solid #000; border-right:1px solid #000; }\n-->\n</style>\n<page style=\"font-size: 16px\" >\n    Vous pouvez choisir le format et l'orientation de votre document, en utilisant ceci :<br>\n    <br>\n    &lt;page orientation=\"portrait\" format=\"A5\" &gt; <i>A5 en portrait</i> &lt;/page&gt; <br>\n    <br>\n    &lt;page orientation=\"paysage\" format=\"100x200\" &gt; <i>100mm x 200mm en paysage</i> &lt;/page&gt;<br>\n    <br>\n    En voici un petit exemple !\n</page>\n<page orientation=\"paysage\" style=\"font-size: 18px\">\n    Ceci est une page en paysage<br>\n    <table style=\"width: 100%; border: solid 1px #FFFFFF;\">\n        <tr>\n            <td style=\"width: 30%; border: solid 1px #FF0000;\">AAA</td>\n            <td style=\"width: 40%; border: solid 1px #00FF00;\">BBB</td>\n            <td style=\"width: 30%; border: solid 1px #0000FF;\">CCC</td>\n        </tr>\n        <tr>\n            <td style=\"width: 30%; border: solid 1px #FF0000;\">AAA</td>\n            <td style=\"width: 40%; border: solid 1px #00FF00;\">BBB</td>\n            <td style=\"width: 30%; border: solid 1px #0000FF;\">CCC</td>\n        </tr>\n        <tr>\n            <td style=\"width: 30%; border: solid 1px #FF0000;\">AAA</td>\n            <td style=\"width: 40%; border: solid 1px #00FF00;\">BBB</td>\n            <td style=\"width: 30%; border: solid 1px #0000FF;\">CCC</td>\n        </tr>\n    </table>\n    <div style=\"width: 70%; border: solid 1mm #770000; margin: 1mm; padding: 2mm; font-size: 4mm; line-height: normal; text-align: justify\">\n        <img src=\"./res/logo.gif\" alt=\"logo html2pdf\" style=\"float: left; width: 60mm; margin: 2mm;\">\n        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum, nibh eu ultricies scelerisque, est lorem dignissim elit, quis tempus tortor eros non ipsum. Mauris convallis augue ac sapien. In scelerisque dignissim elit. Donec consequat semper lectus. Sed in quam. Nunc molestie hendrerit ipsum. Curabitur elit risus, rhoncus ut, mattis a, convallis eu, neque. Morbi luctus est sit amet nunc. In nisl. Donec magna libero, aliquet eu, vestibulum ut, mollis sed, felis.\n        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum, nibh eu ultricies scelerisque, est lorem dignissim elit, quis tempus tortor eros non ipsum. Mauris convallis augue ac sapien. In scelerisque dignissim elit. Donec consequat semper lectus. Sed in quam. Nunc molestie hendrerit ipsum. Curabitur elit risus, rhoncus ut, mattis a, convallis eu, neque. Morbi luctus est sit amet nunc. In nisl. Donec magna libero, aliquet eu, vestibulum ut, mollis sed, felis.\n    </div>\n    <div style=\"width: 70%; border: solid 1mm #770000; margin: 1mm; padding: 2mm; font-size: 4mm; line-height: 150%;text-align: right;\">\n        <img src=\"./res/logo.gif\" alt=\"logo html2pdf\" style=\"float: right; width: 60mm; margin: 2mm; \">\n        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum, nibh eu ultricies scelerisque, est lorem dignissim elit, quis tempus tortor eros non ipsum. Mauris convallis augue ac sapien. In scelerisque dignissim elit. Donec consequat semper lectus. Sed in quam. Nunc molestie hendrerit ipsum. Curabitur elit risus, rhoncus ut, mattis a, convallis eu, neque. Morbi luctus est sit amet nunc. In nisl. Donec magna libero, aliquet eu, vestibulum ut, mollis sed, felis.\n    </div>\n    <fieldset style=\"width: 70%; border: solid 1mm #770000; margin: 1mm; padding: 2mm; padding-top: 0mm; font-size: 4mm; line-height: normal; background: #FFFFFF;\">\n        <legend style=\" background: #FFFFFF; padding: 1; border: solid 1px #440000;\">Ceci est un exemple de fieldset</legend>\n        <img src=\"./res/logo.gif\" alt=\"logo html2pdf\" style=\"float: left; width: 60mm; margin: 2mm; \">\n        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum, nibh eu ultricies scelerisque, est lorem dignissim elit, quis tempus tortor eros non ipsum. Mauris convallis augue ac sapien. In scelerisque dignissim elit. Donec consequat semper lectus. Sed in quam. Nunc molestie hendrerit ipsum. Curabitur elit risus, rhoncus ut, mattis a, convallis eu, neque. Morbi luctus est sit amet nunc. In nisl. Donec magna libero, aliquet eu, vestibulum ut, mollis sed, felis.\n        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum, nibh eu ultricies scelerisque, est lorem dignissim elit, quis tempus tortor eros non ipsum. Mauris convallis augue ac sapien. In scelerisque dignissim elit. Donec consequat semper lectus. Sed in quam. Nunc molestie hendrerit ipsum. Curabitur elit risus, rhoncus ut, mattis a, convallis eu, neque. Morbi luctus est sit amet nunc. In nisl. Donec magna libero, aliquet eu, vestibulum ut, mollis sed, felis.\n    </fieldset>\n</page>\n<page orientation=\"portrait\" format=\"150x200\" style=\"font-size: 18px\">\n    Ceci est une page en portrait de 150mm x 200mm<br>\n    <table style=\"width: 100%; border: solid 1px #FFFFFF;\">\n        <tr>\n            <td style=\"width: 30%; border: solid 1px #FF0000;\">AAA</td>\n            <td style=\"width: 40%; border: solid 1px #00FF00;\">BBB</td>\n            <td style=\"width: 30%; border: solid 1px #0000FF;\">CCC</td>\n        </tr>\n        <tr>\n            <td style=\"width: 30%; border: solid 1px #FF0000;\">AAA</td>\n            <td style=\"width: 40%; border: solid 1px #00FF00;\">BBB</td>\n            <td style=\"width: 30%; border: solid 1px #0000FF;\">CCC</td>\n        </tr>\n        <tr>\n            <td style=\"width: 30%; border: solid 1px #FF0000;\">AAA</td>\n            <td style=\"width: 40%; border: solid 1px #00FF00;\">BBB</td>\n            <td style=\"width: 30%; border: solid 1px #0000FF;\">CCC</td>\n        </tr>\n    </table>\n    <br>\n    <div class=\"special\">\n        <table>\n            <tr>\n                <td colspan=\"2\" class=\"topLeftRight\" style=\"width: 100%; text-align:left;border-bottom:1px dashed #000000\">blabla blabla</td>\n            </tr>\n            <tr>\n                <td class=\"bottomLeft\" style=\"width:70%;border-right:1px dashed #000000;text-align:left;\">blabla blabla</td>\n                <td class=\"bottomRight\" style=\"width: 30%; text-align:left;vertical-align:top;\">Date :<br /> Signature :</td>\n            </tr>\n        </table>\n    </div>\n</page>";

?>
