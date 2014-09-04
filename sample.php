<?php

//logged in user's email

if(true){
    //echo'<script> window.location="/login/"; </script> ';
}
?>
<script>
    $(document).ready(function(event) {
        $(".profile").click(function(event){
            if($(".tshirt").val() == ""){
                alert("Please Select the T-shirt size");
                return false;
            }
            if($(".diet").val() == ""){
                alert("Please Select your Dietary Requirement");
                return false;
            }
        });
    });
</script>

<script>
    $(document).ready(function(event) {
        $("#sharefb").click(function(){
            var email = <?php echo "\"".$email."\"";?>;
            var event = "FB";
            $.ajax({
                type:"POST",
                async:false,
                url: "/wp-admin/admin-ajax.php",
                data: {	'action':'wso2con14usShare',
                    'email' : email,
                    'event' : event
                },
                success:function(response) {}
            });
        });
        $("#sharetwitter").click(function(){
            var email = <?php echo "\"".$email."\"";?>;
            var event = "Twitter";
            $.ajax({
                type:"POST",
                async:false,
                url: "/wp-admin/admin-ajax.php",
                data: {	'action':'wso2con14usShare',
                    'email' : email,
                    'event' : event
                },
                success:function(response) {}
            });
        });
        $("#sharelinked").click(function(){
            var email = <?php echo "\"".$email."\"";?>;
            var event = "LinkedIn";
            $.ajax({
                type:"POST",
                async:false,
                url: "/wp-admin/admin-ajax.php",
                data: {	'action':'wso2con14usShare',
                    'email' : email,
                    'event' : event
                },
                success:function(response) {}
            });
        });
    });
</script>

<a id="top" class="cBookmark"></a>
<h1 class="cTitle">My Profile</h1>
<?php

//Loading user profile

global $wpdb;
$table = $wpdb->prefix . 'wso214usprofile';
$sql = "SELECT * FROM $table WHERE email='$email'";
$userresult = $wpdb->get_results($sql);

$status_message = "";
$tsize = "";
$diet = "";
$morning_tut = "";
$aft_tut = "";


if(count($userresult) > 0){
    $tsize = $userresult[0]->tsize;
    $diet = $userresult[0]->diet;
    $morning_tut = $userresult[0]->morning_tut;
    $aft_tut = $userresult[0]->aft_tut;
}

//personal info
if(isset($_POST['update_profile']) && isset($_POST['update_profile']) == "Update"){

    $tsize = isset($_POST['tshirt']) ? $_POST['tshirt'] : "";
    $diet = isset($_POST['diet']) ? $_POST['diet'] : "";

    if(count($userresult) > 0){
        //user record exists

        $table = $wpdb->prefix . 'wso214usprofile';
        $sql = "UPDATE $table SET tsize='".$tsize."', diet='".$diet."' WHERE email='".$email."'";
        $result = $wpdb->query($sql);
    }else{
        $table = $wpdb->prefix . 'wso214usprofile';
        $sql = "INSERT INTO $table (email, tsize, diet) VALUES ('".$email."', '".$tsize."', '".$diet."')";
        $result = $wpdb->query($sql);
    }
    if($result == 1){$status_message = "Your Profile information updated.";}
}

// Tutorials
if(isset($_POST['update_tutorial']) && isset($_POST['update_tutorial']) == "Update"){

    $mor_tut = isset($_POST['mor_tut']) ? $_POST['mor_tut'] : "";
    $aft_tut = isset($_POST['aft_tut']) ? $_POST['aft_tut'] : "";

    if(count($userresult) > 0){
        //user record exists

        $table = $wpdb->prefix . 'wso214usprofile';
        $sql = "UPDATE $table SET morning_tut ='".$mor_tut."', aft_tut='".$aft_tut."' WHERE email='".$email."'";
        $result = $wpdb->query($sql);
    }else{
        $table = $wpdb->prefix . 'wso214usprofile';
        $sql = "INSERT INTO $table (email, morning_tut , aft_tut) VALUES ('".$email."', '".$mor_tut."', '".$aft_tut."')";
        $result = $wpdb->query($sql);
    }
    if($result == 1){$status_message = "Your Tutorial preferences are updated.";}
}

