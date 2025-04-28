<?php

/* CLASSE DE CONEXÃO COM O BANCO DE DADOS */

abstract class Conexao {

    private static $conexao;

    static function conectar() {

        try {
            if (!isset(self::$conexao)) :
                self::$conexao = new pdo("mysql:host=162.241.3.24;dbname=gtamulti_padre_victor", "gtamulti_cafep", "pN*(]HyvZWh#");
                self::$conexao->exec("set names utf8");
                self::$conexao->exec("SET character_set_connection=utf8");
                self::$conexao->exec("SET character_set_client=utf8");
                self::$conexao->exec("SET character_set_results=utf8");
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            endif;
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco" . $e->getMessage();
        }
        return self::$conexao;
    }

    public static function getDB() {
        return self::conectar();
    }

}

?>