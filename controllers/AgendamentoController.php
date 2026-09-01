<?php
class AgendamentoController {
    
    public function criarAgendamento($dados) {
        // 1. Validação de segurança básica (Clean Code)
        if (empty($dados->nomePaciente) || empty($dados->telefone)) {
            http_response_code(400);
            return json_encode([
                "status" => "erro",
                "mensagem" => "Nome e telefone são obrigatórios."
            ]);
        }

        // 2. Aplicando o Regex no Back-end (Segurança)
        // Remove absolutamente tudo que não for dígito do telefone enviado
        $telefoneLimpo = preg_replace('/\D/', '', $dados->telefone);

        if (strlen($telefoneLimpo) < 10) {
            http_response_code(400);
            return json_encode([
                "status" => "erro",
                "mensagem" => "Formato de telefone inválido."
            ]);
        }

        // 3. Simulação de salvamento no banco (Mock)
        // Quando o professor liberar a API do banco, você chamará o Model aqui
        
        http_response_code(201);
        return json_encode([
            "status" => "sucesso",
            "mensagem" => "Agendamento para " . $dados->nomePaciente . " processado!",
            "telefone_tratado" => $telefoneLimpo
        ]);
    }
}
?>