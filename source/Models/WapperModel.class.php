<?php

    namespace Source\Models;

    class WapperModel extends Model
    {
        /**
         * @param null|string $columns
         * @return array
        */
        public function all(?string $columns = "*"): array
        {
            return $this->select($columns);
        }
    }