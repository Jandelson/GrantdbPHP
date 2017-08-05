<?php
namespace GrantdbPHP;
/**
* Gerar consteudo sql para usar das permissões de usuario no banco de dados
*
* Class        GrantdbPHP
* @package     GrantdbPHP
* @name        GrantdbPHP
* @version     1.0.0
* @copyright   2017 &copy; Jandelson Oliveira
* @link        http://www.jandelson.tk/
* @author      Jandelson Oliveira <jandelson_oliveira at yahoo dot com dot br>
*
*
*
*/
require_once('db.php');
class GrantdbPHP extends Conexao
{
    /**
     * @var string
     */
    public $db;

    /**
     * @var string
     */
    public $prefix;

    /**
     * @var string
     */
    public $user;

    /**
     * @var string
     */
    public $host;
    /**
     * @var array
     */
    private $command;
    /**
     * @var bool
     */
    public $like;

    /**
     * GrantdbPHP constructor
     */
    public function __construct()
    {
       $this->host = 'localhost';
       $this->command = ['SELECT','INSERT','UPDATE','DELETE'];
    }

    /**
     * Geração do conteudo sql grant_command
     * @param $db
     * @param $host
     * @param $user
     * @param $prefix
     * @param array $command
     * @return array
     */
    public function geragrant(
        $db,
        $host,
        $user,
        $prefix,
        $like=true
    )
    {

        $this->db = $db;
        $this->host = $host;
        $this->user = $user;
        $this->prefix = $prefix;
        $this->like = $like;

        if ($this->like) {
            $this->like = '\_%';
        }

        $query = $this->query('
            SELECT
                CONCAT("GRANT '.implode(',',$this->command).' ON ",db,".",tb," TO '.$this->user.'@'.$this->host.';") grant_command
            FROM
                (SELECT table_schema db,table_name tb FROM information_schema.tables
            WHERE
                table_schema="'.$this->db.'" AND table_name LIKE "'.$this->prefix.''.$this->like.'") A
        ');

        while($dados = mysql_fetch_array($query)) {
            $result[] = $dados['grant_command'];
        }

        return $result;
    }
}