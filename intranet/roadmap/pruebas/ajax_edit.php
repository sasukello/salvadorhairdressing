<?php
   require_once('common.php');
   $option = isset($_REQUEST['option']) ? $_REQUEST['option'] : '';
   $Id     = isset($_REQUEST['Id'])     ? $_REQUEST['Id']     : '';

   switch($option)
  {
  case 'edit': // Display Text box
$value = $EmployeeArray[$Id]['salary'];
echo '
    <input type="text" id="salary_'.$Id.'" value="'.$value.'"  style="width:50px;" /> 
    <input type="button" value="Save" onclick="return saveColumn(\''.$Id.'\');" />';
  break;

  case 'save': // Save to Database
$value = $_REQUEST['value'];
echo $value;
  break;
  }
  ?>
