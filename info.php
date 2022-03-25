<?php

// $domain = '@auxiliomutuo.com';
// $host = "auxiliomutuo.com";
// $port = 389;
// $protocol = 'ldap';
// $base_dn = 'OU=HAM_SanJuan,DC=auxiliomutuo,DC=com';

$name = "dmonzon";
$pass = "Salud@21";

$adServer = "auxiliomutuo.com";
$ldapconn = ldap_connect($adServer) or die("Could not connect to LDAP server.");
// ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Could not set ldap protocol");
// ldap_set_option($ad, LDAP_OPT_REFERRALS, 0) or die ("Could not set option referrals");

$account = $name;
$password = $pass;
$ldaprdn = $account.'@auxiliomutuo.com';
$ldappass = $password;

if ($ldapconn) {
 $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass)  or die("Couldn't bind to AD!");
}

$dn = 'OU=Auxilio_Groups,DC=auxiliomutuo,DC=com';
$filter="(objectcategory=group)";
$justthese = array("dn","ou");
$sr=ldap_search($ldapconn, $dn, $filter, $justthese);
$info = ldap_get_entries($ldapconn, $sr);
sort($info);
// $token = $info[0]['primarygroupid'][0];
// echo $token."<br/>";
// array_shift($info);
// echo "<pre>";
// print_r($info);

// OU=Application Security

// $filteres = array_filter($info[1], function($str) {
//     return $str === 'OU=Application Security';
// });

echo "<pre>";
for ($i=0; $i < $info[0]; $i++) {
    @$row = explode(",",$info[$i]["dn"]);
    //echo $info[$i]["dn"]."<br>";
    $group = str_replace("CN=",'',$row[0]);
    if(@$row[1] === 'OU=Application Security' || @$row[1] === 'OU=Platform Security') echo $group."<br>";
}
ldap_free_result($sr);
ldap_unbind($ldapconn);
?>