?>
<div class="cContent">
<div class="cContentRow">
<div class="cMessage cMyProfile">
    <form name="wso2con14usreg" action="/my-profile-test" method="POST">
        <div class="cMyProfileRightLinks">
            <ul>
                <li><a href="#">Change Password</a></li>
                <li><a href="#preferences">My Preferences</a></li>
                <li><a href="#visa">Download Visa Letter</a></li>a
                <li><a href="#invoice">Download Invoice</a></li>
            </ul>
        </div>
        <?php echo $status_message;?>
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="cUserName">
                    Username:
                </td>
                <td class="cUserName">
                    amal@wso2.com
                </td>
            </tr>
            <tr>
                <td><label>First Name<sup></sup></label></td>
                <td><input type="text" name="firstname1" class="cDetails field_fn" value="Amal" disabled="disabled"/></td>
            </tr>
            <tr>
                <td><label>Last Name<sup></sup></label></td>
                <td><input type="text" name="lastname1" class="cDetails field_ln" value="Rangana" disabled="disabled"/></td>
            </tr>
            <tr>
                <td><label>Email<sup></sup></label></td>
                <td><input type="text" name="email1" class="cDetails field_email" value="amal@wso2.com" disabled="disabled"/></td>
            </tr>
            <tr>
                <td><label>Phone<sup></sup></label></td>
                <td><input type="text" name="phone1" class="cDetails field_phone" value="+94777358265" disabled="disabled"/></td>
            </tr>
            <tr>
                <td><label>Company<sup></sup></label></td>
                <td><input type="text" name="company1" class="cDetails field_company" value="WSO2" disabled="disabled"/></td>
            </tr>
            <tr>
                <td><label>Job Title<sup></sup></label></td>
                <td><input type="text" name="title1" class="cDetails field_title" value="Sernior Technical Lead" disabled="disabled"/></td>
            </tr>
            <tr>
                <td><label>Country<sup></sup></label></td>
                <td><input type="text" name="title1" class="cDetails field_title" value="Sri Lanka" disabled="disabled"/></td>
            </tr>
            <tr>
                <td><label>State</label></td>
                <td><input type="text" name="title1" class="cDetails field_title" value="" disabled="disabled"/></td>
            </tr>
            <tr>
                <td><label>City</label></td>
                <td><input type="text" name="city1" class="cDetails field_city" value="Colombo" disabled="disabled"/></td>
            </tr>
        </table>
        <div class="cSizes">
            <table>
                <tr>
                    <td><label>T-shirt size</label></td>
                    <td>
                        <select size="1" class="cSelect tshirt" id="" name="tshirt">
                            <option value="">Select size</option>
                            <option value="XXL" <?php if($tsize == "XXL"){echo "selected=\"selected\"";} ?>>XXL</option>
                            <option value="XL" <?php if($tsize == "XL"){echo "selected=\"selected\"";} ?>>XL</option>
                            <option value="L" <?php if($tsize == "L"){echo "selected=\"selected\"";} ?>>L</option>
                            <option value="M" <?php if($tsize == "M"){echo "selected=\"selected\"";} ?>>M</option>
                            <option value="S" <?php if($tsize == "S"){echo "selected=\"selected\"";} ?>>S</option>
                            <option value="XS" <?php if($tsize == "XS"){echo "selected=\"selected\"";} ?>>XS</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Dietary Requirements</label></td>
                    <td>
                        <select size="1" class="cSelect diet" id="" name="diet">
                            <option value="">Select Dietary Option</option>
                            <option value="Vegetarian" <?php if($diet == "Vegetarian"){echo "selected=\"selected\"";} ?>>Vegetarian</option>
                            <option value="Non-Vegetarian" <?php if($diet == "Non-Vegetarian"){echo "selected=\"selected\"";} ?>>Non-Vegetarian</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <div class="cButtonPane">
            <input type="submit" class="cSubBtn profile" value="Update" name="update_profile"/>
        </div>
    </form>
</div>
<a id="preferences" class="cBookmark"></a><a href="#top" class="cTop">My Profile</a>
<h3>My Preferences</h3>
<div class="cMessage cMyProfile">
    <h3>Pre-conference Tutorials</h3>
    <form name="wso2con14usreg" action="/my-profile-test" method="POST">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td><label>Morning Session</label></td>
                <td>
                    <select size="1" class="cSelect" id="" name="mor_tut">
                        <option value="">Select Track</option>
                        <option value="BigData" <?php if($mor_tut == "BigData"){echo "selected=\"selected\"";} ?>>Big Data Analytics</option>
                        <option value="Stratos" <?php if($mor_tut == "Stratos"){echo "selected=\"selected\"";} ?>>Apache Stratos & WSO2 Private PaaS</option>
                        <option value="ESB" <?php if($mor_tut == "ESB"){echo "selected=\"selected\"";} ?>>ESB</option>
                        <option value="Scalability" <?php if($mor_tut == "Scalability"){echo "selected=\"selected\"";} ?>>Scalability + DevOps</option>
                        <option value="Governance" <?php if($mor_tut == "Governance"){echo "selected=\"selected\"";} ?>>Governance</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Afternoon Session</label></td>
                <td>
                    <select size="1" class="cSelect" id="" name="aft_tut">
                        <option value="">Select Track</option>
                        <option value="Identity" <?php if($aft_tut == "Identity"){echo "selected=\"selected\"";} ?>>Identity Server</option>
                        <option value="AppFactory" <?php if($aft_tut == "AppFactory"){echo "selected=\"selected\"";} ?>>App Factory</option>
                        <option value="IoT" <?php if($aft_tut == "IoT"){echo "selected=\"selected\"";} ?>>IoT & Mobility with WSO2 EMM</option>
                        <option value="APIManager" <?php if($aft_tut == "APIManager"){echo "selected=\"selected\"";} ?>>API Manager</option>
                        <option value="WSO2PublicCloud" <?php if($aft_tut == "WSO2PublicCloud"){echo "selected=\"selected\"";} ?>>WSO2 Public Cloud</option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="cButtonPane">
            <input type="submit" class="cSubBtn tutorial" value="Update" name="update_tutorial"/>
        </div>
    </form>
