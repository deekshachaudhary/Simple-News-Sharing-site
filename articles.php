<?php
require connection.php;
$stmt  = $mysqli -> prepare("select title, website from articles order by genre");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
} 
$stmt->execute();
 
$result = $stmt->get_result();
 
echo "<ul>\n";
while($row = $result->fetch_assoc()){
	printf("\t<li>%s %s</li>\n",
		htmlspecialchars( $row["title"] ),
		htmlspecialchars( $row["website"] )
	);
}
echo "</ul>\n";
 
$stmt->close();
?>
