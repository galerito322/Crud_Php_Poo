<?php

// SETS

use App\Model\Produto;
use App\Model\ProdutoDao;

require_once 'vendor/autoload.php';

$produtoDao = new ProdutoDao();
//$produtoDao->delete(8);
$a = $produtoDao->read();

//$produtoDao->update();

?>



