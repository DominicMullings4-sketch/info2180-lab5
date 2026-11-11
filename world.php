<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) && is_string($_GET['country']) ? trim($_GET['country']) : '';
$lookup = isset($_GET['lookup']) && is_string($_GET['lookup']) ? trim($_GET['lookup']) : 'countries';

if($lookup === 'cities'){
  $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities INNER JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE ?");
  $stmt->execute(["%{$country}%"]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo '<table>';
  echo '<thead><tr><th>Name</th><th>District</th><th>Population</th></tr></thead>';
  echo  '<tbody>';

  foreach ($results as $row) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['district'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['population'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '</tr>';
  }
    
  echo '</tbody>';
  echo '</table>';

} else {
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE ?");
  $stmt->execute(["%{$country}%"]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo '<table>';
  echo '<thead><tr><th>Name</th><th>Continent</th><th>Independence</th><th>Head of State</th></tr></thead>';
  echo '<tbody>';

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
}
?>

