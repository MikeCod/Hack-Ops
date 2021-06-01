<?php
function button($text, $a, $href = false, $width = 200, $color = "white")
{
   $text = str_replace(' ', '<span style="color:transparent">_</span>', $text);
   if ($color != "white")
      $color .= ";text-shadow:unset";
   echo '
   <div class="svg-wrapper">
      <svg height="40" width="'.$width.'">
         <rect class="shape" height="40" width="'.$width.'" />
         <div class="text">
            <a style="color:'.$color.';'.(!$href ? 'cursor:pointer;" onclick' : '" href').'="'.$a.'"><span class="spot"></span>'.$text.'</a>
         </div>
      </svg>
   </div>';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?= NAME ?></title>
		<link rel="icon" type="image/jpg" href="">
		<link rel="stylesheet" media="all" type="text/css" href="../include/css/style.css">
        <link rel="stylesheet" media="all" type="text/css" href="../include/css/button.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	</head>
	<body>
        <div id="banner" style="float:left;">
            <div style="padding-left:10%; padding-right:10%; padding-top:10px; height:50px; background:linear-gradient(#101010 90%, #2a2a2a 95%); font-size:24pt;">
                <?= NAME ?> <img src="../logo.jpg" width="40" height="40">
            </div>
        </div>
        <?php button("Dashboard", "../View/dashboard.php", true); ?>
    	<h1 style="padding-left:500px;">Categories</h1>
    	<?php
    		while($c = $categories->fetch()) {
    			$subcat->execute(array($c['id']));
    			$subcategories = '';
    			while($sc = $subcat->fetch()) {
    				$subcategories .= '<a href="./forum-topic.php?cats='.url_custom_encode($c['name']).'&subcats='.url_custom_encode($sc['name']).'">'.$sc['name'].'</a><br>';
    			}
    			$subcategories = substr($subcategories, 0, -2);
    		?>
            <div class="section" style="margin-left:200px; margin-top:20px;">
        		<h2 style="padding-left:20px;"><?= $c['name'] ?></h2>
        		<p style="padding-left:50px;"><?= $subcategories ?></p>
            </div>
    	<?php } ?>
    	
	</body>
</html>