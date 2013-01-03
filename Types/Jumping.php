<?php

class Jumping
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
         * variável que faz o cálculo do delta para o corte do array
         *
         * @ var int
         */
        static protected $_delta;

        /*
         * Commentary in Brazilian Portuguese
         * variável que faz o cálculo do offset (equilibrio) para o corte do array
         *
         * @ var int
         */
        static protected $_offset;

        

        public function ReturnIndexes($page, $totalPages, $indexesPerPage, $arrayPages)
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
                  * Pegando o delta (resto da divisão da página atual pelo total de marcadores)
                  *
                  * Commentary in English
                  */
                 $_delta = $page % $indexesPerPage;

                 /*
                  * Commentary in Brazilian Portuguese
                  * Se o delta for igual a zero então o delta será o total de marcadores
                  */
                 if($_delta == 0)
                 $_delta = $indexesPerPage;

                 /*
                  * Commentary in Brazilian Portuguese
                  * Pegando o offset página atual - o delta
                  */
                 $_offset = $page - $_delta;
                
                 /*
                  * Commentary in Brazilian Portuguese
                  * Pegando o índice atual do começo do array (que mostrará os indices das páginas)
                  */
                 $_currentIndex = ($_offset+1)-1;

                 /*
                  * Commentary in Brazilian Portuguese
                  * Pegando onde o marcador deve parar de fazer o slice (corte)
                  */
                 $_pause = ($totalPages - $indexesPerPage);

                 
                  /*
                   * Commentary in Brazilian Portuguese
                   * Se a página atual for maior que a pausa então nós paramos de fazer o corte
                   */
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