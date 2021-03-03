<?php

    namespace Source\Core;

    use PDO;
    use PDOException;

    class DBConnection
    {
        /** @var PDO $instance */
        private static $instance;

        private const OPTIONS = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE               => PDO::CASE_NATURAL
        ];

        final private function __construct()
        {
        }

        final private function __clone()
        {
        }

        /**
         * @return PDO
        */
        public static function getConnection(): PDO
        {
            if (is_null(self::$instance))
            {
                try
                {
                    self::$instance = new PDO(
                        'mysql:host=' . CONF_DB_HOST . ';dbname=' . CONF_DB_NAME,
                        CONF_DB_USER,
                        CONF_DB_PASSWORD,
                        self::OPTIONS
                    );
                }
                catch (PDOException $exception)
                {
                    die('<h1>( ! ) Configure os parâmetros do banco de dados</h1>');
                }
            }

            return self::$instance;
        }
    }