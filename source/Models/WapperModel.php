<?php

    namespace Source\Models;

    class WapperModel extends Model
    {
        public function all(?string $columns = "*")
        {
            return $this->select($columns);
        }
    }