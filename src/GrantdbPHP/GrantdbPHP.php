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
*/
class GrantdbPHP extends Conexao
{
    /**
     * @var string
     */
    public $prefix;

    /**
     * @var string
     */
    public $user;

    /**
     * @var array
     */
    private $command;
    /**
     * @var bool
     */
    private $like;
    /**
     * @var array
     */
    private $permissoes;

    /**
     * GrantdbPHP constructor
     */
    public function __construct($config)
    {
        parent::__construct();
        $this->setconfig($config);
        $this->conecta();

        $this->host = 'localhost';
        $this->command = ['SELECT','INSERT','UPDATE','DELETE'];
        $this->dbase = $this->getconfigDataBase();
    }

    /**
     * Formata saida array para string
     *
     * @param array $permissoes
     * @return void
     */
    private function formataRetorno($permissoes)
    {
        $result = "";

        try {
            if (is_array($permissoes)) {
                $result = implode("<br>", $permissoes);
            } else if (empty($permissoes)){
                throw new Exception("Dados Invalidos!");
            } else {
                $result = $permissoes;
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }

        return $result;
    }

    /**
     * Geração do conteudo sql grant_command
     * @param string $user
     * @param string $prefix
     * @return array
     */
    public function geragrant(string $user, string $prefix)
    {
        $this->user = $user;
        $this->prefix = $prefix;
 
        /**
         * Usar busca por like para varer tabelas do banco por prexifo da tabela
         */
        $this->like = '%';

        $ret = [];

        try {
            $result = $this->link->query('
                SELECT
                    CONCAT("GRANT '.implode(',',$this->command).' ON ",db,".",tb," TO '.
                        $this->user.'@'.$this->host.';") grant_command
                FROM
                    (SELECT table_schema db,table_name tb FROM information_schema.tables
                WHERE
                    table_schema="'.$this->dbase.'" AND table_name LIKE "'.$this->prefix.''.$this->like.'") A
            ');
            while ($dados = $result->fetch_array(MYSQLI_ASSOC)) {
                $ret[] = $dados['grant_command'];
            }
        } catch (\Exception $e) {
            $ret = $e->getMessage();
        }

        return $this->formataRetorno($ret);
    }
}