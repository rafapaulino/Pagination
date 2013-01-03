<?php

class Pagination
{
   
	/*
	 * Commentary in Brazilian Portuguese
	 * -----------------------------------------
	 * valor padrão para a página atual
	 *
	 * protected - somente poderá ser acessado dentro da própria classe em que foram declarados e a 
	 * partir de classes descendentes, mas não poderão ser acessados a partir do programa que faz uso dessa classe 
	 *
	 * static -  atributos dinâmicos como as propriedades de um objeto, mas estão relacionados à classe, são compartilhadas
	 * entre todos os objetos de uma mesma classe
	 *
	 * @ var int
	 */
         protected $_page = 1;
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * valor padrão para o total de registros por página
	  *
	  * @ var int
	  */
	 protected $_recordsPage = 10;
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * valor padrão para o retorno do início para cláusulas de banco de dados
	  * essa classe trabalha com arrays e inteiros, o valor retornado em questão serve apenas para organização
	  * e prevenção de erros, ou seja dentro de um método é feita a conta do início para cláusulas sql, evitando
	  * que os resultados da sua paginação não sejam iguais aos resultados retornados pelo banco.
	  * A paginação e o banco trabalharão com o mesmo valor inicial evitando erros.
	  * Você consegue montar a paginação sem ele, esse valor é apenas de retorno
	  *
	  * @ var int
	  */
	 protected $_start = 0;
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * total de registros retornados pelo banco ou array de resultados
	  *
	  * @ var int
	  */
	 protected $_totalRecords = null;
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * valor padrão para os compomentes próximos e anteriores
	  * valor opcional você pode fazer a paginação sem ele
	  *
	  * @ var int
	  */
	 protected $_nextPreviousValue = 15;
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * retorna um array com os tipos de paginadores (opcional) diz o tipo de paginador que será criado
	  * você pode fazer uso ou não do paginador
	  *
	  * @ var array
	  */	  
	 protected $_pager = array("yahoo","google","jumping","simple");
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * retorna os índices com as páginas geradas pelo total de registros, ou tamanho do array
	  * é um valor de retorno (array) e também é opcional você pode trabalhar sem ele
	  *
	  * @ var array
	  */	  
	 protected $_indexes = array();
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * define o total de índices das páginas que serão mostrados, valor padrão de 1 à 10.
	  *
	  * @ var int
	  */
	 protected $_perPage = 10;
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * define as configurações extras para paginações do tipo Delicious ou Google que usam respactivamente 
	  * esse parâmetro como índices extras, e total de índices inicial
	  *
	  * @ var int
	  */
	 protected $_extraSettings = 4;
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * retorna o total de páginas
	  *
	  * @ var int
	  */
	 protected $_totalPages = null;
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * retorna a próxima página
	  *
	  * @ var int
	  */
	 protected $_nextPage = 1;
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * retorna a página anterior
	  *
	  * @ var int
	  */
	 protected $_previousPage = 1;
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * -----------------------------------------
	  * retorna um array com todos os índices das páginas existentes
	  *
	  * @ var array
	  */
	 protected $_arrayPages = array();
	 
	 
	 /*
	  * Commentary in Brazilian Portuguese
	  * Construtor da classe, nele você informa a página atual e o total de registros por página
	  * Ele retorna para você as informações de início em cláusulas sql
	  *
	  * Commentary in English
	  * Class constructor, it tells you the current page and total number of records per page
	  * It returns you to the information in clauses beginning sql
	  *
	  */	 
	 public function __construct($page,$recordsPage)
	 {
		 
		  /* 
		   * Commentary in Brazilian Portuguese
		   * se a página atual não for um valor numérico ou for igual a zero
		   * então a página atual recebe o valor definido em $_page
		   * 
		   * Commentary in English
		   * if the current page is not a numeric value or  is zero
		   * then the current page receives the value determined in $_page
		   *
		   */		  
		   if(!is_numeric($page) || $page <= 0)
		   $this->_page = $this->_page;
		   else
		   $this->_page = $page;
		 
		  /*
		   * Commentary in Brazilian Portuguese
		   * se o valor de resultados por página não for numérico
		   * então o valor de resultados por página recebe o valor definido em $_recordsPage
		   *
		   * Commentary in English
		   * if the value of results per page is not a numeric
		   * then the value of results per page receives the value determined in $_recordsPage
		   *
		   */
		   if(!is_numeric($recordsPage))
		   $this->_recordsPage = $this->_recordsPage;
		   else
		   $this->_recordsPage = $recordsPage;
		 
          /*
		   * Commentary in Brazilian Portuguese
		   * criando o valor de início para cláusulas sql
		   * esse valor é apenas um valor de retorno, você não é obrigado a trabalhar com ele
		   * a função desse valor é garantir que a sua cláusula limit tenha um valor de início igual
		   * ao valor calculado pela paginação
		   *
		   * Commentary in English
		   * creating the start value for sql clauses
		   * this value is only a return value, you are not obligated to work with this
		   * the function of this value is to ensure that its limit clause has a start value equal
		   * the value calculated by the paging
		   *
		   */
		   $this->_start =  ($this->_page - 1) * $this->_recordsPage;
	 }
	 
	 
	/*
	 * Commentary in Brazilian Portuguese
	 * Usando o método mágico __get para retornar os valores das propriedades e métodos dessa classe
	 *
	 * Commentary in English
	 * Using __get magic method to return the values of the properties and methods of this class
	 *
	 */
	 public function __get($property)
	 {
	     return $this->$property;
	 }
	 
