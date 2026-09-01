<?php

class Env {
    public static function carregar($caminhoArquivo) {
        if (!file_exists($caminhoArquivo)) {
            throw new Exception("Arquivo .env não encontrado.");
        }

        
        $linhas = file($caminhoArquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($linhas as $linha) {
            
            if (strpos(trim($linha), '#') === 0) {
                continue;
            }

            list($nome, $valor) = explode('=', $linha, 2);

            $nome = trim($nome);
            $valor = trim($valor);

           
            if (!array_key_exists($nome, $_SERVER) && !array_key_exists($nome, $_ENV)) {
                putenv(sprintf('%s=%s', $nome, $valor));
                $_ENV[$nome] = $valor;
                $_SERVER[$nome] = $valor;
            }
        }
    }
}
?>