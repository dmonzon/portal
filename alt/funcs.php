<?php
function toConsole($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
// function to crate the menu
function buildMenu($menu,$conn)
{
  $html = '';
  $opt = "'".implode("','", $menu)."'";
  $tsql ="SELECT x.[GroupID]
    ,g.GroupName
    ,x.[OptionID]
    ,o.[OptionName]
    ,x.[ParentGrpID]
  FROM [dbo].[WebGrpXOpt] x
  inner join [dbo].[WebOptions] o on x.[OptionID] = o.id
  inner join [dbo].[WebGroups] g on x.[GroupID] = g.id ";

  if(stripos($opt,'MIS Database') > 0)
  {
      $tsql .= 'where x.Active = 1 order by 5,4';
  }else{
      $tsql .= 'where g.GroupName in ('.$opt.') and x.Active = 1 order by 5,4';
  }
    $getResults = sqlsrv_query($conn, $tsql);
    if( $getResults === false ) {
      die( print_r( sqlsrv_errors(), true));
    }
    
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC))
    {
      echo $row['GroupID'] . ' | ' .$row['GroupName'] . ' | ' . $row['OptionID'] . ' | ' .$row['OptionName'] . ' | ' .$row['ParentGrpID']. '<br/>';

      if($row['ParentGrpID'] == 0){
        $parents[] = ['id'=>$row['GroupID'],'name'=>$row['GroupName']];
        
      }else{
        $childs[] = ['id'=>$row['ParentGrpID'],'name'=>$row['OptionName']];
      }
    }
    $i = 0;
    foreach($parents as $parent)
    { 
      // foreach ($parents[$i] as $parent) {
      $key = $parents[$i]['id'];
      //$html .= "<dt>".$parents[$i]['name']."</dt>";
      $html .= '<li class="menu_left">
      <a href="#" class="drop">'.$parents[$i]['name'].'</a>
                  <div class="dropdown_1column">
                    <div class="col_1">
                      <ul class="simple">';
      foreach($childs as $child){
        if($child['id']==$key){
          //echo $child['id'] . ' ==>'.$key.'</br>';
          //$html .= "<dd>".$child['name']."</dd>";
          $html .= '<li><a href="'.strtolower($child['name']).'.php">'.$child['name'].'</a></li>';
          $_SESSION['links'][] = $child['name'];
        }
      }
      $i++;
      $html .= '</ul></div></div></li>';
    }
    
    return $html;
  }
  
function ldap_login($username, $password) {
    global $host, $port, $protocol, $base_dn, $domain;
    if ($username && $password) {
        $connection_string = "$protocol://$host:$port";
        $conn = @ldap_connect($connection_string) or $msg = "Could not connect: $connection_string";
        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);
    
        $ldaprdn = $username.$domain;
        $ldapbind = @ldap_bind($conn, $ldaprdn, $password);
        if ($ldapbind) {
            $search = ldap_search($conn, $base_dn, "(samaccountname=$username)");
            if ($search) {
                $result = ldap_get_entries($conn, $search);
                if ($result['count'] > 0) {
                    $returnval = 1; // "Success"
                }
                else {
                    $returnval = -1; // "User not found"
                }
            }
        }
        else {
            $returnval = 0; // "Incorrect username/password"
        }    
    }
    else {
        $returnval = -1; // "Please enter username/password"
    }
	
    return $returnval;    
}

function get_groups($username,$password) {
    global $host, $port, $protocol, $base_dn, $domain;
    $domain = '@auxiliomutuo.com';
    $host = "auxiliomutuo.com";
    $port = 389;
    $protocol = 'ldap';
    $base_dn = 'OU=HAM_SanJuan,DC=auxiliomutuo,DC=com';
    // Use admin user in LDAP to query
    
	// Active Directory server
	$connection_string = "$protocol://$host:$port";
 
	// Active Directory DN, base path for our querying user
	$ldap_dn = $base_dn;
 
	// Active Directory user for querying
	$query_user = $username."$domain";
	$password = $password;
 
	// Connect to AD
	$ldap = ldap_connect($connection_string) or die("Could not connect to LDAP");
	@ldap_bind($ldap,$query_user,$password) or die("<center><h2>Please check your username and password and try again.</h2></center>");
 
	// Search AD
	$results = ldap_search($ldap,$ldap_dn,"(samaccountname=$username)",array("memberof","primarygroupid"));
	$entries = ldap_get_entries($ldap, $results);
	
	// No information found, bad user
	if($entries['count'] == 0) return false;
	
	// Get groups and primary group token
	$output = $entries[0]['memberof'];
	$token = $entries[0]['primarygroupid'][0];
	
	// Remove extraneous first entry i.e. the count of the groups the user belongs to
	array_shift($output);
	
	// We need to look up the primary group, get list of all groups
	$results2 = ldap_search($ldap,$ldap_dn,"(objectcategory=group)",array("distinguishedname","primarygrouptoken"));
	$entries2 = ldap_get_entries($ldap, $results2);
	
	// Remove extraneous first entry
	array_shift($entries2);
	
	// Loop through and find group with a matching primary group token
	foreach($entries2 as $e) {
		if($e['primarygrouptoken'][0] == $token) {
			// Primary group found, add it to output array
			$output[] = $e['distinguishedname'][0];
			// Break loop
			break;
		}
	}

	return $output;
}

