<?php
// Saves checking area GET variable each time a menu is drawn.
if  (isset($_GET['area'])) {
  if      ($_GET['area'] == 1) { $area = 1; }
  else if ($_GET['area'] == 2) { $area = 2; }
  else if ($_GET['area'] == 3) { $area = 3; }
} else                         { $area = 1; } // If not specified, deafult is 1

// Set the title colors
if	($area == 1) { $titleClass = 'ciso-title';     }
else if ($area == 2) { $titleClass = 'training-title'; }  // TODO: The name here is inconsistent with the areaClass
else if ($area == 3) { $titleClass = 'labs-title';     }

// Set the area class, to allow correct colors on the nav menu
if      ($area == 1) { $areaClass = 'ciso-area';    }
else if ($area == 2) { $areaClass = 'pentest-area'; }
else if ($area == 3) { $areaClass = 'labs-area';    }

// Set the title string, including correct colors
if      ($area == 1) { $title = '<span class="' . $titleClass . '">CISO</span>: Journey'; }
else if ($area == 2) { $title = '<span class="' . $titleClass . '">InfoSec</span>: Journey'; }
else if ($area == 3) { $title = '<span class="' . $titleClass . '">IJ</span>: Labs'; }

// The above pattern of rechecking $area each time is very slightly inefficient, but it's
// outweighed by the benefit of side-by-side comparisons for area variables

// A function to load the area names from the DB and draw a menu item for each one
function drawAreaMenu($mysqli) {
  $areaBarResult = $mysqli->query("SELECT id,title,slug FROM areas WHERE hidden = 0;");
  while($row = $areaBarResult->fetch_assoc()) {
    //$id    = intval($row['id']);           // id is INT in db, filtering is excessive but intval for paranoia
    $title = htmlspecialchars($row['title']);
    $slug = htmlspecialchars($row['slug']);
    // TODO: Store these link destintions in the DB like the subAreas?
    print '<li><a href="/area/' . $slug . '/">' . $title . '</a></li>';
  }
}

// A function to draw the sub-menu items for the currently selected area
function drawSubAreaMenu($mysqli, $area) {
  $subAreaBarResult = execPrepare($mysqli, "SELECT title,url FROM topnav WHERE area = ? AND hidden = 0;", array("i", $area));
  while($row = $subAreaBarResult->fetch_assoc()) {
    $subAreaTitle = htmlspecialchars($row['title']);
    $subAreaURL = 'https://cisojourney.com' . htmlspecialchars($row['url']); 	// Prefixing URL to prevent 2010:A10,
										// but this isn't the best place for this protection
    print '<li><a href="' . $subAreaURL . '">' . $subAreaTitle . '</a></li>';
  }
}
?>

<div class="title-bar">
  <div class="title"><?php print $title;?></div>
</div>
<div class="area-bar">
  <ul><?php drawAreaMenu($mysqli); ?></ul>
  <a href="/search.php"><i class="area-search fas fa-search"></i></a>
</div>
<div class="<?php print $areaClass; ?> nav-bar">
  <ul><?php drawSubAreaMenu($mysqli, $area); ?></ul>
</div>
