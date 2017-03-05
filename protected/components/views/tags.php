


<ul>
    <?php
    $comments = $this->getAll();

    foreach($comments as $comment)
    {
        echo "<li><a href='" . Yii::app()->request->baseUrl . "/search?for=$comment->tag'> {$comment->tag}</a></li>";
    }
    ?>
</ul>