function allGroups($name,$pass) {
      global $host, $port, $protocol, $base_dn, $domain;
      $adServer = "auxiliomutuo.com";
      $ldapconn = ldap_connect($adServer) or die("Could not connect to LDAP server.");
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

      for ($i=0; $i < $info[0]; $i++) {
          @$row = explode(",",$info[$i]["dn"]);
          //echo $info[$i]["dn"]."<br>";
          $group = str_replace("CN=",'',$row[0]);
          if(@$row[1] === 'OU=Application Security' || @$row[1] === 'OU=Platform Security') $groups[] = trim($group);
      }
      ldap_free_result($sr);
      ldap_unbind($ldapconn);

      return $groups;
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

/**
 * This function searchs in LDAP tree entry specified by samaccountname and
 * returns its DN or epmty string on failure.
 *
 * @param resource $ad
 *          An LDAP link identifier, returned by ldap_connect().
 * @param string $samaccountname
 *          The sAMAccountName, logon name.
 * @param string $basedn
 *          The base DN for the directory.
 * @return string
 */
function getDN($ad, $samaccountname, $basedn)
{
  $result = ldap_search($ad, $basedn, "(samaccountname={$samaccountname})", array(
    'dn'
  ));
  if (! $result)
  {
    return '';
  }
 
  $entries = ldap_get_entries($ad, $result);
  if ($entries['count'] > 0)
  {
    return $entries[0]['dn'];
  }
 
  return '';
}
 
/**
 * This function retrieves and returns Common Name from a given Distinguished
 * Name.
 *
 * @param string $dn
 *          The Distinguished Name.
 * @return string The Common Name.
 */
function getCN($dn)
{
  preg_match('/[^,]*/', $dn, $matchs, PREG_OFFSET_CAPTURE, 3);
  return $matchs[0][0];
}
 
/**
 * This function checks group membership of the user, searching only in
 * specified group (not recursively).
 *
 * @param resource $ad
 *          An LDAP link identifier, returned by ldap_connect().
 * @param string $userdn
 *          The user Distinguished Name.
 * @param string $groupdn
 *          The group Distinguished Name.
 * @return boolean Return true if user is a member of group, and false if not
 *         a member.
 */
function checkGroup($ad, $userdn, $groupdn)
{
  $result = ldap_read($ad, $userdn, "(memberof={$groupdn})", array('members'));
  if (! $result)
  {
    return false;
  }
 
  $entries = ldap_get_entries($ad, $result);
 
  return ($entries['count'] > 0);
}
 
/**
 * This function checks group membership of the user, searching in specified
 * group and groups which is its members (recursively).
 *
 * @param resource $ad
 *          An LDAP link identifier, returned by ldap_connect().
 * @param string $userdn
 *          The user Distinguished Name.
 * @param string $groupdn
 *          The group Distinguished Name.
 * @return boolean Return true if user is a member of group, and false if not
 *         a member.
 */
function checkGroupEx($ad, $userdn, $groupdn)
{
  $result = ldap_read($ad, $userdn, '(objectclass=*)', array(
    'memberof'
  ));
  if (! $result)
  {
    return false;
  }
 
  $entries = ldap_get_entries($ad, $result);
  if ($entries['count'] <= 0)
  {
    return false;
  }
 
  if (empty($entries[0]['memberof']))
  {
    return false;
  }
 
  for ($i = 0; $i < $entries[0]['memberof']['count']; $i ++)
  {
    if ($entries[0]['memberof'][$i] == $groupdn)
    {
      return true;
    }
    elseif (checkGroupEx($ad, $entries[0]['memberof'][$i], $groupdn))
    {
      return true;
    }
  }
 
  return false;
}
