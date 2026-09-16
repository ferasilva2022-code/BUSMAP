<?php
// Recebe os dados JSON enviados pelo JavaScript
$json = file_get_contents('php://input');
$dados = json_decode($json, true);

header('Content-Type: application/json');
 
if ($dados && !empty(trim($dados['nomeLinha'] ?? '')) && 
    !empty(trim($dados['codigoLinha'] ?? ''))
)  {
    $nome = trim($dados['nomeLinha']);
    $codigo = trim($dados['codigoLinha']);
    $status = $dados['statusLinha'] ?? 'Inativa';
    $idGerado = time(); 

    // Resposta de sucesso (Status 200 OK) :D
    http_response_code(200);
    echo json_encode([
        'ok' => true,
        'id' => $idGerado,
        'mensagem' => 'Linha cadastrada com sucesso!',
        'dadosRecebidos' => [
            'nome' => $nome,
            'codigo' => $codigo,
            'status' => $status
        ]
    ]);
    
} else {
    // Resposta de erro se faltar algum campo
    http_response_code(422);
    echo json_encode([
        'ok' => false,
        'mensagem' => 'Preencha o nome e o código da linha corretamente.'
    ]);
}
?>