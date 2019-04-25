<?php

class Email_Template {

	public function getForgotPasswordHtml($name, $email, $link)
	{
		$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
					<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					        
					        <meta name="viewport" content="width=device-width, initial-scale=1">
					        <meta http-equiv="X-UA-Compatible" content="IE=edge">
					        <meta name="format-detection" content="telephone=no">
					        <title>Ecoaching.guru: Reset Your Password</title>

					        <!-- Client specific styles - DO NOT REMOVE -->
					        <style type="text/css">
					            body {
					                margin: 0;
					                padding: 0;
					                -ms-text-size-adjust: 100%;
					                -webkit-text-size-adjust: 100%;
					            }

					            table {
					                border-spacing: 0;
					            }

					            table td {
					                border-collapse: collapse;
					            }

					            .appleLinks a {
					                color:#b4b4b4;
					                text-decoration: none;
					            }

					            .backgroundTable {
					                margin:0 auto;
					                padding:0;
					                width:100%;!important;
					            }

					            .ExternalClass {
					                width: 100%;
					            }

					            .ExternalClass,
					            .ExternalClass p,
					            .ExternalClass span,
					            .ExternalClass font,
					            .ExternalClass td,
					            .ExternalClass div {
					                line-height: 100%;
					            }

					            .ReadMsgBody {
					                width: 100%;
					                background-color: #ebebeb;
					            }

					            table {
					                mso-table-lspace: 0pt;
					                mso-table-rspace: 0pt;
					            }

					            table td {
					                border-collapse: collapse;
					            }

					            img {
					                -ms-interpolation-mode: bicubic;
					            }

					            .yshortcuts a {
					                border-bottom: none !important;
					            }

					            @media screen and (max-width: 714px) {
					                .force-row,
					                .container,
					                .tweet-col,
					                .ecxtweet-col {
					                    width: 100% !important;
					                    max-width: 100% !important;
					                }

					                .container {
					                    padding-top: 0 !important;
					                    padding-bottom: 0 !important;
					                }
					            }
					            .ios-footer a {
					                color: #aaaaaa !important;
					                text-decoration: underline;
					            }
					        </style>

					    <body bgcolor="#eeeeee" style="margin:0; padding:0; -webkit-font-smoothing: antialiased; background-color: #eeeeee;" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

					        <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
					            <tbody><tr>
					                <td align="center" valign="top">

					                    <table bgcolor="#ffffff" border="0" width="650" cellpadding="0" cellspacing="0" class="container" style="width:650px; max-width:650px; background-color: #ffffff;">
					                        <tbody>

					                        <!--<tr>
					                            <td align="left" style="font-family:Arial, sans-serif;font-size:13px;">
					                                <table border="0" width="100%" bgcolor="#f5f5f5" cellpadding="0" cellspacing="0" style="width:100%;background-color:#f5f5f5">
					                                    <tbody>
					                                        <tr>
					                                            <td>
					                                                <a href="//testbook.com/" target="_blank">
					                                                    <img title="Ecoaching.guru" alt="Ecoaching.guru Logo" src="http://ecoaching.guru/assets/img/logo.png" width="80" height="80">
					                                                </a>
					                                            </td>
					                                        </tr>
					                                    </tbody>
					                                </table>
					                            </td>
					                        </tr>-->

					                        <tr>
					                            <td width="100%" border="0" style="padding-top:20px;padding-right:20px;padding-left:20px;background-color:#ffffff">
					                                <table border="0" width="100%" cellpadding="0" cellspacing="0">


					                                    <tbody>
					                                    <tr><td valign="top" width="100%" style="line-height: 30px; font-size: 0" height="30;">&nbsp;</td></tr>


					                                    <tr>
					                                        <td>
					                                            <p style="font-family:Arial, sans-serif; font-size:20px; color: #000000; margin-bottom: 10px; padding-bottom: 0;">Hi '.$name.',</p>
					                                        </td>
					                                    </tr>

					                                    <tr>
					                                        <td style="font-family: Arial, sans-serif; font-size: 16px; color: #545454; line-height: 20px;">
					                                            We have received a request to reset password for your account linked to email '.$email.'
					                                        </td>
					                                    </tr>

					                                    <tr>
					                                        <td>
					                                            <p style="font-family:Arial, sans-serif;font-size:16px; color: #9e9e9e; margin-top: 0; padding-top: 12px;">Please click below to reset your password.</p>
					                                        </td>
					                                    </tr>

					                                    <tr><td valign="top" width="100%" style="line-height: 20px; font-size: 0" height="30;">&nbsp;</td></tr>

					                                    <tr>
					                                        <td>
					                                            <a href="'.$link.'" style="font-family: Arial, sans-serif; font-size: 18px; color: #ffffff !important;text-decoration:none !important; line-height: 100%; padding-bottom: 12px; padding-right: 20px; padding-left: 20px; padding-top: 14px; border-radius: 2px; background-color: #4595e7;">
					                                                <font color="#fff">Reset Password</font>
					                                            </a>
					                                            <a href="'.$link.'" style="text-decoration: none;"></a>
					                                        </td>
					                                    </tr>

					                                    <tr><td valign="top" width="100%" style="line-height: 20px; font-size: 0" height="30;">&nbsp;</td></tr>

					                                    <tr>
					                                        <td>
					                                            <p style="color:#414042;margin:0;line-height:1.4;font-size:1em;padding-bottom:0.5em;border-top:1px solid #ddd;font-weight:bold;padding-top:1em">Need Support?</p>
					                                            <p style="color:#414042;margin:0;line-height:1.4;font-size:13px;padding-bottom:1em;border-bottom:1px solid #ddd">If you need any help or have any suggestion for us, please contact us at <a href="mailto:support@testbook.com" style="font-weight:bold;color:#414042;text-decoration:none" target="_blank">ecoachinguru@gmail.com</a></p>
					                                        </td>
					                                    </tr>

					                                    <tr><td valign="top" width="100%" style="line-height: 10px; font-size: 0" height="15;">&nbsp;</td></tr>

					                                    <tr>
					                                        <td>
					                                            <table style="border-collapse:collapse;width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
					                                                <tbody>
					                                                    <tr>
					                                                        <td>
					                                                            <p style="margin:0;color:#414042;font-size:0.9em;line-height:1.8">Regards,</p>
					                                                            <p style="margin:0;color:#414042;font-size:0.9em">Ecoaching.guru</p>
					                                                        </td>
					                                                        <td>
					                                                            <p style="margin:0;color:#1fbad6;font-size:0.8em;line-height:1.8;text-align:right">Follow us on</p>
					                                                            <p style="margin:0;color:#414042;font-size:0.9em;text-align:right">
					                                                                <a href="https://www.facebook.com/ecoaching.guru" style="text-decoration:none;display:inline-block;font-size:13px;line-height:1.25;font-weight:normal;color:#77889b;padding:0.2em" target="_blank">Facebook</a> |
					                                                                <a href="https://twitter.com/EcoachingGuru" style="text-decoration:none;display:inline-block;font-size:13px;line-height:1.25;font-weight:normal;color:#77889b;padding:0.2em" target="_blank">Twitter</a> |
					                                                                <a href="http://ecoaching.guru" style="text-decoration:none;display:inline-block;font-size:13px;line-height:1.25;font-weight:normal;color:#77889b;padding:0.2em" target="_blank">Website</a>
					                                                            </p>
					                                                        </td>
					                                                    </tr>
					                                                </tbody>
					                                            </table>
					                                        </td>
					                                  </tr>

					                                </tbody></table>
					                            </td>
					                        </tr>

					                        <tr><td valign="top" width="100%" style="line-height: 70px; font-size: 0" height="70;">&nbsp;</td></tr>

					                        <tr>
					                            <td align="left" style="font-family:Arial, sans-serif;font-size:13px;">
					                                <table border="0" width="100%" bgcolor="#f5f5f5" cellpadding="0" cellspacing="0" style="width:100%;background-color:#f5f5f5">
					                                    <tbody><tr>
					                                        <td valign="top" style="padding-left:30px;padding-right:30px;padding-bottom:30px;padding-top:30px;font-family:Arial,sans-serif;font-size:13px;text-align:center">
					                                            <span style="color: #848484 !important;text-decoration:none !important"><font color="#848484">Copright © 2017 Ecoaching.guru, All rights reserved.</font></span>
					                                        </td>
					                                    </tr>
					                                </tbody></table>
					                            </td>
					                        </tr>
					                    </tbody></table>
					                </td>
					            </tr>
					        </tbody></table></body><div id="filter" style="opacity: 0; display: block;"></div></html>';
		return $html;
	}
}
?>