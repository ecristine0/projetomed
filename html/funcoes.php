<?php
require_once "conexao.php";

//login
function verificarLogin()
    {
        if (!isset($_SESSION['pessoa'])) {
            header("Location: login.php");
            exit;
        }
    }

    function logout()
    {

        session_destroy();

        header("Location: login.php");
        exit;
    }

    function login($conexao, $email, $senha)
    {
        $sql = "SELECT * FROM banco.pessoa 
                WHERE pessoa_email = ? AND pessoa_senha = ?";

        $stmt = $conexao->prepare($sql);

        if (!$stmt) {
            return "erro";
        }

        $stmt->bind_param("ss", $email, $senha);

        if (!$stmt->execute()) {
            return "erro";
        }

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {

            $pessoa = $resultado->fetch_assoc();

            $_SESSION['pessoa'] = $pessoa['pessoa_nome'];
            $_SESSION['id'] = $pessoa['pessoa_id'];
            $_SESSION['tipo'] = $pessoa['pessoa_tipo'];

            return true;
        }

        return false;
    }


//pessoa
function inserirpessoa($conexao, $nome, $email, $senha, $tipo, $data_nascimento, $peso, $altura)
{
    $sql = "INSERT INTO banco.pessoa 
            (pessoa_nome, pessoa_email, pessoa_senha, pessoa_tipo, pessoa_data_nascimento, pessoa_peso, pessoa_altura) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("sssssdd", $nome, $email, $senha, $tipo, $data_nascimento, $peso, $altura);

    return $stmt->execute();
}






//medicamento
function listarmedicamento($conexao)
{
    return $conexao->query("SELECT * FROM banco.medicamento");
}

function inserirmedicamento($conexao, $nome, $laboratorio, $categoria, $observacao, $arquivoImagem)
{
    $sql = "INSERT INTO banco.medicamento (medicamento_nome, medicamento_laboratorio, medicamento_categoria, medicamento_observacao, arquivoImagem) values (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssss", $nome, $laboratorio, $categoria, $observacao, $arquivoImagem);
    return $stmt->execute();
}

function buscarmedicamentoid($conexao, $id)
{
$sql = "SELECT * FROM banco.medicamento WHERE medicamento_id=?";
$stmt = $conexao->prepare($sql);
 $stmt->bind_param("i", $id);
$stmt->execute();

    return $stmt->get_result();
}


function buscarmedicamentopornome($conexao, $nome)
{
    $sql = "SELECT * FROM banco.medicamento where medicamento_nome LIKE ?";
    $stmt = $conexao->prepare($sql);
    $nomebusca = "%" . $nome . "%";
    $stmt->bind_param("s", $nomebusca);
    $stmt->execute();

    return $stmt->get_result();
}

function atualizarmedicamento($conexao, $id, $nome, $laboratorio, $categoria, $observacao, $foto)
{
    $sql = "UPDATE banco.medicamento SET medicamento_nome = ?, medicamento_laboratorio = ?, medicamento_categoria = ?, medicamento_observacao = ?, medicamento_foto = ? WHERE medicamento_id = ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssi", $nome, $laboratorio, $categoria, $observacao, $foto, $id);

    return $stmt->execute();
}

function deletarmedicamento($conexao, $id)
{
    $sql = "DELETE FROM banco.medicamento WHERE medicamento_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    return $stmt->execute();
}


//idoso
function cadastraridoso($conexao, $nome, $email, $senha, $tipo, $data_nascimento, $peso, $altura, $foto)
{

    if ($data_nascimento > '1966-08-06') {
        return false;
    }

    $sql = "INSERT INTO banco.pessoa
            (pessoa_nome, pessoa_email, pessoa_senha, pessoa_tipo,
             pessoa_data_nascimento, pessoa_peso, pessoa_altura, pessoa_foto)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssdds", $nome, $email, $senha, $tipo, $data_nascimento, $peso, $altura, $foto);

    return $stmt->execute();
}

