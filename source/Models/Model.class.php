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
    use PDOStatement;

    abstract class Model
    {
        /**
         * Monta uma query de SELECT e retorna o resultado da execução
         * @method select()
         * @param null|string $columns
         * @return array
        */
        protected function read(string $queryForExec, ?array $linksAndValues = null): PDOStatement
        {
            $select = DBConnection::getConnection()->prepare($queryForExec);

            if ( !is_null($linksAndValues))
            {
                foreach ($linksAndValues as $link => $value)
                {
                    $bindType = is_string($value) ? \PDO::PARAM_STR : \PDO::PARAM_INT;
                    $select->bindValue($link, $value, $bindType);
                }
            }

            $select->execute();

            return $select;
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

        protected function delete(string $condition, array $conditionParams): ?int
        {
            try {

                $stmt = DBConnection::getConnection()->prepare('DELETE FROM wappers WHERE ' . $condition);
                $stmt->execute($conditionParams);

                return $stmt->rowCount() ?? 1;
            }
            catch (PDOException $exception) {
                return null;
            }
        }

        protected function update(array $data, int $id): ?int
        {
            try {

                if (array_key_exists('id', $data)) {

                    unset($data['id']);
                }

                $links = [];

                foreach ($data as $indexName => $indexValue) {
                    $links[] = "{$indexName} = :{$indexName}";
                }

                $strLinks = implode(', ', $links);
                $updateQueryString = 'UPDATE wappers SET ' . $strLinks . ' WHERE id = :id' ;

                $stmt = DBConnection::getConnection()->prepare($updateQueryString);
                $stmt->execute(
                    array_merge($data, ['id' => $id])
                );

                return $stmt->rowCount() ?? 1;
            }
            catch (PDOException $exception) {

                return null;
            }
        }
    }