</div>
<a id="share" class="cBookmark"></a><a href="#top" class="cTop">My Profile</a>
<h3>Tell Your Friends and Win Big</h3>
<div class="cMessage cMyProfile">
    <h3>Here's your chance to win a funky GoPro camera by telling your friends you've registered for WSO2Con!</h3>
    <p>Start sharing now,</p>
    <ul class="cShare">

        <li><a onclick="window.open('http://www.facebook.com/share.php?u=http://us14.wso2con.com/', 'sharer', 'toolbar=0,status=0,width=620,height=280');" href="javascript: void(0)" id="sharefb"><img src="http://us14.wso2con.com/wp-content/themes/wso2conus14/images/wso2con-usa-2014-sm-share-fb.png" alt="Share in Facebook"/></a></li>

        <li><a onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=http://us14.wso2con.com&title=I%20just%20registered%20for%20#WSO2ConUSA%202014,%20you%20should%20check%20it%20out%20too&summary=&source=http://us14.wso2con.com', 'sharer', 'toolbar=0,status=0,width=620,height=280');" href="javascript: void(0)" id="sharelinked" ><img src="http://us14.wso2con.com/wp-content/themes/wso2conus14/images/wso2con-usa-2014-sm-share-ln.png" alt="Share in LinkedIn"/></a></li>

        <li><a onclick="window.open('https://twitter.com/intent/tweet?text=I%20just%20registered%20for%20%23WSO2ConUSA,%20you%20should%20check%20it%20out%20too%20-%20http://us14.wso2con.com&via=wso2&', 'sharer', 'toolbar=0,status=0,width=620,height=280');" href="javascript: void(0)" id="sharetwitter"><img src="http://us14.wso2con.com/wp-content/themes/wso2conus14/images/wso2con-usa-2014-sm-share-tw.png" alt="Share in Twitter"/></a></li>

    </ul>
    <a href="/contest-tell-a-friend/">More details...</a>
</div>
<a id="visa" class="cBookmark"></a><a href="#top" class="cTop">My Profile</a>
<h3>Download Visa Letter</h3>
<div class="cMessage cMyProfile">
    <h3>Please fill the following fields in order to download visa requesting letter.</h3>
    <form name="wso2con14usreg" action="/registration/confirmation/" method="POST">
        <table cellpadding="0" cellspacing="0" border="0" class="cVisa">
            <tr>
                <td><label>Full Name as per passport*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>Passport Number*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>Date of Issue*</label></td>
                <td>
                    <table cellpadding="0" cellspacing="0" border="0" style="margin: 0px;" class="cDates">
                        <tr>
                            <td><input type="text" name="city1" class="cDetails cDate field_city" value=""/></td>
                            <td><label>dd</label></td>
                            <td><input type="text" name="city1" class="cDetails cDate field_city" value=""/></td>
                            <td><label>mm</label></td>
                            <td><input type="text" name="city1" class="cDetails cDate field_city" value=""/></td>
                            <td><label>yyyy</label></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><label>Date of Expiry*</label></td>
                <td>
                    <table cellpadding="0" cellspacing="0" border="0" style="margin: 0px;" class="cDates">
                        <tr>
                            <td><input type="text" name="city1" class="cDetails cDate field_city" value=""/></td>
                            <td><label>dd</label></td>
                            <td><input type="text" name="city1" class="cDetails cDate field_city" value=""/></td>
                            <td><label>mm</label></td>
                            <td><input type="text" name="city1" class="cDetails cDate field_city" value=""/></td>
                            <td><label>yyyy</label></td>
                        </tr>
                    </table>
                </td>
            </tr><tr>
                <td><label>Place of Issue*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr><tr>
                <td><label>Name of the organization*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
        </table>
        <div class="cButtonPane">
            <input type="submit" class="cSubBtn" value="Download" name="register"/>
        </div>
    </form>
</div>
<a id="invoice" class="cBookmark"></a><a href="#top" class="cTop">My Profile</a>
<h3>Download Invoice</h3>
<div class="cMessage cMyProfile">
    <h3>Please fill the following fields in order to download your invoice.</h3>
    <form name="wso2con14usreg" action="/registration/confirmation/" method="POST">
        <table cellpadding="0" cellspacing="0" border="0" class="cVisa">
            <tr>
                <td><label>First Name*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>Last Name*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>Email*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>Phone*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>Company*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>Job Title*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>Address Line 1*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>Address Line 2*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>Country*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>State</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>City*</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
            <tr>
                <td><label>PO no.</label></td>
                <td>
                    <input type="text" name="city1" class="cDetails field_city" value=""/>
                </td>
            </tr>
        </table>
        <div class="cButtonPane">
            <input type="submit" class="cSubBtn" value="Download" name="register"/>
        </div>
    </form>
</div>
</div>
</div>