function listaridoso($conexao)
{
    return $conexao->query("SELECT * FROM banco.cuidado");
}
function buscaridoso($conexao, $id)
{
    $sql = "SELECT * FROM banco.cuidado WHERE cuidado_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function buscaridosopornome($conexao, $nome)
{
    $sql = "SELECT * FROM banco.cuidado where cuidado_nome LIKE ?";
    $stmt = $conexao->prepare($sql);
    $nomebusca = "%" . $nome . "%";
    $stmt->bind_param("s", $nomebusca);
    $stmt->execute();

    return $stmt->get_result();
}


function atualizaridoso($conexao, $id, $nome, $data_nas, $foto)
{
    $sql = "UPDATE banco.cuidado SET cuidado_nome = ?, cuidado_data_nas = ?, cuidado_foto = ? WHERE cuidado_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssi", $nome, $data_nas, $foto, $id);
    $stmt->execute();

    return $stmt->execute();
}


function deletaridoso($conexao, $id)
{
    $sql = "DELETE FROM prescricao WHERE cuidado_cuidado_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $sql = "DELETE FROM cuidado WHERE cuidado_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    return $stmt->execute();
}



//prescrição

function atualizaprescricao($conexao, $medicamento_id, $cuidado_id, $pessoa_id, $cuidador, $frequencia, $dosagem, $horario_primeira_dose, $data_inicio, $observacao) {
$sql = "UPDATE banco.prescricao SET prescricao_frequencia = ?, prescricao_dosagem = ?, prescricao_horario_primeira_dose = ?, prescricao_data_inicio = ?, prescricao_observacao = ? WHERE medicamento_medicamento_id = ? AND cuidado_cuidado_id = ? AND cuidado_fk_pessoa_pessoa_id = ? AND cuidado_fk_pessoa_cuidador = ?";
    $stmt = $conexao->prepare($sql);
$stmt->bind_param("sdsssiiii",$frequencia, $dosagem, $horario_primeira_dose, $data_inicio, $observacao, $medicamento_id, $cuidado_id, $pessoa_id, $cuidador );
    return $stmt->execute();
}


function deletarprescricao($conexao, $medicamento_id, $cuidado_id, $pessoa_id, $cuidador) {
    $sql = "DELETE FROM banco.prescricao WHERE medicamento_medicamento_id = ? AND cuidado_cuidado_id = ? AND cuidado_fk_pessoa_pessoa_id = ? AND cuidado_fk_pessoa_cuidador = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iiii", $medicamento_id, $cuidado_id, $pessoa_id, $cuidador);
    return $stmt->execute();
}


function listarprescricao($conexao, $pessoa_id, $cuidador ) {
    $sql = "SELECT medicamento_medicamento_id, cuidado_fk_pessoa_cuidador, prescricao_frequencia, prescricao_dosagem, prescricao_horario_primeira_dose, prescricao_data_inicio, prescricao_observacao FROM banco.prescricao WHERE cuidado_fk_pessoa_pessoa_id= ?, cuidado_cuidado_id = ?";  
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iiii", $pessoa_id, $cuidador);
    return $stmt->execute();
}

function adicionarprescricao($conexao, $medicamento_id, $cuidado_id, $pessoa_id, $cuidador, $frequencia, $dosagem, $horario_primeira_dose, $data_inicio, $observacao){
    $sql = "INSERT INTO banco.prescricao (medicamento_medicamento_id, cuidado_cuidado_id, cuidado_fk_pessoa_pessoa_id, cuidado_fk_pessoa_cuidador, prescricao_frequencia, prescricao_dosagem, prescricao_horario_primeira_dose, prescricao_data_inicio, prescricao_observacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iiiidisss", $medicamento_id, $cuidado_id, $pessoa_id, $cuidador, $frequencia, $dosagem, $horario_primeira_dose, $data_inicio, $observacao);
    return $stmt->execute();
}

function marcarprescricao($conexao, $medicamento_id, $cuidado_id, $pessoa_id, $cuidador, $tomou){
    $sql = "UPDATE banco.prescricao SET prescricao_tomada = ? WHERE medicamento_medicamento_id = ? AND cuidado_cuidado_id = ? AND cuidado_fk_pessoa_pessoa_id = ? AND cuidado_fk_pessoa_cuidador = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iiiii", $tomou, $medicamento_id, $cuidado_id, $pessoa_id, $cuidador);
    return $stmt->execute();
}