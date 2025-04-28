<?php

/* CLASSE DE CONEXÃO COM O BANCO DE DADOS */

abstract class Conexao {

    private static $conexao;

    static function conectar() {

        try {
            if (!isset(self::$conexao)) :
                self::$conexao = new pdo("mysql:host=cafe_padre_vic.mysql.dbaas.com.br;dbname=cafe_padre_vic", "cafe_padre_vic", "m9RSYh8khdp6P2");
                //self::$conexao = new pdo("mysql:host=107.191.38.15;dbname=alfaexpr_site2018", "alfaexpr_site201", "Ygg4!oC#");
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