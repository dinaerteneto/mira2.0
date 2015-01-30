<?php

/**
 * Controlador de Pessoas
 * Aqui todos os métodos necessário para conversar com entidades e modelos.
 * Lembrando que controladores são responsáveis "apenas" por devolver para as views 
 * aquilo que lhe é solicitado
 * 
 * @author Dinaerte Neto <dinaerteneto@gmail.com> 
 */
namespace Pessoa\Controller;

use Vivo\Mvc\Controller\AbstractDoctrineCrudController;
use Pessoa\Form\PessoaForm;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

use Doctrine\Common\Collections\Criteria;

class PessoaController extends AbstractDoctrineCrudController {
    
    /**
     * Define as variavéis
     */
    public function __construct() {
        $this->formClass = 'Pessoa\Form\PessoaForm';
        $this->modelClass = 'Pessoa\Model\Pessoa';
        $this->namespaceTableGateway = 'Pessoa\Model\PessoaTable';
        $this->route = 'pessoa';
        $this->title = 'Cadastro de Usuários';
        $this->label = array(
            'add' => 'Incluir',
            'edit' => 'Alterar',
            'yes' => 'Sim',
            'no' => 'Não'
        );
    }
    
    /**
     * Exibe uma tabela com os dados da pessoa
     * @return ViewModel
     */
    public function indexAction() {
        $partialLoop = $this->getSm()->get('viewhelpermanager')->get('PartialLoop');
        $partialLoop->setObjectKey('model');

        $urlAdd = $this->url()->fromRoute($this->route, array('action' => 'create'));
        $urlEdit = $this->url()->fromRoute($this->route, array('action' => 'update'));
        $urlDelete = $this->url()->fromRoute($this->route, array('action' => 'delete'));
        $urlHomepage = $this->url()->fromRoute('home');

        $placeHolder = $this->getSm()->get('viewhelpermanager')->get('Placeholder');
        $placeHolder('url')->edit = $urlEdit;
        $placeHolder('url')->delete = $urlDelete;

        
        //formulario de pesquisa
        $form = new PessoaForm();
        $form->get('submit')->setAttribute('value', 'Pesquisar');
                
        $em = $GLOBALS['entityManager'];        
        //se informado algo na pesquisa
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $nome = $request->getPost('nome', null);
            $criteria = Criteria::create();
            $criteria->where(Criteria::expr()->contains("nome", "{$nome}"));
            $result = $em->getRepository($this->modelClass)->matching($criteria)->toArray();             
        } else {
            $result = $em->getRepository($this->modelClass)->findBy(array(), array('nome' => 'asc'));
        }
  
        $pageAdapter = new ArrayAdapter($result);
        $paginator = new Paginator($pageAdapter);
        $paginator->setCurrentPageNumber($this->params()->fromRoute('page', 1));
                
        return new ViewModel(array(
            'paginator' => $paginator,
            'title' => $this->setAndGetTitle(),
            'urlAdd' => $urlAdd,
            'urlHomepage' => $urlHomepage,
            'form' => $form
        ));
    }
    
    /**
     * Exibe o formulário para edição dos registro
     * quando o formulário for enviado, persiste os dados na entidade
     * @return ViewModel
     */
    public function updateAction() {
        $key = (int) $this->params()->fromRoute('key', null);
        if ($key == null) {
            return $this->redirect()->toRoute($this->route, array(
                    'action' => 'create'
            ));
        }
        $model = $this->getModel($key);               
        $form = new PessoaForm();
        $form->bind($model);
        $form->get('submit')->setAttribute('value', $this->label['edit']);
        
        $urlAction = $this->url()->fromRoute($this->route, array(
            'action' => 'update',
            'key' => $key
        ));
        
        return $this->save($model, $form, $urlAction, $key);        
    }
}
