<?php

/**
 * Controlador abstrato
 * Todos os controladores devem herdar este controlador abstrato.
 * Provê todos os métodos de CRUD para controladores.
 * Atenção: CUIDADO AO ALTERAR ESTA CLASSE
 * 
 * @author Dinaerte Neto <dinaerteneto@gmail.com>
 */

namespace Vivo\Mvc\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

abstract class AbstractDoctrineCrudController extends AbstractActionController {

    protected $formClass;
    protected $modelClass;
    protected $namespaceTableGateway;
    protected $route;
    protected $tableGateway;
    protected $title;
    protected $label = array(
        'add' => 'Add',
        'edit' => 'Edit',
        'yes' => 'Yes',
        'no' => 'No'
    );

    /**
     * exibe os dados páginados
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

        $em = $GLOBALS['entityManager'];
        $result = $em->getRepository($this->modelClass)->findAll();

        $pageAdapter = new ArrayAdapter($result);
        $paginator = new Paginator($pageAdapter);
        $paginator->setCurrentPageNumber($this->params()->fromRoute('page', 1));

        return new ViewModel(array(
            'paginator' => $paginator,
            'title' => $this->setAndGetTitle(),
            'urlAdd' => $urlAdd,
            'urlHomepage' => $urlHomepage
        ));
    }

    /**
     * se não tive sido enviado nenhuma requição então apenas exibe a view.
     * quando for enviado requisição persiste os dados na entidade
     * @return array
     */
    public function createAction() {
        $modelClass = $this->modelClass;
        $model = new $modelClass(
            //$this->getTableGateway()->getPrimaryKey(), $this->getTableGateway()->getTable(), $this->getTableGateway()->getAdapter(), false
            );

        $formClass = $this->formClass;
        $form = new $formClass();
        $form->get('submit')->setValue($this->label['add']);
        $form->bind($model);

        $urlAction = $this->url()->fromRoute($this->route, array('action' => 'create'));

        return $this->save($model, $form, $urlAction, null);
    }

    /**
     * se não tive sido enviado nenhuma requição então apenas exibe a view.
     * quando for enviado requisição, então, verifica se recebeu da rota um parametro key.
     * se receber o parametro key então persiste os dados na entidade
     * se não redireciona para ação create
     * @return array
     */
    public function updateAction() {
        $key = (int) $this->params()->fromRoute('key', null);
        if ($key == null) {
            return $this->redirect()->toRoute($this->route, array(
                    'action' => 'create'
            ));
        }

        $model = $this->getModel($key);
        $formClass = $this->formClass;
        $form = new $formClass();
        $form->bind($model);
        $form->get('submit')->setAttribute('value', $this->label['edit']);

        $urlAction = $this->url()->fromRoute($this->route, array(
            'action' => 'update',
            'key' => $key
        ));

        return $this->save($model, $form, $urlAction, $key);
    }

    /**
     * persiste um registro na entidade
     * @param Vivo\Entity\AbstractEntity $model
     * @param Zend\Form\Form $form
     * @param String $urlAction
     * @param integer $key
     * @return array
     */
    protected function save($model, $form, $urlAction, $key) {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($model->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $model->exchangeArray($form->getData());
                $em = $GLOBALS['entityManager'];
                $em->persist($model);
                $em->flush();

                return $this->redirect()->toRoute($this->route);
            }
        }

        return array(
            'key' => $key,
            'form' => $form,
            'urlAction' => $urlAction,
            'title' => $this->setAndGetTitle()
        );
    }

    /**
     * exclui um registro da tabela pelo id
     * @return array
     */
    public function deleteAction() {
        $key = (int) $this->params()->fromRoute('key', null);
        if (is_null($key)) {
            return $this->redirect()->toRoute($this->route);
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', $this->label['no']);

            if ($del == $this->label['yes']) {
                $em = $GLOBALS['entityManager'];
                $em->remove($this->getModel($key));
                $em->flush();
            }

            return $this->redirect()->toRoute($this->route);
        }

        $urlAction = $this->url()->fromRoute($this->route, array('action' => 'delete', 'key' => $key));

        return array(
            'form' => $this->getDeleteForm($key),
            'urlAction' => $urlAction,
            'title' => $this->setAndGetTitle()
        );
    }

    /**
     * Exibe um formulário com uma questão que deve ser respondida sim ou não
     * @param int $key
     * @return Form
     */
    public function getDeleteForm($key) {
        $form = new Form();

        $form->add(array(
            'name' => 'del',
            'attributes' => array(
                'type' => 'submit',
                'value' => $this->label['yes'],
                'id' => 'del',
            ),
        ));

        $form->add(array(
            'name' => 'return',
            'attributes' => array(
                'type' => 'submit',
                'value' => $this->label['no'],
                'id' => 'return',
            ),
        ));

        return $form;
    }

    /**
     * retorna um registro da tabela pelo seu id
     * @param int $key = id da tabela
     * @return Doctrine\ORM\EntityManager 
     */
    protected function getModel($key) {
        $em = $GLOBALS['entityManager'];
        return $em->getRepository($this->modelClass)->find($key);
    }

    /**
     * retorna o serviço do EntityManager
     * @return Doctrine\ORM\EntityManager
     */
    protected function getSm() {
        return $this->getEvent()->getApplication()->getServiceManager();
    }

    /**
     * retorna o título da página
     * @return String
     */
    protected function setAndGetTitle() {
        $headTitle = $this->getSm()->get('viewhelpermanager')->get('HeadTitle');
        $headTitle($this->title);
        return $this->title;
    }

}
