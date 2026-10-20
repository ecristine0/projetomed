<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";


echo "<h1>Buscar Idoso por nome</h1>";

echo "<form method='GET'>";
echo "<input type='text' name='cuidado_nome' placeholder='Digite o nome'>";
echo "<button type='submit'>Pesquisar</button>";
echo "</form>";

if (isset($_GET['cuidado_nome'])) {
    $idoso = buscaridosopornome($conexao, $_GET['cuidado_nome']);

    while($idosos = $idoso->fetch_assoc()){
        print_r($idosos);
        echo "<br>";
    }
}

echo "<h2>Listar Idoso</h2>";

if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    echo "<p>Idoso atualizado com sucesso!</p>";
}

$idoso = listarIdoso($conexao);

while($id = $idoso->fetch_assoc()){

    if (!empty($id['foto'])) {
        echo "<img src='" . $id['foto'] . "' width='100' alt='Capa'><br>";
    } else {
        echo "<em>[Sem imagem]</em><br>";
    }

    print_r($id);
    echo "<hr>";
}

echo "<button>";
echo "<a href='cuidadoatualizar.php'>Atualizar Idoso</a>";
echo "</button>";

echo "<button>";
echo "<a href='deletarcuidado.php'>Deletar Idoso</a>";
echo "</button>";

require_once "rodape.php";


//fazer os cards com foto as informações do idoso e um botão para atualizar as informações do idoso e deletar o idoso, e um botão para cadastrar um novo idoso, e um botão para voltar para a página inicial
?>