	 /*
          * Commentary in Brazilian Portuguese
          * Retornando a próxima página, página anterior, total de páginas, primeira página, e índices de páginas
          *
          * Commentary in English
          * Returning the next page, previous page, total of pages, fisrt page, and index of pages
          */
	 public function CreatePages($totalRecords, $pager = null, $marcadores = 10, $extraSettings = null)
	 {
         
		 /*
		  * Commentary in Brazilian Portuguese
		  * Se o total de registros ou dimensão do array não for um número ou for menor ou igual a zero
		  * o método retorna falso
		  *
		  * Commentary in English
		  * If the total records or size of the array is not a number or is less than or equal to zero
		  * the method return false
		  *
		  */
		 if(!is_numeric($totalRecords) || $totalRecords <= 0)
		 {
			 return false;
		 }
		 
		 else
		 {
			/* 
			 * Commentary in Brazilian Portuguese
			 * Total de páginas é igual ao total de registros dividido pelo total de registros por página com o valor arredondado para cima
			 *
			 * Commentary in English 
			 * Total number of pages is equal to the total of records divided by the total number of records per page
			 *
			 */
		        $this->_totalPages = ceil($totalRecords/$this->_recordsPage);
			
			/*
			 * Commentary in Brazilian Portuguese
			 * definindo a primeira página sempre no valor 1
			 * 
			 * Commentary in English 
			 * setting the first page always worth 1
			 */
			$this->_firstPage = 1;
			
			/*
			 * Commentary in Brazilian Portuguese
			 * Calculando a próxima página
			 *
			 * Commentary in English 
			 * Calculating the next page
			 */
			       $nextPage = $this->_page + 1;
				   
				   if($nextPage >= $this->_totalPages)
				   $nextPage = $this->_totalPages;
				   
			$this->_nextPage = $nextPage;
			
			/*
			 * Commentary in Brazilian Portuguese
			 * Calculando a página anterior
			 *
			 * Commentary in English 
			 * Calculating the previous page
			 */			       
				   $previousPage = $this->_page - 1;
				   if($previousPage <= 1)
				   $previousPage = 1;
				
			$this->_previousPage = $previousPage;
			
			/*
			 * Commentary in Brazilian Portuguese
			 * Retornando um array com todas as páginas
			 *
			 * Commentary in English
			 * Returning an array with all pages
			 */
			$this->_arrayPages = range(1,$this->_totalPages);


                        if($pager != null && in_array($pager, $this->_pager))
                        {

                            /*
                             * Commentary in Brazilian Portuguese
                             * Verificando se o total de índices por página foi informado
                             *
                             * Commentary in English
                             * Checking if the total of index by page was informed
                             */
                             if(!is_numeric($this->_perPage))
                             $this->_perPage = $this->_perPage;

                            /*
                             * Commentary in Brazilian Portuguese
                             * Verificando se as informações extras foram informadas
                             *
                             * Commentary in English
                             * Verifying that the extra information were informed
                             */
                             if(!is_numeric($extraSettings))
                             $extraSettings = $this->_extraSettings;

                            /*
                             * Commentary in Brazilian Portuguese
                             * Chamando a classe de acordo com o tipo informado
                             *
                             * Commentary in English
                             * Calling the class according to the type reported
                             */
                             switch($pager)
                             {
                                case "yahoo":
                                   require_once 'Types/Yahoo.php';
                                   $indexes = new Yahoo;
                                   $indexes = $indexes->ReturnIndexes($this->_page, $this->_totalPages, $marcadores, $extraSettings, $this->_arrayPages);

                                   $this->_indexes = $indexes['index'];
                                   $this->_initialIndex = $indexes['initialIndex'];
                                   $this->_finalIndex = $indexes['finalIndex'];
                                   break;
                               
                                case "google":
                                   require_once 'Types/Google.php';
                                   $indexes = new Google;
                                   $indexes = $indexes->ReturnIndexes($this->_page, $this->_totalPages, $marcadores, $extraSettings, $this->_arrayPages);

                                   $this->_indexes = $indexes['index'];
                                   break;

                                case "jumping":
                                   require_once 'Types/Jumping.php';
                                   $indexes = new Jumping;
                                   $indexes = $indexes->ReturnIndexes($this->_page, $this->_totalPages, $marcadores, $this->_arrayPages);

                                   $this->_indexes = $indexes['index'];
                                   break;
                               
                                case "simple":
                                   require_once 'Types/Simple.php';
                                   $indexes = new Simple;
                                   $indexes = $indexes->ReturnIndexes($this->_page, $this->_totalPages, $marcadores, $this->_arrayPages);

                                   $this->_indexes = $indexes['index'];
                                   break;
                            }

                           
                        }
			
			
		 }



	 }

        
        /*
         * Commentary in Brazilian Portuguese
         * Retornando a página atual + o número de páginas passadas no parâmetro do método
         *
         * Commentary in English
         * Returning the current page + the number of pages reported in the method
         */
         public function Go($parameter)
         {
             $go = (int) $this->_page + $parameter;
             if($go >= $this->_totalPages)
             $go = $this->_totalPages;

             return $go;
         }

         /*
          * Commentary in Brazilian Portuguese
          * Retornando a página atual - o número de páginas passadas no parâmetro do método
          *
          * Commentary in English
          * Returning the current page - the number of pages reported in the method
          */
         public function Back($parameter)
         {
             $back = (int) $this->_page - $parameter;
             if($back <= 1)
             $back = 1;

             return $back;
         }

}

?>