<?php

class Google
{
        /*
         * Commentary in Brazilian Portuguese
         * valor da página atual no indice do array com todas as páginas e valor da página atual
         *
         * Commentary in English
         * value of the current page index in the array with all pages and value of the current page
         *
         * @ var int
         */
        static protected $_currentIndex;

        /*
         * Commentary in Brazilian Portuguese
         * array com os indices que serão retornados no final
         *
         * Commentary in English
         * array with the indices that will be returned at the end
         *
         * @ var array
         */
        static protected $_indexes = array();

        /*
         * Commentary in Brazilian Portuguese
         * onde o marcador dever parar de fazer o slice (corte)
         *
         * Commentary in English
         * where the marker should stop making the slice (cut)
         *
         * @ var int
         */
        static protected $_pause;

        /*
         * Commentary in Brazilian Portuguese
         * valor da propriedade que centraliza a página atual dentro do array
         *
         * Commentary in English
         * property value that centers the current page within the array
         *
         * @ var int
         */
        static protected $_centeringIndex;

        /*
         * Commentary in Brazilian Portuguese
         * valor dos indices atuais
         * 
         * Commentary in English
         * value of the current indexes
         *
         * @ var int
         */
        static protected $_currentIndexes;

        /*
         * Commentary in Brazilian Portuguese
         * valor da página atual - 1
         *
         * Commentary in English
         * value of current page -1
         *
         * @ var int
         */
        static protected $_add;
        

        public function ReturnIndexes($page, $totalPages, $indexesPerPage, $extraSettings, $arrayPages)
	{
            /*
             * Commentary in Brazilian Portuguese
             * Se o total de páginas for maior que o total de índices
             * 
             * Commentary in English
             * If the total of pages is greater than the total index
             */
            if($totalPages > $indexesPerPage)
            {

                 /*
                  * Commentary in Brazilian Portuguese
                  * Se o total de indices inicial for maior que o total de indices finais
                  * Então o total de indices iniciais é igual ao total de indices finais
                  * 
                  */
                  if($extraSettings > $indexesPerPage)
                  $extraSettings = $indexesPerPage;

                  /*
                   * Commentary in Brazilian Portuguese
                   * verifico se a página atual é a primeira pois o Google deixa sempre uma
                   * quantidade menor de números de páginas quando é a primeira página
                   * Se for a primera página eu coloco apenas o valor informado em $extrasSettings
                   * Exemplo: página 1 marcadores do 1 ao 10
                   * a partir da página 1 começa a soma dos marcadores
                   * Exemplo: página 2 marcadores do 1 ao 11
                   *
                   */
                  if($page == 1)
                  {
                     $_indexes['index'] = array_slice($arrayPages, 0, $extraSettings);
                  }

                  else
                  {
                       /*
                        * Commentary in Brazilian Portuguese
                        * criando o acrescimo de indices
                        * Página atual - 1  Exemplo: página 2, acrescimo de 1 indice, página 3, acrescimo de 2 indices
                        *
                        */
                        $_add = $page - 1;

                       /*
                        * Commentary in Brazilian Portuguese
                        * Acrescentando os indices ao total de indices iniciais
                        */
                        $_currentIndexes = $_add + $extraSettings;

                        /*
                         * Commentary in Brazilian Portuguese
                         * Se o total de indices finais for maior que o total de indices atuais
                         * Então o total de indices recebe o valor do indice atual
                         * 
                         */
                        if($indexesPerPage > $_currentIndexes)
                        $indexesPerPage = $_currentIndexes;

                        /*
                         * Commentary in Brazilian Portuguese
                         * Pegando a metade do total de marcadores definidos
                         *
                         * Commentary in English
                         * Taking half the total set of markers
                         */
                         $_half = ceil($indexesPerPage/2);

                         /*
                          * Commentary in Brazilian Portuguese
                          * Verificando se o total de marcadores é um número par, para definir onde será o começo
                          * (centraliza os indices com a página atual no meio)
                          *
                          * Commentary in English
                          * Checking if the total of markers is an even number, where it will be to define the centeringIndex
                          */
                          if($indexesPerPage % 2 == 0)
                          $_centeringIndex = $_half;

                          else
                          $_centeringIndex = ($indexesPerPage - $_half);


                          /*
                           * Commentary in Brazilian Portuguese
                           * Pegando respectivamente o índice atual e o local da pausa no marcador
                           *
                           * Commentary in English
                           * Getting the current index and the pause of indexes
                           */
                           $_currentIndex = $page - 1;

                           $_pause = ($totalPages - $indexesPerPage);

                           /*
                            * Commentary in Brazilian Portuguese
                            * Verificando se o índice atual é maior que o começo
                            * Em caso afirmativo o índice atual é igual ao índice atual - o começo (centralizador de indice)
                            *
                            * Commentary in English
                            * Checking if the current index is greater than the beginning
                            * If so the current index equals the current index - the centering
                            */
                            if($_currentIndex > $_centeringIndex)
                            {
                               $_currentIndex = ($_currentIndex - $_centeringIndex);
                            }

                            if($page > $_pause)
                            {
                               $_currentIndex = $_pause;
                            }

                            /*
                             * Commentary in Brazilian Portuguese
                             * Retorna um array com os índices das páginas e com a página atual no centro
                             *
                             * Commentary in English
                             * Returns an array with the contents of pages and the current page in the center
                             */
                             $_indexes['index'] = array_slice($arrayPages,$_currentIndex,$indexesPerPage);
                     
                  }

            }
            /*
             * Commentary in Brazilian Portuguese
             * Caso contrário o array de índices retornado é igual ao array com todas as páginas
             *
             * Commentary in English
             * Otherwise, the returned array of indices is equal to the array of all pages
             */
            else
            {
                $_indexes['index'] = $arrayPages;
            }

            return $_indexes;


       }
}
?>