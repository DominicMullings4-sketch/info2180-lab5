<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) && is_string($_GET['country']) ? trim($_GET['country']) : '';

$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE ?");
$stmt->execute(["%{$country}%"]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*
Old country lookup functioality
if($country === ''){
  echo '<ul>';
  foreach($results as $row){
    echo '<li>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</li>';
  }
  echo '</ul>';
} else {
  echo '<ul>';
  $ctry = null;
  foreach($results as $row){
    $ctry = $row;
    echo '<li>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</li>';
  }
  echo '</ul>';

  if($ctry === null){
    echo 'Country does not exist.';
  } 
}
*/
echo '<table>';
echo '<thead><tr><th>Name</th><th>Continent</th><th>Independence</th><th>Head of State</th></tr></thead>';
echo  '<tbody>';

foreach ($results as $row) {

echo '<tr>';
echo '<td>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</td>';
echo '<td>' . htmlspecialchars($row['continent'], ENT_QUOTES, 'UTF-8') . '</td>';
echo '<td>' . htmlspecialchars($row['independence_year'], ENT_QUOTES, 'UTF-8') . '</td>';
echo '<td>' . htmlspecialchars($row['head_of_state'], ENT_QUOTES, 'UTF-8') . '</td>';
echo '</tr>';
}
   
echo '</tbody>';
echo '</table>';
?>

