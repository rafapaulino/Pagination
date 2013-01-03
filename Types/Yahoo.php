<?php

class Yahoo
{
        /*
         * Commentary in Brazilian Portuguese
         * valor da metade dos indices por página
         *
         * Commentary in English
         * half the value of indices per page
         *
         * @ var int
         */
        static protected $_half;

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
         * indice do corte para o array final
         *
         * Commentary in English
         * index of the cut for the final array
         *
         * @ var int
         */
        static protected $_startEnd;

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
        

        public function ReturnIndexes($page, $totalPages, $indexesPerPage, $extraSettings, $arrayPages)
	{
            
            //array com os indices iniciais
            $_initialIndex = array();
            //array com os indices finais
            $_finalIndex = array();


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

                  /*
                   * Commentary in Brazilian Portuguese
                   * Se o total de páginas for maior que ( indices por página + ( indices de ínicio e fim * 2 ))
                   * Então os parte inicial é igual ao total de páginas * 4 porcento
                   * parte final = total de páginas - parte inicial
                   * começo do corte no final da paginação
                   *
                   * Commentary in English
                   * If the total number of pages is greater than (+ indices per page (beginning and end indices * 2))
                   * Then the initial part is equal to the total number of pages * 4 percent
                   * the end = total pages - the initial part
                   * start the cut at the end of the paging
                   */
                  if($totalPages > ($indexesPerPage + ($extraSettings * 2)))
                  {

                      $_initialPart = ceil($totalPages * 0.04);
                      $_startEnd = ($totalPages - $extraSettings);

                         /*
                          * Commentary in Brazilian Portuguese
                          * Pego o indice da página atual dentro do array de páginas e vejo se ele é maior que os indices de início e fim
                          * e também se o indice atual é maior que os 4 porcento do total de páginas
                          * Em caso afirmativo os indices iniciais serão mostrados
                          *
                          * Commentary in English
                          * Pick up the index of the current page within the array of pages and see if it is greater than the indices from the beginning and end
                          * and also if the index now is greater than the 4 percent of total pages
                          * If so the indices will be shown early
                          */
                         if(($_currentIndex - 1)  > $extraSettings && ($_currentIndex - 1) > $_initialPart) {
                             $_initialIndex = array_slice($arrayPages,0,$extraSettings);
                         }
                         /*
                          * Commentary in Brazilian Portuguese
                          * Se o indice da página atual for menor que o total indices por página
                          * Então os indices finais serão mostrados
                          *
                          * Commentary in English
                          * If the index of the current page is less than the total indices per page
                          * Then the final indices are shown
                          */
                          if($page < ($totalPages - $indexesPerPage)) {
                             $_finalIndex = array_slice($arrayPages,$_startEnd,$extraSettings);
                          }

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

                /*
                 * Commentary in Brazilian Portuguese
                 * atribuindo as variaveis de indices iniciais e final para o array $_indexes
                 *
                 * Commentary in English
                 * assigning the variables of initial and final indices for the array
                 */
                $_indexes['initialIndex'] = $_initialIndex;
                $_indexes['finalIndex'] = $_finalIndex;

                return $_indexes;


	    
	}
}
?>