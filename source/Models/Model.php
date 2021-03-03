<?php

    namespace Source\Models;

    use Source\Core\DBConnection;

    abstract class Model
    {
        /**
         * @param null|string $columns
         * @return array
        */
        protected function select(?string $columns = "*"): array
        {
            $select = DBConnection::getConnection()->query("SELECT {$columns} FROM wappers");

            $select->execute();

            return $select->fetchAll();
        }
    }