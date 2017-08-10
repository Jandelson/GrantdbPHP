<?php
namespace GrantdbPHP;
/**
* Gerar consteudo sql para usar das permissões de usuario no banco de dados
*
* Class        Conexao
* @package     GrantdbPHP
* @name        GrantdbPHP
* @version     1.0.0
* @copyright   2017 &copy; Jandelson Oliveira
* @link        http://www.jandelson.tk/
* @author      Jandelson Oliveira <jandelson_oliveira at yahoo dot com dot br>
*
*/
class Conexao {
    private $host;
    private $user;
    private $senha;
    private $dbase;

    public $query;
    public $link;
    public $resultado;

    public function __construct()
    {
    }
    /**
     * $config array
    */
    public function MySQL($config)
    {
        $this->host = $config['host'];
        $this->user = $config['user'];
        $this->senha = $config['senha'];
        $this->dbase = $config['dbase'];
	}
	private function conecta()
	{
        $this->link = @mysql_connect($this->host,$this->user,$this->senha);
	    if(!$this->link){
	        print "Ocorreu um Erro na conexão MySQL:";
			print "<b>".mysql_error()."</b>";
			die();
        }elseif(!mysql_select_db($this->dbase,$this->link)){
	        print "Ocorreu um Erro em selecionar o Banco:";
			print "<b>".mysql_error()."</b>";
			die();
        }
    }
	/**
     * $query String sql
    */
	public function query($query)
	{
        $this->conecta();
        $this->query = $query;
        if (empty($this->query)) {
            throw new \Exception("Consulta ou dados Invalidos!");
        }
	    if ($this->resultado = mysql_query($this->query)) {
            $this->desconecta();
            return $this->resultado;
        } else {
	        print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
			print "<br><br>";
			print "Erro no MySQL: <b>".mysql_error()."</b>";
			die();
            $this->desconecta();
        }

    }

	private function desconecta() {
        return mysql_close($this->link);
    }
}