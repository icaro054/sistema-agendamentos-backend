<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}


require_once './controllers/AgendamentoController.php';


$dadosBrutos = file_get_contents("php://input");
$dados = json_decode($dadosBrutos);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $dados) {
    
   
    $controller = new AgendamentoController();
    
   
    $resposta = $controller->criarAgendamento($dados);
    
    
    echo $resposta;
    
} else {
    
    http_response_code(405); 
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Acesso negado. Rota exclusiva para envio de dados (POST)."
    ]);
}
?>