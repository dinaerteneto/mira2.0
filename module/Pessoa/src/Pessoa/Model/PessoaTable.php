<?php
namespace Pessoa\Model;

use Vivo\Db\TableGateway\AbsTableGateway;
use Vivo\Model\AbstractModel;

class PessoaTable extends AbsTableGateway {
   
    protected $primaryKey = 'id';
           
    protected function getData(AbstractModel $model) {
        $data = array(
            'id' => $model->id,
            'nome' => $model->nome
        );
        return $data;
    }
    
}
