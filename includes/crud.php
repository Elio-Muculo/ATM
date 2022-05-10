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
function readAll($sql, $data) {
    global $conexao;

    $stmt = $conexao->prepare($sql);
    $stmt->execute($data);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
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
function countRow($sql, $data) {
    global $conexao;

    $stmt = $conexao->prepare($sql);
    $stmt->execute($data);

    return $stmt->rowCount();
}

function delete($id) {

}

function update($id) {}


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
function changeUserState($sql, $data) {
    global $conexao;

    $stmt = $conexao->prepare($sql);
    $stmt->execute($data);

    return $stmt->rowCount();
}



/**
 * Inserir todoa dados
 * 
 * @param string $sql 
 * query a ser feita executada
 * 
 * @param mixed $dados
 * dados a serem inseridos.
 * 
 *@return int 
 * retorna 1 no caso de sucesso e 0 caso contrario.
 */
function insertAll($sql, $dados) {
    global $conexao;

    $stmt = $conexao->prepare($sql);

    $stmt->execute($dados);

    return $stmt->rowCount();
}

