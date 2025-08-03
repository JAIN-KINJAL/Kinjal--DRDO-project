<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "proforma_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CFESS DRDO Portal</title>
  <style>
    /* Your same CSS from index.html */
  </style>
</head>
<body>


<h2 class="proforma downloads">Proforma Downloads</h2>
<div class="tab-bar">
  <button class="tab" onclick="showTab('qrs')">QRS&IT</button>
  <button class="tab" onclick="showTab('admin')">Admin</button>
  <!-- ... your other buttons ... -->
</div>

<!-- Dynamic Records Table in the QRS Tab -->
<div id="qrs" class="tab-content">
  <h2>QRS & IT Forms</h2>
  
  <?php
  // Fetch records from database
  $sql = "SELECT * FROM records";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>ID</th><th>Username</th><th>Location</th><th>Size</th><th>Created</th><th>Group ID</th></tr>";
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>".$row['id']."</td>";
          echo "<td>".$row['username']."</td>";
          echo "<td>".$row['location']."</td>";
          echo "<td>".$row['size']."</td>";
          echo "<td>".$row['id_created']."</td>";
          echo "<td>".$row['group_id']."</td>";
          echo "</tr>";
      }
      echo "</table>";
  } else {
      echo "No records found.";
  }
  ?>
</div>

<!-- Keep the other tabs static for now -->
<div id="admin" class="tab-content">
  <h2>Admin Forms</h2>
  <!-- Keep your static tables or add dynamic queries later -->
</div>

<script>
  function showTab(tabId) {
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => tab.style.display = 'none');
    document.getElementById(tabId).style.display = 'block';
  }
  window.onload = () => showTab('qrs');
</script>

</body>
</html>
<?php $mysqli->close(); ?>
