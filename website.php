<html>
<title>Website</title>
</head>
<body>
   <div id="page">
   <div id="header">
      <h1>The News</h1>
      <h2>Browse your daily news below!</h2>
   </div>
   <fieldset>
   <form action="login.php" method='POST'>

         <legend>Login</legend>
         <label><b>Username</b></label>
         <input name="username" placeholder="Enter Username" required="" type="text">
         <label><b>Password</b></label>
         <input name= "password" placeholder = "Enter Password" required= "" type ="password">
         <input type="submit" value="Login">
   </form>

    <form action = "createNewUser.php" method = 'Post'>
    <legend>New User?</legend>
    <label><b>Username</b></label>
   <input name = "username" placeholder = "Create Username" required ="" type = "text">
   <label><b>Password</b></label>
   <input name= "password" placeholder = "Enter Password" required= "" type ="password">
   <input type = "submit" value = "Sign up">
   </form>
   </fieldset>
      
<!--Sports Section --> 
    <div class="contentTitle">
    <h1>Sports</h1>
    </div>

   <div class="contentText">
    <?php
    header("Content-type: text/html; charset=iso-8859-1");
    require 'connection.php';
    $stmt  = $mysqli -> prepare("SELECT title, author, user, article_num, website, content, num_likes FROM articles WHERE genre = 'sports'");
    if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }   
    $stmt->execute();
    $stmt -> bind_result($title, $author, $user, $article_num, $website, $content, $num_likes);
    $format = '<br><font size ="6">%s</font><br>Author: %s &nbsp Uploaded by: %s &nbsp Article number: %d  &nbsp Number of Likes: %d <br> <br>%s';
    echo "<ul>\n";
    while($stmt -> fetch()){
        printf($format,
                htmlspecialchars( $title ),
                htmlspecialchars( $author ),
                htmlspecialchars( $user ),
                htmlspecialchars( $article_num ),
                htmlspecialchars( $num_likes),
                $content
        );
        echo '<br><b>See full story at: </b><a href="' . $website . '" target="_blank">' . $website . '</a>';
    }
    $stmt->close();
    echo "</ul>\n";

    ?>

    </div>
   
   <!--Business Section -->
   <div class="contentTitle">
      <h1>Business</h1>
   </div>
   <div class="contentText">
      <?php
    header("Content-type: text/html; charset=iso-8859-1");
    require 'connection.php';
    $stmt  = $mysqli -> prepare("SELECT title, author, user, article_num, website, content, num_likes FROM articles WHERE genre = 'business'");
    if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }   
    $stmt->execute();
    $stmt -> bind_result($title, $author, $user, $article_num, $website, $content, $num_likes);
    $format = '<br><font size ="6">%s</font><br>Author: %s &nbsp Uploaded by: %s &nbsp Article number: %d  &nbsp Number of Likes: %d <br> <br>%s';
    echo "<ul>\n";
    while($stmt -> fetch()){
        printf($format,
                htmlspecialchars( $title ),
                htmlspecialchars( $author ),
                htmlspecialchars( $user ),
                htmlspecialchars( $article_num ),
                htmlspecialchars( $num_likes),
                $content
        );
        echo '<br><b>See full story at: </b><a href="' . $website . '" target="_blank">' . $website . '</a>';
    }
    $stmt->close();
    echo "</ul>\n";

    ?>
   </div>
   
   <!--Pop culture Section-->
   <div class="contentTitle">
      <h1>Pop Culture</h1>
   </div>
   <div class="contentText">
    <?php
    header("Content-type: text/html; charset=iso-8859-1");
    require 'connection.php';
    $stmt  = $mysqli -> prepare("SELECT title, author, user, article_num, website, content, num_likes FROM articles WHERE genre = 'Pop culture'");
    if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }   
    $stmt->execute();
    $stmt -> bind_result($title, $author, $user, $article_num, $website, $content, $num_likes);
    $format = '<br><font size ="6">%s</font><br>Author: %s &nbsp Uploaded by: %s &nbsp Article number: %d  &nbsp Number of Likes: %d <br> <br>%s';
    echo "<ul>\n";
    while($stmt -> fetch()){
        printf($format,
                htmlspecialchars( $title ),
                htmlspecialchars( $author ),
                htmlspecialchars( $user ),
                htmlspecialchars( $article_num ),
                htmlspecialchars( $num_likes),
                $content
        );
        echo '<br><b>See full story at: </b><a href="' . $website . '" target="_blank">' . $website . '</a>';
    }
    $stmt->close();
    echo "</ul>\n";

    ?>
   </div>
   
   <!--Science Section-->
   <div class="contentTitle">
      <h1>Science</h1>
   </div>
   <div class="contentText">
   <?php
    header("Content-type: text/html; charset=iso-8859-1");
    require 'connection.php';
    $stmt  = $mysqli -> prepare("SELECT title, author, user, article_num, website, content, num_likes FROM articles WHERE genre = 'Science'");
    if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }   
    $stmt->execute();
    $stmt -> bind_result($title, $author, $user, $article_num, $website, $content, $num_likes);
    $format = '<br><font size ="6">%s</font><br>Author: %s &nbsp Uploaded by: %s &nbsp Article number: %d  &nbsp Number of Likes: %d <br> <br>%s';
    echo "<ul>\n";
    while($stmt -> fetch()){
        printf($format,
                htmlspecialchars( $title ),
                htmlspecialchars( $author ),
                htmlspecialchars( $user ),
                htmlspecialchars( $article_num ),
                htmlspecialchars( $num_likes),
                $content
        );
        echo '<br><b>See full story at: </b><a href="' . $website . '" target="_blank">' . $website . '</a>';
    }
    $stmt->close();
    echo "</ul>\n";

    ?>

   </div>

   <div class="contentTitle">
    <h1>Miscellaneous</h1> 
   </div>

   <div class="contentText">
      <?php
      header("Content-type: text/html; charset=iso-8859-1");
    require 'connection.php';
    $stmt  = $mysqli -> prepare("SELECT title, author, user, article_num, website, content, genre, num_likes FROM articles WHERE genre NOT IN ('sports', 'business', 'Pop Culture', 'Science')");
    if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }   
    $stmt->execute();
    $stmt -> bind_result($title, $author, $user, $article_num, $website, $content, $genre, $num_likes);
    $format = '<br><font size ="6">%s</font><br>Author: %s &nbsp Uploaded by: %s &nbsp Article number: %d &nbsp Genre: %s <br> <br> %s';
    echo "<ul>\n";
    while($stmt -> fetch()){
        printf($format,
                htmlspecialchars( $title ),
                htmlspecialchars( $author ),
                htmlspecialchars( $user ),
                htmlspecialchars( $article_num ),
                htmlspecialchars($genre),
                $content
        );
        echo '<br><b>See full story at: </b><a href="' . $website . '" target="_blank">' . $website . '</a>';

    }
    echo "</ul>\n";

    $stmt->close();
    ?>
   </div>
</body>
</html>
