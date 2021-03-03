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
        public function all(?string $columns = '*'): array
        {
            return $this->select($columns);
        }
    }
