<!DOCTYPE html>
<html>
  <head>
    <title>myProjects</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
    <script type="text/javascript" src="resources/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="resources/iit.js"></script>   
    <link href="resources/iit.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
    <div id="bodyBlock">

      <h1>myProjects</h1>
            
<?php 
  $title = '';  
  // hold any error messages
  $errors = ''; 
  
  $havePost = isset($_POST["save"]);
  
  if ($havePost) {
    // Get the input and clean it.
    $title = htmlspecialchars(trim($_POST["title"]));  
    
    // validation
    $focusId = ''; 
    
    if ($title == '') {
      $errors .= '<li>Lab name may not be blank</li>';
      if ($focusId == '') $focusId = '#title';
    }
    if ($errors != '') { ?>
      <div id="messages">
        <h4>Please correct the following errors:</h4>
        <ul>
          <?php echo $errors; ?>
        </ul>
        <script type="text/javascript">
          $(document).ready(function() {
            $("<?php echo $focusId ?>").focus();
          });
        </script>
      </div>
    <?php } else { ?>
      <div id="messages">
        <h4>Title submitted</h4>
      </div>
    <?php } 
  }
?>

<?php 
?>
<form id="addForm" name="addForm" action="loadData.php" method="post">
  <fieldset> 
    <legend>Add lab</legend>
    <div class="formData">
                    
      <label class="field" for="title">Lab Names:</label>
      <div class="value"><input type="text" size="60" value="<?php echo $title; ?>" name="title" id="title"/></div>
      
      <input type="submit" value="save" id="save" name="save"/>
    </div>
  </fieldset>
</form>

<?php if($havePost && $errors == '') { ?>
  <h3>Lab:</h3>
  <table>
    <tr>
      <th>Name:</th>
      <td>
        <?php echo $title; ?>
      </td>
    </tr>
  </table>
  
  <h3>All Parameters:</h3>
  <?php
    echo '<table>';
    foreach($_POST AS $key => $value) {
      echo '<tr><td>' . htmlspecialchars($key) . '</td><td>' . htmlspecialchars($value) . '</td></tr>';
    }
    echo '</table>';
  }
?>
      
    </div>
  </body>
</html>
