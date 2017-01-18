<?php

/*
*
*Desenvolvido por. Leandro (Whats: 61 9>84936862);
*
*/

error_reporting(0);

$hotels = array(
                  ".com.br" => "Brasil",
                  ".com.au" => "Australia",
                  "UK" => "Reino Unido",
                  ".co.uk" => "Canadá",                  
                  ".com" => "Estados Unidos"
                 );

$text = array(
                  "1" => "Normal",                  
                  "2" => "Grito",
                  "3" => "Sussurro"
                 );

$balloons = array(
                  "1" => "Branco",                  
                  "2" => "Vermelho",
                  "3" => "Azul",
                  "4" => "Amarelo",
                  "5" => "Verde",
                  "6" => "Cinza",
                  "7" => "Curativo",
                  "8" => "Rustico"
                 );




if($_POST){

@$habboname = $_POST['habbo'];
@$hotel = $_POST['hotel'];
@$texto = $_POST['text'];
@$balloon =  (int) $_POST['balloon'];
@$acao =  (int) $_POST['acao'];

  if ($habboname == ''|| $hotel == '')
  {
    $result = "Ops, preencha todos os campos.";
  }
  
  elseif (!array_key_exists($hotel, $hotels))
  {
    $result = "Ops, hotel não reconhecido.";
  }  
  elseif (!array_key_exists($balloon, $balloons))
  {
    $result = "Ops, estilo do balão não reconhecido.";
  }
  elseif (!array_key_exists($acao, $text))
  {
    $result = "Ops, estilo do balão não reconhecido.";
  }


  else
  {
    $result = '<br><br><center><img src="generate.php?habboname='.$habboname.'&nat='.$hotel.'&text='.$texto.'&balloon='.$balloon.'&mode='.$acao.'" alt="'.$texto.'" /></center><br>';
  }


if (isset($result))
{
  echo $result."<br />\n";
}

}
?>
<center>
<form method="post">
  <label>Habbo:</label>
  <input name="habbo" type="text" placeholder="Malocopo" <?php if($_POST){ echo 'value="'.$_POST['habbo'].'"'; } ?> /><br />
  <label>Texto:</label>
  <input name="text"  type="text" <?php if($_POST){ echo 'value="'.$_POST['text'].'"'; } ?> /><br />
  <label>Hotel:</label>
  <select name="hotel">
<?php
foreach ($hotels as $key => $value)
{
	$select = 'selected';
  echo "      <option value=\"$key\" ".($key == $_POST['hotel'] ? $select : '')."  >$value</option>\n";
}
?>
    </select><br />
    <label>Estilo do Balão</label>
  <select name="balloon">
<?php
foreach ($balloons as $key => $value)
{
	$select = 'selected';
  echo "      <option value=\"$key\" ".($key == $_POST['balloon'] ? $select : '')."  >$value</option>\n";
}
?>
    </select><br />
    <label>Ação do Balão</label>
  <select name="acao">
<?php
foreach ($text as $key => $value)
{
	$select = 'selected';
  echo "      <option value=\"$key\" ".($key == $_POST['acao'] ? $select : '')."  >$value</option>\n";
}
?>
    </select><br />
    <input type="submit" name="render" value="Submit" />
</form>
</center>
