<?php 
/**
 * 
 * Crud para todos os ficheiros que precisarem executar as operações 
 * na base de dados
 * 
 * @author Dev.Elliot
 *  
 */
require_once __DIR__ . '/db.php';




function insert($sql, $data) {
    global $conexao;

    $stmt = $conexao->prepare($sql);
    $stmt->execute($data);

    return $stmt->rowCount();
}


/**
 * Ler os dados de um unico usuario.
 * 
 * @param string $sql 
 * consulta da busca a ser feita com named parameters
 * 
 * @param array $id  
 * id para filtrar a consulta e named param
 * 
 *@return mixed || false $array 
 * retorna os dados de uma linha correspondente ao id falso na falha
 */
function readOne($sql, $id) {
    global $conexao;

    $stmt = $conexao->prepare($sql);
    $stmt->execute($id);

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function readAll($sql, $data) {
    global $conexao;

    $stmt = $conexao->prepare($sql);
    $stmt->execute($data);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function countRow($sql, $data) {
    global $conexao;

    $stmt = $conexao->prepare($sql);
    $stmt->execute($data);

    return $stmt->rowCount();
}

function delete($id) {

}

function update($id) {}

function changeUserState($sql, $data) {
    global $conexao;

    $stmt = $conexao->prepare($sql);
    $stmt->execute($data);

    return $stmt->rowCount();
}



