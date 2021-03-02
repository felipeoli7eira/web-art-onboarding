<?php

    namespace Source\Models;

    use Source\Core\DBConnection;

    abstract class Model
    {
        protected function select(?string $columns = "*")
        {
            $select = DBConnection::getConnection()->query("SELECT {$columns} FROM wappers");

            $select->execute();

            return $select->fetchAll();
        }
    }