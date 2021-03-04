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

    use PDOException;

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

        protected function create(array $data): ?int
        {
            try {

                $columns = implode(', ', array_keys($data));
                $values = ':' . implode(', :', array_keys($data));

                $insert = 'INSERT INTO wappers (' . $columns . ') VALUES (' . $values . ')';

                $stmt = DBConnection::getConnection()->prepare($insert);

                $stmt->execute($data);

                return DBConnection::getConnection()->lastInsertId();
            }
            catch (PDOException $exception) {

                return null;
            }
        }
    }
