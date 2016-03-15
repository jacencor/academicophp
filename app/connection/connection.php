<?php
/* Conectar a una base de datos ODBC invocando al controlador */

class connectionDb {
    private $serverDb = 'mysql';
    private $host = 'localhost';
    private $port = '3306';
    private $dataBase='laravel_academico';
    private $user = 'root';
    private $password = '';

       
    public function log($data){
        ini_set("log_errors", 1);
        ini_set("error_log",$_SERVER["DOCUMENT_ROOT"].'/academicophp/error.log');
        error_log( $data );
    }
    /*
     * ABRIR CONEXION
     * ---------------------------------------
     * 
     * Retorna una conexion a la base de datos 
     * $output['open'] -> conexion a la base
     * $output['flag'] -> true: conexion exitosa, false: conexion fallida
     */
    public function openConnection (){
        $output['flag']=false;
        try {
            $dsn =  $this->serverDb.':dbname='.$this->dataBase.';host='.$this->host.';port='.$this->port;  
            $open = new PDO($dsn, $this->user, $this->password);
            $open->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $output['open']=$open;
            $output['flag']=true;
            return ($output);
        } catch (PDOException $e) {
            //$output['messages'] = 'Fallo la conexion: ' . $e->getMessage();
            log($e);
            return ($output);
        }catch (Exception $e){
            //$output['messages'] = 'Fallo la conexion: ' . $e->getMessage();
            log($e);
            return ($output);
        }
    }
    
    /*
     * OBTENER TABLA DE REGISTROS
     * ----------------------------------
     * 
     * Ejecuta consultas en la base para obtener una lista de los registros
     * $output['output'] -> array de la consutla realizada
     * $output['flag'] -> true: consulta exitosa, false: consulta fallida
     */
    public function executeSelectArray ($sql){
        $output['flag']=false;
        try {
                $dsn =  $this->serverDb.':dbname='.$this->dataBase.';host='.$this->host.';port='.$this->port;  
                $open = new PDO($dsn, $this->user, $this->password);
                $open->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $return = $open->prepare($sql);
                $return -> execute();
                $output['output']=$return->fetchAll(PDO::FETCH_ASSOC);
                $open = null;
                $output['flag']=true;
                return ($output);
        } catch (PDOException $e) {
                //$output['messages'] = 'Fallo la conexion: ' . $e->getMessage();
                log($e);
                return ($output);
        }catch (Exception $e){
                //$output['messages'] = 'Fallo la conexion: ' . $e->getMessage();
                log($e);
                return ($output);
        } 
    }
    
    /*
     *  OBTENER UN REGISTRO
     * -------------------------------------
     * 
     * Ejecuta consultas en la base para obtener un registro
     * segun parametros de consulta definidos con $sql y $input
     * $output['output'] -> array de la consutla realizada  - fetch(PDO::FETCH_ASSOC)
     * $output['flag'] -> true: consulta exitosa, false: consulta fallida
     */
    public function executeSelect($sql,$input){
        $output['flag']=false;
        try {
                $dsn =  $this->serverDb.':dbname='.$this->dataBase.';host='.$this->host.';port='.$this->port;  
                $open = new PDO($dsn, $this->user, $this->password);
                $open->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $return = $open->prepare($sql);
                $return -> execute($input);
                $output['output']=$return->fetch(PDO::FETCH_ASSOC);
                $open = null;
                $output['flag']=true;
                return ($output);
        } catch (PDOException $e) {
                //$output['messages'] = 'Fallo la conexion: ' . $e->getMessage();
                log($e);
                return ($output);
        }catch (Exception $e){
                //$output['messages'] = 'Fallo la conexion: ' . $e->getMessage();
                log($e);
                return ($output);
        } 
    }
    
    /*
     * EJECUCION DE UPDATE
     * -------------------------------------
     * 
     * Ejecuta una sentencia SQL 
     * segun parametros de definidos con $sql y $input
     * $output['output'] -> resultado de la operacion - fetch()
     * $output['flag'] -> true: operacion exitosa, false: operacion fallida
     */
    public function executeSQL($sql,$input){
        $output['flag']=false;
       // try {
                $dsn =  $this->serverDb.':dbname='.$this->dataBase.';host='.$this->host.';port='.$this->port;                  
                $open = new PDO($dsn, $this->user, $this->password);
                $open->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $return = $open->prepare($sql);
                $return -> execute($input);
                $output['output']=$return;
                $output['flag']=true;
                $open = null;
                return ($output);
        //} catch (PDOException $e) {
                //$output['messages'] = 'Fallo la conexion: ' . $e->getMessage();
                log($e);
                return ($output);
        //}catch (Exception $e){
                //$output['messages'] = 'Fallo la conexion: ' . $e->getMessage();
                log($e);
                return ($output);
        //} 
    }
}