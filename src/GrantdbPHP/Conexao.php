<?php
namespace GrantdbPHP;
/**
* Gerar consteudo sql para usar das permiss�es de usuario no banco de dados
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

    public $link;
    
    public function __construct()
    {
    }
    /**
     * Setar configuração do banco de dados
     *
     * @param array $config
     * @return void
     */
    public function setconfig(array $config)
    {
        $this->host = $config['host'];
        $this->user = $config['user'];
        $this->senha = $config['senha'];
        $this->dbase = $config['dbase'];
    }
    /**
     * Retorna nome do banco de dados
     *
     * @return void
     */
    public function getconfigDataBase()
    {
        return $this->dbase;
    }

	public function conecta()
	{
        try {
            $this->link = new \mysqli($this->host, $this->user, $this->senha, $this->dbase);
        } catch(\Exception $e) {
            print $e->getMessage();
        }

        return $this->link;

    }
}