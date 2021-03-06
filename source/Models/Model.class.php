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
         * Monta uma query de SELECT e retorna um PDOStatement
         * @method read()
         * @param null|string $columns
         * @param null|string $condition
         * @param null|array $conditionValues
         * @return PDOStatement
        */
        protected function read(?string $columns = '*', ?string $condition = null, ?array $conditionValues = null): PDOStatement
        {
            $query = 'SELECT ' . $columns . ' FROM wappers';

            if (!is_null($condition))
            {
                $query .= " {$condition}";
            }

            $select = DBConnection::getConnection()->prepare($query);

            if ( !is_null($conditionValues))
            {
                foreach ($conditionValues as $link => $value)
                {
                    $bindType = is_string($value) ? \PDO::PARAM_STR : \PDO::PARAM_INT;
                    $select->bindValue(':' . $link, $value, $bindType);
                }
            }

            $select->execute();

            return $select;
        }

        /**
         * Monta uma query de INSERT e retorna o id do registro inserido
         * @method create()
         * @param array $data
         * @return null|int
        */
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

        /**
         * Monta uma query de DELETE e retorna a quantidade de linhas deletadas ou 1 (operação feita)
         * @method delete()
         * @param string $condition
         * @param array $conditionParams
         * @return null|int
        */
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

        /**
         * Monta uma query de UPDATE e retorna a quantidade de linhas atualizadas ou 1 (operação feita)
         * @method update()
         * @param array $data
         * @param int $id
         * @return null|int
        */
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
