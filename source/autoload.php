<?php

    require __DIR__ . '/boot/conf.php';
    require __DIR__ . '/boot/triggers.php';

    spl_autoload_register(
        function (string $class): void
        {
            $baseDirectory = __DIR__ . '/';

            $vendorPrefix = 'Source\\';

            $vendorLength = mb_strlen($vendorPrefix);

            /**
             * [ https://www.php.net/manual/pt_BR/function.strncmp.php ]
             * 
             * Comparação de string segura para binário para os primeiros n caracteres:
             * strncmp($str1, $str2, $tamanho)
             * 
             * Retorna um número menor que zero caso $str1 seja menor que $str2
             * Retorna um número maior que zero caso $str1 seja maior que $str2
             * Retorna zero caso $str1 e $str2 sejam iguais
            */

            /*    classe instânciada | prefixo do fornecedor | tamanho do nome do fornecedor */
            if (strncmp($class, $vendorPrefix, $vendorLength) != 0)
            {
                /* Se não estiver sendo chamado uma classe do fornecedor definido na $vendorPrefix */
                return;
            }

            $cutPrefix = substr($class, $vendorLength); // remove o prefixo Source\ da clase chamada

            $classFile = $baseDirectory . str_replace('\\', DIRECTORY_SEPARATOR, $cutPrefix) . '.php';

            if (file_exists($classFile) && is_file($classFile))
            {
                require $classFile;
            }
        }
    );