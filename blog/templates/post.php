<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet"/> 
    <title>Le blog de l'AVBN</title>
</head>
<body>
    <h1>Le super blog de l'AVBN</h1>
    <p><a href="index2.php">Retour à la liste des billets</a></p> 

    <div class="news">
        <h3><?= htmlspecialchars($post['title']) ?><em>le <?= htmlspecialchars($post['creation_date']) ?></em></h3> 
        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </p>
    </div>
    <h3>Commentaires</h3>
    
    <?php foreach ($comments as $comment) { ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <?php } ?>
</body>
</html>
