<?php
    header('Content-Type: text/javascript');

    $post_id = $_REQUEST['post_id'];
    $author = $_REQUEST['author'];
    $content = $_REQUEST['content'];
    $date = date('Y-m-d H:i:s');
    
    $authorDecoded = urldecode($author);
    $contentDecoded = urldecode($content);
	
    $pdo = new PDO("mysql:dbname=labdb;host=127.0.0.1", 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->query("INSERT INTO `comments`(`post_id`, `author`, `content`, `created_at`, `updated_at`)
        VALUES('$post_id', '$authorDecoded', '$contentDecoded', '$date', '$date')");
    $pdo = null;

    echo 'commentView(decodeXml("<comment>'
            . '<author>' . $author . '</author>'
            . '<content>' . $content . '</content>'
            . '<date>' . $date . '</date>' 
        . '</comment>"));';