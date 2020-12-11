<?php

$quotesContent = $connection->prepare("SELECT * FROM quotes_content ORDER BY quotes_content_id DESC");
$quotesContent->execute();
$quotes = $quotesContent->fetchAll(PDO::FETCH_OBJ);

?>