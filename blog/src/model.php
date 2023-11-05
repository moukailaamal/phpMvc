<?php
function connectDb(){
    $host = 'localhost'; // Adresse de l'hôte de la base de données
    $dbname = 'blog'; // Nom de la base de données
    $user = 'root'; // Nom d'utilisateur
    $pass = ''; // Mot de passe
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        // Configure PDO pour qu'il génère des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo; // Retourne la connexion PDO
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
// recupere les donnees de table billets
function getPosts(){
    $database = connectDb();
    $statement = $database->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss')
     AS formatted_date FROM billets");
    $posts = array();
    
    while ($row = $statement->fetch()) {
        $post = array(
            'identifier' => $row['id'],
            'title' => $row['title'],
            'content' => $row['content'],
            'creation_date' => $row['formatted_date'], // Utilisez la date formatée
        );
        $posts[] = $post; // Ajoutez chaque article à un tableau
    }
    
    return $posts;
}
// requpere les donnees de table posts qui ayant id passe au parametre 
function getPost($identifier) {
    $database = connectDb();
    // Utilisez une requête préparée pour éviter les injections SQL
    $statement = $database->prepare
    ("SELECT id, title, content, 
    DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS formatted_date FROM posts WHERE id = ?");
    // Exécutez la requête préparée avec le paramètre
    $statement->execute([$identifier]);
    // Utilisez fetch() pour obtenir une seule ligne de résultat
    $row = $statement->fetch();
    $posts = [
        'identifier' => $row['id'],
        'title' => $row['title'],
        'content' => $row['content'],
        'creation_date' => $row['formatted_date'],
        ];
    
    return $posts;
}
// requpere les donnees de table comment qui ayant id passe au parametre 
function getComment(string $identifier) {
    $database = connectDb();
    // Utilisez une requête préparée pour éviter les injections SQL
    $statement = $database->prepare(
    	"SELECT id,post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date FROM comments
         WHERE post_id = ? ORDER BY comment_date DESC"
	);
	$statement->execute([$identifier]);
    $comments = [];
    while ($row = $statement->fetch()) {
        $comment = [
            'identifier' => $row['id'],
            'post_id' => $row['post_id'],
            'author' => $row['author'],
            'comment' => $row['comment'],
            'comment_date' => $row['comment_date'],
        ];
        $comments[] = $comment;
    }    
    return $comments;
}






