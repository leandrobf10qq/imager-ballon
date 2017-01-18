<?php
/*
*
*Desenvolvido por. Leandro (Whats: 61 9>84936862);
*
*/

function getimg($url) {
    $options = array(
        'http'=>array(
            'method'=> "GET",
            'header'=> "Accept-language: en\r\n" .
            'User-Agent: ' .$_SERVER['HTTP_USER_AGENT']. "\r\n"
        )
    );
    $context = stream_context_create($options);
    return file_get_contents($url, false, $context);
}

$font = 'Volter.ttf';
$fontB = 'Volterb.ttf';


if($_GET['mode'] == 1)
{
	$volter = imageftbbox(7, 0, $font, $_GET['text']);
	$volterb = imageftbbox(7, 0, $fontB, $_GET['habboname']);
	$x = abs($volter[0] - $volter[4]);
	$xb = abs($volterb[0] - $volterb[4]) + 8;
	$imagesize = $x + $xb + 40;
	$im = imagecreatetruecolor($imagesize, 24);
}
elseif($_GET['mode'] == 2)
{
	$volter = imageftbbox(7, 0, $fontB, $_GET['text']);
	$volterb = imageftbbox(7, 0, $fontB, $_GET['habboname']);
	$x = abs($volter[0] - $volter[4]);
	$xb = abs($volterb[0] - $volterb[4]) + 8;
	$imagesize = $x + $xb + 40;
	$im = imagecreatetruecolor($imagesize, 24);
}
elseif($_GET['mode'] == 3)
{
	$volter = imageftbbox(7, 0, $font, $_GET['text']);
	$volterb = imageftbbox(7, 0, $fontB, $_GET['habboname']);
	$x = abs($volter[0] - $volter[4]);
	$xb = abs($volterb[0] - $volterb[4]) + 8;
	$imagesize = $x + $xb + 40;
	$im = imagecreatetruecolor($imagesize, 24);
}
//Ocultar fundo
$purple = imagecolorallocate($im, 200, 0, 200);
imagefill($im, 0, 0, $purple);
imagecolortransparent($im, $purple);

//Topo
$top = imagecreatefrompng('balloon/t'. $_GET['balloon'] .'.png');
imagecopy($im, $top, 0, 0, 0, 0, 29, 24);


//Habbo
file_put_contents('temp/'.$_GET['habboname'].'.png', getimg('https://www.habbo'. $_GET['nat'] .'/habbo-imaging/avatarimage?&user='. $_GET['habboname'] .'&direction=3&img_format=png&gesture=sml&headonly=0&size=s'));

  $habbo = imagecreatefrompng('temp/'.$_GET['habboname'].'.png') ;
  imagecopy($im, $habbo, -2, -9, 0, 0, 33, 33) or die ('error');

# Fundo_Habbo
$patch = imagecreatefrompng('balloon/patch'. $_GET['balloon'] .'.png');
imagecopy($im, $patch, -2, -9, 0, 0, 33, 33);


# Meio
$mid = imagecreatefrompng('balloon/m'. $_GET['balloon'] .'.png');
for($i=29; $i < $imagesize-7; $i++)
{ 
	imagecopy($im, $mid, $i, 0, 0, 0, 1, 24);
}

# Final
$fin = imagecreatefrompng('balloon/b'. $_GET['balloon'] .'.png');
imagecopy($im, $fin, $imagesize-7, 0, 0, 0, 7, 24);

# Texto
if($_GET['mode'] == 1)
{
	$black = imagecolorallocate($im, 0, 0, 0);
	imagettftext($im, 7, 0, 32, 16, $black, $fontB, $_GET['habboname'] .':');
	imagettftext($im, 7, 0, 32 + $xb, 16, $black, $font, $_GET['text']);
}
elseif($_GET['mode'] == 2)
{
	$black = imagecolorallocate($im, 0, 0, 0);
	imagettftext($im, 7, 0, 32, 16, $black, $fontB, $_GET['habboname'] .':');
	imagettftext($im, 7, 0, 32 + $xb, 16, $black, $fontB, $_GET['text']);
}
elseif($_GET['mode'] == 3)
{
	$black = imagecolorallocate($im, 105, 105, 105);
	imagettftext($im, 7, 0, 32, 16, $black, $fontB, $_GET['habboname'] .':');
	imagettftext($im, 7, 0, 32 + $xb, 16, $black, $font, $_GET['text']);
}
	
header('Content-Type: image/png');

imagepng($im);

?>