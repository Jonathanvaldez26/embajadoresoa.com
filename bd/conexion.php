<?php
//instanciar un objeto global a todos los php que incluyan este archivo
$bd = new BD;

class BD{
	//datos de conexion
	var $host = "localhost";
	var $user = "aurochmx_stream";
	var $password = "/*/*ia88tl41";
	var $database = "asofarma_embajadores";
	var $conn;
	
	//Abre la base de datos
	//
	
	
	function  open(){

		$this->conn = mysqli_connect($this->host, $this->user, $this->password) or die(mysqli_error());
		mysqli_select_db($this->conn,$this->database) or die (mysqli_error());
		$this->conn->set_charset('utf8');

	}
	
	// cierra la base de datos
	function close() {
		mysqli_close($this->conn);
	}
	
	//De Aqui en adelante se definen los tipos de consultas que pueden haber
	
	/* Ejecuta una consulta que no devuelve resultados
	*
	*	@param string $sql  consulta SQL
	*/
	
	public function ExecuteNonQuery($sql){
		$this->open();
		$rs = mysqli_query($this->conn,$sql);
		if($rs===false)
		{
			$error = mysqli_errno($this->conn);
			return $error;
		}
		else
		{
			settype($rs, "null");
			return true;
		}
	}
	
	/*Ejecuta una consulta SQL
	*
	*	@param string $query Consulta SQL
	*	@return un array de registros, cada uno siendo un array asociativo de campos
	*/
	
	function Execute($query){
		
		$this->open();
		$rs = mysqli_query($this->conn,$query);
	//se pasa el recordset a un array asociativo
		$my_error1 = mysqli_error( $this->conn);
		if(!empty($my_error1)){
			echo $query ."<br/>";    
			echo "Error: Sintaxis MySql, verifique";
			echo "Error: $my_error1";
			
		}
		else
		{
			$registros = array();
			while($reg=mysqli_fetch_array($rs)){
				$registros[] = $reg;
			}
			
			return $registros;
		}
		$this->close();
	}
	function ExecuteE($query){
		
		$this->open();
		
		$rs = mysqli_query($this->conn, $query);
	//echo $query;
	//se pasa el recordset a un array asociativo
		$my_error1 = mysqli_error( $this->conn);
		if(!empty($my_error1)){
			echo $query ."<br/>";    
			echo "Error: Sintaxis MySql, verifique";
			echo "Error: $my_error1";
			
		}
		else
		{
			$registros = array();
			while($reg=mysqli_fetch_assoc($rs)){
				$registros[] = $reg;
			}
			
			return $registros;
		}
		$this->close();
	}
	/* Ejecuta una consulta devolviendo una fila (registro) con todos sus campos
	*	@param string $tableName Nombre de la tabla
	*	@param string $filter Filtro SQL para el where
	*	@return un array asociativo de campos
	*/
	
	function ExecuteRecord($tableName, $filter){
		$todos = $this->Execute("SELECT * FROM $tableName WHERE $filter");
		return $todos[0];
	}
	
	/*Ejecuta una consulta que devuelve una columna con todos sus registros
	*	@param string $tableName Nombre de la tabla
	*	@param string $field Nombre de campo a traer
	*	@param string $filter Filtro del where (por lo menos debe ser 1=1)
	*	@return un array asociativo de valores de cada registro
	*/
	
	function ExecuteField($tableName, $field,  $filter){
		$todos = $this->Execute("SELECT DISTINCT $field FROM $tableName WHERE $filter");
		$aux = array();
		foreach ($todos as $uno){
			$aux[] = $uno[0];
		}
		return $aux;
	}
	function ExecuteFieldf($sql){
		$todos = $this->Execute($sql);
		$aux = array();
		foreach ($todos as $uno){
			$aux[] = $uno[0];
		}
		return $aux;
	}
	
	/* Trae todos los registros de una tabla
	*	@param string $tableName Nombre de la tabla
	*	@param string $orden Campo por el cual ordenar (opcional)
	*	@return un array de registros, cada uno un array asociativos
	*/
	
	function ExecuteTable($tableName, $orden = ""){
		if($orden!="") 
			return $this->Execute("SELECT * FROM ".$tableName." ORDER BY ". $orden);
		else
			return $this->Execute("SELECT * FROM ".$tableName);
	}
	
	/* Trae un solo valor de la base de datos
	*	@param string $query Consulta SQL (1x1)
	*	@return el valor devuelto por la consulta
	*/
	
	public function ExecuteScalar($query){
		$this->open();
		$rs = mysqli_query($this->conn,$query) or die(mysqli_error());
		$reg = mysqli_fetch_array($rs);
		return $reg[0];
	}
	
	/* Devuelve la cantidad de registros de una tabla
	*	@param string $tableName Nombre de la  tabla
	*	@return Cantidad de registros
	*/
	
	function RecordCount($tableName, $filter){
		return $this->ExecuteScalar("SELECT COUNT(*) FROM ".$tableName." WHERE ".$filter);
	}
	
}

?>