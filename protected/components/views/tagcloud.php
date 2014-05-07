<style type="text/css">
#tagcloud {
    display: inline-block;
    background:#CFE3FF;
    color:#0066FF;
    padding: 10px;
    border: 1px solid #559DFF;
    text-align:center;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
}

#tagcloud a:link, #tagcloud a:visited {
    text-decoration:none;
    color: #333;
}

#tagcloud a:hover {
    text-decoration: underline;
}

#tagcloud span {
    padding: 4px;
}

#tagcloud .smallest {
    font-size: x-small;
}

#tagcloud .small {
    font-size: small;
}

#tagcloud .medium {
    font-size:medium;
}

#tagcloud .large {
    font-size:large;
}

#tagcloud .largest {
    font-size:larger;
}
</style>
<?php
$maximum=1;
$minimum=1;
$terms=array();
$total_tag=count($model);
define('TAG_MIN_FONT_EM', 1);
define('TAG_MAX_FONT_EM', 4);
foreach($model as $row)
{
    $term = $row->term;
    $counter = $row->counter;
    // update $maximum if this term is more popular than the previous terms
    if ($counter > $maximum) $maximum = $counter;
    if ($counter < $minimum) $minimum = $counter;
    $terms[] = array('term' => $term, 'counter' => $counter);
}
// shuffle terms unless you want to retain the order of highest to lowest
shuffle($terms);
?>
<div class="categories">
    <h5>Tags</h5>
    <div id="tagcloud">
    <?php
foreach ($terms as $term){
$size = ($term['counter'] /$maximum ) * (TAG_MAX_FONT_EM - TAG_MIN_FONT_EM) + TAG_MIN_FONT_EM;
?>
<span>
  <a href="<?php echo Yii::app()->createAbsoluteUrl("medialist/search",array("tag"=>$term['term'])); ?>" style="font-size:<?php echo $size."em"; ?>;">
  <?php echo $term['term']; ?></a>
</span>
<?php }; ?>
</div>
</div>