<?php

    /**
     * @class WapperModel
     * 
     * Modelo de wapper
     * 
     * @author Felipe Oliveira <felipe.oliveira@wapstore.com.br>
    */

    namespace Source\Models;

    class WapperModel extends Model
    {
        /**
         * Executa o método select da super-classe modelo chamando todos os registros
         * @method all()
         * @param null|string $columns
         * @return array
        */
        public function selectAll(): array
        {
            return $this->read('SELECT * FROM wappers')->fetchAll();
        }

        /**
         * @param array $data [valores para inserir na tabela]
         * @return null|int
         */
        public function insert(array $data): ?int
        {
            return $this->create($data);
        }

        public function destroy(int $id)
        {
            return $this->delete('id = :id', ['id' => $id]);
        }

        public function getByID($id, string $columns = '*')
        {
            return $this->read('SELECT ' . $columns . ' FROM wappers WHERE id = :id', [':id' => $id])->fetch();
        }

        public function edit(array $data)
        {
            return $this->update($data, (int) $data['id']);
        }
    }
