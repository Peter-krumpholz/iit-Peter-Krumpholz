<?php 
  include('includes/init.inc.php'); 
  include('includes/functions.inc.php'); 
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php 
  include('includes/head.inc.php'); 
?>

<h1>PHP &amp; MySQL</h1>
 
<?php include('includes/menubody.inc.php'); ?>

<?php
  $dbOk = false;
  
  /* Create a new database connection object, passing in the host, username,
     password, and database to use. */
  @ $db = new mysqli('localhost', 'root', 'root', 'iit');
  
  if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else {
    $dbOk = true; 
  }

 
  $havePost = isset($_POST["save"]);
  
  // validation
  $errors = '';
  if ($havePost) {
    
    // Get the output and clean it for output on-screen.
    $title = htmlspecialchars(trim($_POST["title"]));  
    
    $focusId = ''; /*First field that needs to be updated*/
    
    if ($title == '') {
      $errors .= '<li>Lab name may not be blank</li>';
      if ($focusId == '') $focusId = '#title';
    }
  
    if ($errors != '') {
      echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
      echo $errors;
      echo '</ul></div>';
      echo '<script type="text/javascript">';
      echo '  $(document).ready(function() {';
      echo '    $("' . $focusId . '").focus();';
      echo '  });';
      echo '</script>';
    } else { 
      if ($dbOk) {
        // trims the input
    
        $titleForDb = trim($_POST["title"]);  
        
        $insQuery = "insert into myProjects ('title') values(?)";
        $statement = $db->prepare($insQuery);
        $statement->bind_param("s",$titleForDb);
        $statement->execute();
        
        // give the user feedback
        echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' lab added to database.</h4>';
        echo $title . ' ';
        
        $statement->close();
      }
    } 
  }
?>

<h3>Add Actor</h3>
<form id="addForm" name="addForm" action="index.php" method="post" onsubmit="return validate(this);">
  <fieldset> 
    <div class="formData">
                    
      <label class="field" for="title">Lab Name:</label>
      <div class="value"><input type="text" size="60" value="<?php if($havePost && $errors != '') { echo $title; } ?>" name="title" id="title"/></div>
      
      <input type="submit" value="save" id="save" name="save"/>
    </div>
  </fieldset>
</form>

<h3>Labs</h3>
<table id="myProjects">
<?php
  if ($dbOk) {

    $query = 'select * from myProjects';
    $result = $db->query($query);
    $numRecords = $result->num_rows;
    
    echo '<tr><th>Name:</th><</tr>';
    for ($i=0; $i < $numRecords; $i++) {
      $record = $result->fetch_assoc();
      if ($i % 2 == 0) {
        echo "\n".'<tr id="lab-' . $record['labid'] . '"><td>';
      } else {
        echo "\n".'<tr class="odd" id="lab-' . $record['labid'] . '"><td>';
      }
      echo htmlspecialchars($record['title']);
      echo '<tr><td colspan="3" style="white-space: pre;">';
      print_r($record);
      echo '</td></tr>';
    }
    
    $result->free();
    
    //close the database
    $db->close();
  }
  
?>
</table>

<?php include('includes/foot.inc.php'); 
  // footer info and closing tags
?>