<?php

    /**
     * @class WapperModel
     * 
     * Modelo de wapper
     * 
     * @author Felipe Oliveira
    */

    namespace Source\Models;

    class WapperModel extends Model
    {
        /**
         * Executa o read da super-classe modelo buscando todos os registros
         * @method selectAll()
         * @return array
        */
        public function selectAll(): array
        {
            return $this->read()->fetchAll();
        }

        /**
         * Executa o create da super-classe modelo inserindo um registro
         * @method insert()
         * @param array $data [valores para inserir na tabela]
         * @return null|int
         */
        public function insert(array $data): ?int
        {
            return $this->create($data);
        }

        /**
         * Executa o delete da super-classe modelo deletando um wapper
         * @method destroy()
         * @param int $id
         * @return int
         */
        public function destroy(int $id): int
        {
            return $this->delete('id = :id', ['id' => $id]);
        }

        /**
         * Executa o read da super-classe modelo trazendo apenas o registro com id passado
         * @method getByID()
         * @param int $id
         * @return null|object
         */
        public function getByID($id): ?object
        {
            return $this->read('*', 'WHERE id = :id', ['id' => $id])->fetch();
        }

        /**
         * Executa o update da super-classe modelo atualizando um registro
         * @method edit()
         * @param array $data
         * @return null|int
         */
        public function edit(array $data): ?int
        {
            return $this->update($data, (int) $data['id']);
        }
    }
