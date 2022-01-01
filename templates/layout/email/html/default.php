<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $this->fetch('title') ?></title>
    <style type="text/css">
    /* Take care of image borders and formatting */

    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important; }
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass {width:100%;}
    .backgroundTable {margin:0 auto; padding:0; width:100% !important;}
    table td {border-collapse: collapse;}
    .ExternalClass * {line-height: 115%;}


    /* General styling */

    td {
      font-family: Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #6f6f6f;
      font-weight: 400;
      font-size: 18px;
    }


    h1 {
      margin: 10px 0;
    }

    a {
      color: #27aa90;
      text-decoration: none;
    }


    .body-padding {
      padding: 0 75px;
    }


    .force-full-width {
      width: 100% !important;
    }


    </style>

    <style type="text/css" media="screen">
        @media screen {
          @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,900);
          /* Thanks Outlook 2013! */
          * {
            font-family: 'Source Sans Pro', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
          }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 599px)">
      /* Mobile styles */
      @media only screen and (max-width: 599px) {

        table[class*="w320"] {
          width: 320px !important;
        }

        td[class*="w320"] {
          width: 280px !important;
          padding-left: 20px !important;
          padding-right: 20px !important;
        }

        img[class*="w320"] {
          width: 250px !important;
          height: 67px !important;
        }

        td[class*="mobile-spacing"] {
          padding-top: 10px !important;
          padding-bottom: 10px !important;
        }

        *[class*="mobile-hide"] {
          display: none !important;
          width: 0 !important;
        }

        *[class*="mobile-br"] {
          font-size: 12px !important;
        }

        td[class*="mobile-center"] {
          text-align: center !important;
        }

        table[class*="columns"] {
          width: 100% !important;
        }

        td[class*="column-padding"] {
          padding: 0 50px !important;
        }

      }
    </style>
</head>
<body  offset="0" class="body" style="padding:0; margin:0; display:block; background:#eeebeb; -webkit-text-size-adjust:none" bgcolor="#eeebeb">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
      <td align="center" valign="top" style="background-color:#ffffff" width="100%">

      <center>

        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td align="center" valign="top">


            <table style="margin:0 auto;" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td style="text-align: center;">
                  <a href="https://www.accordance.co.in"><img class="w320" width="311" height="60" src="<?= $this->Url->assetUrl('/img/Accordance_logo.png') ?>" alt="Accordance logo" ></a>
                </td>
              </tr>
            </table>

            <?= $this->fetch('content') ?>
            <!-- Footer -->
            <table cellspacing="0" cellpadding="0" bgcolor="#363636"  class="force-full-width">
              <tr>
                <td style="color:#f0f0f0; font-size: 14px; text-align:center; padding-bottom:4px;padding-top: 10px;">
                  © <?= date('Y') ?> All Rights Reserved
                </td>
              </tr>
              <tr>
                <td style="color:#27aa90; font-size: 14px; text-align:center;">
                  <a href="#">Unsubscribe</a>
                </td>
              </tr>
              <tr>
                <td style="width:96%; margin: 0 auto; padding:18px;height:30px; color:#949494; font-size:12px; font-family: Arial, Helvetica, sans-serif;  font-weight:bold; vertical-align:middle;text-align: center;" >
                <p>This is a computer auto generated message. Please do not reply to this message.</p>
                </td>
              </tr>
              <tr>
                <td style="font-size:12px;">
                  &nbsp;
                </td>
              </tr>
            </table>
            </td>
          </tr>
        </table>
      </center>
      </td>
    </tr>
  </table>
</body>
</html>
