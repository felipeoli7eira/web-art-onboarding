<?php

    /**
     * @class Model
     * 
     * Super-classe de Modelo
     * 
     * @author Felipe Oliveira <felipe.oliveira@wapstore.com.br>
    */

    namespace Source\Models;

    use Source\Core\DBConnection;

    abstract class Model
    {
        /**
         * Monta uma query de SELECT e retorna o resultado da execução
         * @method select()
         * @param null|string $columns
         * @return array
        */
        protected function select(?string $columns = '*'): array
        {
            $select = DBConnection::getConnection()->query('SELECT ' . $columns . ' FROM wappers');

            $select->execute();

            return $select->fetchAll();
        }
    }
