<!--post.php-->
<?php
require_once('src/model.php');
// verifier que id passe au url
if(isset($_GET['id'])&& $_GET['id']>0){
    $identifier=$_GET['id'];

}else{
    die('la page n\'existe pas');
}
$post=getPost($identifier);
$comments=getComment($identifier);
require_once('templates/post.php');