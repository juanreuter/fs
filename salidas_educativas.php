<?php

//controlo acceso y auditoria

session_start();

if(!$_SESSION["log"]) header("location:index.php");

$usrmodi=$_SESSION["Usuario"];

$fecmodi=date("Y-m-d H:i:s");

$usralta=$_SESSION["Usuario"];

$fecalta=date("Y-m-d H:i:s");



//base de datos

include ("funciones/conexion_bbdd.php");

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head>

    <title>Turn plain webform into a powerful wizard with jQuery</title>

    <style type="text/css">

        body { font-family:Lucida Sans, Arial, Helvetica, Sans-Serif; font-size:13px; margin:20px;}

        #main { width:960px; margin: 0px auto; border:solid 1px #b2b3b5; -moz-border-radius:10px; padding:20px; background-color:#f6f6f6;}

        #header { text-align:center; border-bottom:solid 1px #b2b3b5; margin: 0 0 20px 0; }

        fieldset { border:none; width:320px;}

        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}

        label { display:block; margin:15px 0 5px;}

        input[type=text], input[type=password] { width:300px; padding:5px; border:solid 1px #000;}

        .prev, .next { background-color:#b0232a; padding:5px 10px; color:#fff; text-decoration:none;}

        .prev:hover, .next:hover { background-color:#000; text-decoration:none;}

        .prev { float:left;}

        .next { float:right;}

        #steps { list-style:none; width:100%; overflow:hidden; margin:0px; padding:0px;}

        #steps li {font-size:24px; float:left; padding:10px; color:#b0b1b3;}

        #steps li span {font-size:11px; display:block;}

        #steps li.current { color:#000;}

        #makeWizard { background-color:#b0232a; color:#fff; padding:5px 10px; text-decoration:none; font-size:18px;}

        #makeWizard:hover { background-color:#000;}

    </style>

    <script type="text/javascript" src="js/jquery.min.js"></script>

    <script type="text/javascript" src="javascripts/formToWizard.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){

            $("#SignupForm").formToWizard({ submitButton: 'SaveAccount' })

        });

    </script>

</head>

<body>

    <div id="main">

        <div id="header">

            <img src="logo.jpg" alt="JankoAtWrpSpeed demos" />

            <h3>Demo for <a href="http://www.jankoatwarpspeed.com/post/2009/09/28/webform-wizard-jquery.aspx">Turn any webform into a powerful wizard with jQuery</a></h3>

            <p><a id="makeWizard" href="#" onclick="MakeWizard()">Click here to turn this webform into a wizrd.</a>

            <span id="info" style="display:none;">You don't have to fill the form, really. Just click on Next and Back to see the demo.</span></p>

        </div>

        <form id="SignupForm" action="">

        <fieldset>

            <legend>Account information</legend>

            <label for="Name">Name</label>

            <input id="Name" type="text" />

            <label for="Email">Email</label>

            <input id="Email" type="text" />

            <label for="Password">Password</label>

            <input id="Password" type="password" />

        </fieldset>

        <fieldset>

            <legend>Company information</legend>

            <label for="CompanyName">Company Name</label>

            <input id="CompanyName" type="text" />

            <label for="Website">Website</label>

            <input id="Website" type="text" />

            <label for="CompanyEmail">CompanyEmail</label>

            <input id="CompanyEmail" type="text" />

        </fieldset>

        <fieldset>

            <legend>Billing information</legend>

            <label for="NameOnCard">Name on Card</label>

            <input id="NameOnCard" type="text" />

            <label for="CardNumber">Card Number</label>

            <input id="CardNumber" type="text" />

            <label for="CreditcardMonth">Expiration</label>

            <select id="CreditcardMonth">

                <option value="1">1</option>

                <option value="2">2</option>

                <option value="3">3</option>

                <option value="4">4</option>

                <option value="5">5</option>

                <option value="6">6</option>

                <option value="7">7</option>

                <option value="8">8</option>

                <option value="9">9</option>

                <option value="10">10</option>

                <option value="11">11</option>

                <option value="12">12</option>

            </select>

            <select id="CreditcardYear">

                <option value="2009">2009</option>

                <option value="2010">2010</option>

                <option value="2011">2011</option>

                <option value="2012">2012</option>

                <option value="2013">2013</option>

                <option value="2014">2014</option>

                <option value="2015">2015</option>

                <option value="2016">2016</option>

                <option value="2017">2017</option>

                <option value="2018">2018</option>

                <option value="2019">2019</option>
				
				<option value="2019">2020</option>
				
				<option value="2019">2021</option>

            </select>        

            <label for="Address1">Address 1</label>

            <input id="Address1" type="text" />

            <label for="Address2">Address 2</label>

            <input id="Address2" type="text" />

            <label for="City">City</label>

            <input id="City" type="text" />

            <label for="City">City</label>

            <select id="Country">

			    <option value="CA">Canada</option>

                <option value="US">United States of America</option>

                <option value="GB">United Kingdom (Great Britain)</option>

                <option value="AU">Australia</option>

                <option value="JP">Japan</option>

                <option value="AF">Afghanistan</option>

                <option value="AX">Aland Island</option>

                <option value="AL">Albania</option>

                <option value="DZ">Algeria</option>

                <option value="AS">American Samoa</option>

                <option value="AD">Andorra</option>

                <option value="AO">Angola</option>

                <option value="AI">Anguilla</option>

                <option value="AQ">Antarctica</option>

                <option value="AG">Antigua & Barbuda</option>

                <option value="AR">Argentina</option>

                <option value="AM">Armenia</option>

                <option value="AW">Aruba</option>

                <option value="AT">Austria</option>

                <option value="AZ">Azerbaijan</option>

                <option value="BS">Bahama</option>

                <option value="BH">Bahrain</option>

                <option value="BD">Bangladesh</option>

                <option value="BB">Barbados</option>

                <option value="BY">Belarus</option>

                <option value="BE">Belgium</option>

                <option value="BZ">Belize</option>

                <option value="BJ">Benin</option>

                <option value="BM">Bermuda</option>

                <option value="BT">Bhutan</option>

                <option value="BO">Bolivia</option>

                <option value="BA">Bosnia and Herzegovina</option>

                <option value="BW">Botswana</option>

                <option value="BV">Bouvet Island</option>

                <option value="BR">Brazil</option>

                <option value="IO">British Indian Ocean Territory</option>

                <option value="VG">British Virgin Islands</option>

                <option value="BN">Brunei Darussalam</option>

                <option value="BG">Bulgaria</option>

                <option value="BF">Burkina Faso</option>

                <option value="BI">Burundi</option>

                <option value="KH">Cambodia</option>

                <option value="CM">Cameroon</option>

                <option value="CV">Cape Verde</option>

                <option value="KY">Cayman Islands</option>

                <option value="CF">Central African Republic</option>

                <option value="TD">Chad</option>

                <option value="CL">Chile</option>

                <option value="CN">China</option>

                <option value="CX">Christmas Island</option>

                <option value="CC">Cocos (Keeling) Islands</option>

                <option value="CO">Colombia</option>

                <option value="KM">Comoros</option>

                <option value="CG">Congo</option>

                <option value="CK">Cook Iislands</option>

                <option value="CR">Costa Rica</option>

                <option value="HR">Croatia</option>

                <option value="CU">Cuba</option>

                <option value="CY">Cyprus</option>

                <option value="CZ">Czech Republic</option>

                <option value="CI">Côte D'ivoire (Ivory Coast)</option>

                <option value="DK">Denmark</option>

                <option value="DJ">Djibouti</option>

                <option value="DM">Dominica</option>

                <option value="DO">Dominican Republic</option>

                <option value="TP">East Timor</option>

                <option value="EC">Ecuador</option>

                <option value="EG">Egypt</option>

                <option value="SV">El Salvador</option>

                <option value="GQ">Equatorial Guinea</option>

                <option value="ER">Eritrea</option>

                <option value="EE">Estonia</option>

                <option value="ET">Ethiopia</option>

                <option value="FK">Falkland Islands (Malvinas)</option>

                <option value="FO">Faroe Islands</option>

                <option value="FJ">Fiji</option>

                <option value="FI">Finland</option>

                <option value="FR">France</option>

                <option value="FX">France, Metropolitan</option>

                <option value="GF">French Guiana</option>

                <option value="PF">French Polynesia</option>

                <option value="TF">French Southern Territories</option>

                <option value="GA">Gabon</option>

                <option value="GM">Gambia</option>

                <option value="GE">Georgia</option>

                <option value="DE">Germany</option>

                <option value="GH">Ghana</option>

                <option value="GI">Gibraltar</option>

                <option value="GR">Greece</option>

                <option value="GL">Greenland</option>

                <option value="GD">Grenada</option>

                <option value="GP">Guadeloupe</option>

                <option value="GU">Guam</option>

                <option value="GT">Guatemala</option>

                <option value="GN">Guinea</option>

                <option value="GW">Guinea-Bissau</option>

                <option value="GY">Guyana</option>

                <option value="HT">Haiti</option>

                <option value="HM">Heard & McDonald Islands</option>

                <option value="HN">Honduras</option>

                <option value="HK">Hong Kong</option>

                <option value="HU">Hungary</option>

                <option value="IS">Iceland</option>

                <option value="IN">India</option>

                <option value="ID">Indonesia</option>

                <option value="IQ">Iraq</option>

                <option value="IE">Ireland</option>

                <option value="IR">Islamic Republic of Iran</option>

                <option value="IL">Israel</option>

                <option value="IT">Italy</option>

                <option value="JM">Jamaica</option>

                <option value="JO">Jordan</option>

                <option value="KZ">Kazakhstan</option>

                <option value="KE">Kenya</option>

                <option value="KI">Kiribati</option>

                <option value="KP">Korea, Democratic People's Republic of</option>

                <option value="KR">Korea, Republic of</option>

                <option value="KW">Kuwait</option>

                <option value="KG">Kyrgyzstan</option>

                <option value="LA">Lao People's Democratic Republic</option>

                <option value="LV">Latvia</option>

                <option value="LB">Lebanon</option>

                <option value="LS">Lesotho</option>

                <option value="LR">Liberia</option>

                <option value="LY">Libyan Arab Jamahiriya</option>

                <option value="LI">Liechtenstein</option>

                <option value="LT">Lithuania</option>

                <option value="LU">Luxembourg</option>

                <option value="MO">Macau</option>

                <option value="MG">Madagascar</option>

                <option value="MW">Malawi</option>

                <option value="MY">Malaysia</option>

                <option value="MV">Maldives</option>

                <option value="ML">Mali</option>

                <option value="MT">Malta</option>

                <option value="MH">Marshall Islands</option>

                <option value="MQ">Martinique</option>

                <option value="MR">Mauritania</option>

                <option value="MU">Mauritius</option>

                <option value="YT">Mayotte</option>

                <option value="MX">Mexico</option>

                <option value="FM">Micronesia</option>

                <option value="MD">Moldova, Republic of</option>

                <option value="MC">Monaco</option>

                <option value="MN">Mongolia</option>

                <option value="MS">Monserrat</option>

                <option value="MA">Morocco</option>

                <option value="MZ">Mozambique</option>

                <option value="MM">Myanmar</option>

                <option value="NA">Namibia</option>

                <option value="NR">Nauru</option>

                <option value="NP">Nepal</option>

                <option value="NL">Netherlands</option>

                <option value="AN">Netherlands Antilles</option>

                <option value="NC">New Caledonia</option>

                <option value="NZ">New Zealand</option>

                <option value="NI">Nicaragua</option>

                <option value="NE">Niger</option>

                <option value="NG">Nigeria</option>

                <option value="NU">Niue</option>

                <option value="NF">Norfolk Island</option>

                <option value="MP">Northern Mariana Islands</option>

                <option value="NO">Norway</option>

                <option value="OM">Oman</option>

                <option value="PK">Pakistan</option>

                <option value="PW">Palau</option>

                <option value="PA">Panama</option>

                <option value="PG">Papua New Guinea</option>

                <option value="PY">Paraguay</option>

                <option value="PE">Peru</option>

                <option value="PH">Philippines</option>

                <option value="PN">Pitcairn</option>

                <option value="PL">Poland</option>

                <option value="PT">Portugal</option>

                <option value="PR">Puerto Rico</option>

                <option value="QA">Qatar</option>

                <option value="RO">Romania</option>

                <option value="RU">Russian Federation</option>

                <option value="RW">Rwanda</option>

                <option value="RE">Réunion</option>

                <option value="LC">Saint Lucia</option>

                <option value="WS">Samoa</option>

                <option value="SM">San Marino</option>

                <option value="ST">Sao Tome & Principe</option>

                <option value="SA">Saudi Arabia</option>

                <option value="SN">Senegal</option>

                <option value="RS">Serbia</option>

                <option value="SC">Seychelles</option>

                <option value="SL">Sierra Leone</option>

                <option value="SG">Singapore</option>

                <option value="SK">Slovakia</option>

                <option value="SI">Slovenia</option>

                <option value="SB">Solomon Islands</option>

                <option value="SO">Somalia</option>

                <option value="ZA">South Africa</option>

                <option value="GS">South Georgia and the South Sandwich Islands</option>

                <option value="ES">Spain</option>

                <option value="LK">Sri Lanka</option>

                <option value="SH">St. Helena</option>

                <option value="KN">St. Kitts and Nevis</option>

                <option value="PM">St. Pierre & Miquelon</option>

                <option value="VC">St. Vincent & the Grenadines</option>

                <option value="SD">Sudan</option>

                <option value="SR">Suriname</option>

                <option value="SJ">Svalbard & Jan Mayen Islands</option>

                <option value="SZ">Swaziland</option>

                <option value="SE">Sweden</option>

                <option value="CH">Switzerland</option>

                <option value="SY">Syrian Arab Republic</option>

                <option value="TW">Taiwan, Province of China</option>

                <option value="TJ">Tajikistan</option>

                <option value="TZ">Tanzania, United Republic of</option>

                <option value="TH">Thailand</option>

                <option value="TG">Togo</option>

                <option value="TK">Tokelau</option>

                <option value="TO">Tonga</option>

                <option value="TT">Trinidad & Tobago</option>

                <option value="TN">Tunisia</option>

                <option value="TR">Turkey</option>

                <option value="TM">Turkmenistan</option>

                <option value="TC">Turks & Caicos Islands</option>

                <option value="TV">Tuvalu</option>

                <option value="UG">Uganda</option>

                <option value="UA">Ukraine</option>

                <option value="AE">United Arab Emirates</option>

                <option value="UM">United States Minor Outlying Islands</option>

                <option value="VI">United States Virgin Islands</option>

                <option value="UY">Uruguay</option>

                <option value="UZ">Uzbekistan</option>

                <option value="VU">Vanuatu</option>

                <option value="VA">Vatican City State (Holy See)</option>

                <option value="VE">Venezuela</option>

                <option value="VN">Viet Nam</option>

                <option value="WF">Wallis & Futuna Islands</option>

                <option value="EH">Western Sahara</option>

                <option value="YE">Yemen</option>

                <option value="ZR">Zaire</option>

                <option value="ZM">Zambia</option>

                <option value="ZW">Zimbabwe</option>

            </select>

        </fieldset>

        <p>

            <input id="SaveAccount" type="button" value="Submit form" />

        </p>

        </form>

    </div>

</body>

</html>

