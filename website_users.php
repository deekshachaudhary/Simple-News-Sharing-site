<html>
<title>Website</title>
<head>
<META http-equiv="Content-type" content="text/html; charset=iso-8859-1">
</head>
<body>
   <div id="page">
   <div id="header">
      <h1>The News</h1>
      <h2>Browse your daily news below!</h2>
   </div>

   <!-- create edit buttons -->
   <form action = "logout.php" method = 'POST'>
      <input type = "submit" value = "Logout" name = "logout">
   </form> 
   
   <form action = "subscribe.php" method = 'POST'>
      <label> Stay updated with the hottest articles! </label>
      <input name="email" placeholder="Enter your email" required="" type="text">
      <input type = "submit" value = "Subscribe">
   </form>
   <form action = "favorites.php" method = 'POST'>
      <label> View your favorites! </label>
      <input type = "submit" value = "GO!">
   </form>


   <fieldset>
   <form action="view_comments.php" method='POST'>
         <label> View Comments for Article: </label>
         <input name="article_num" placeholder="Enter the article number" required="" type="text">
         <input type = "submit" value = "View Comments">
   </form>
   
   <form action="edit_story.php" method='POST'>
         <label> Edit an Article: </label>
         <input name="article_num" placeholder="Enter the article number" required="" type="text">
         <input type = "submit" value = "Edit Article">
   </form>

   <form action="delete_story.php" method='POST'>
         <label> Delete an Article: </label>
         <input name="article_num" placeholder="Enter the article number" required="" type="text">
         <input type = "submit" value = "Delete Article">
   </form>

   <form action="post_comment.html" method='POST'>
         <input type = "submit" value = "Post A Comment" name = "post_comment">
   </form>
   <form action="post_story.html" method='POST'>
         <input type = "submit" value = "Post An Article" name = "post_article">
   </form>
   </fieldset>

   <form action="hottest.php" method='POST'>
         <label><h2> View The Hottest Articles!</h2> </label>
         <input type = "submit" value = "Hottest!">
   </form>



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
        echo '<br><form action = "update_likes.php" method = "POST">  <input type="hidden" name="article_num" value=" ' . $article_num . '">  <input type = "submit" value = "Like" name = "like"> <input type = "submit" value = "Unlike" name = "unlike"> </form>';
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
        echo '<br><form action = "update_likes.php" method = "POST">  <input type="hidden" name="article_num" value=" ' . $article_num . '">  <input type = "submit" value = "Like" name = "like"> <input type = "submit" value = "Unlike" name = "unlike"> </form>';
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
        echo '<br><form action = "update_likes.php" method = "POST">  <input type="hidden" name="article_num" value=" ' . $article_num . '">  <input type = "submit" value = "Like" name = "like"> <input type = "submit" value = "Unlike" name = "unlike"> </form>';
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
        echo '<br><form action = "update_likes.php" method = "POST">  <input type="hidden" name="article_num" value=" ' . $article_num . '">  <input type = "submit" value = "Like" name = "like"> <input type = "submit" value = "Unlike" name = "unlike"> </form>';
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
    $format = '<br><font size ="6">%s</font><br>Author: %s &nbsp Uploaded by: %s &nbsp Article number: %d &nbsp Genre: %s &nbsp Number of Likes: %d <br> <br> %s ';
    echo "<ul>\n";
    while($stmt -> fetch()){
        printf($format,
                htmlspecialchars( $title ),
                htmlspecialchars( $author ),
                htmlspecialchars( $user ),
                htmlspecialchars( $article_num ),
                htmlspecialchars($genre),
                htmlspecialchars( $num_likes),
                $content
        );
        echo '<br><b>See full story at: </b><a href="' . $website . '" target="_blank">' . $website . '</a>';
        echo '<br><form action = "update_likes.php" method = "POST">  <input type="hidden" name="article_num" value=" ' . $article_num . '">  <input type = "submit" value = "Like" name = "like"> <input type = "submit" value = "Unlike" name = "unlike"> </form>';

    }
    echo "</ul>\n";

    $stmt->close();
    ?>
   </div>

   <form action = "delete_account.php" method = 'POST'>
      <input type = "submit" value = "Delete Account" name = "delete_account">
   </form>
</body>
</html>
