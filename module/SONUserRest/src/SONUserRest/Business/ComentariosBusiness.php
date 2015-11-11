<?php
namespace SONUserRest\Business;

/* @var $comentarioFactory  \SONUser\Entity\ComentarioRepository */
class ComentariosBusiness
{
    private $serviceLocator;

    public function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
    }

    public function getList() {
        $comentarioFactory = $this->serviceLocator->get("comentario-factory");
        return $comentarioFactory->findArray();
    }

    public function get($id) {
        $comentarioFactory = $this->serviceLocator->get("comentario-factory");
        return $comentarioFactory->find($id);
    }

    public function insert ( array $data) {
        $comentarioFactory = $this->serviceLocator->get("comentario-factory");
        $comentarioQuantity = $comentarioFactory->getQuantityComentariosByMateria($data['idMateria']);
        $conteudoToSave = $this->validateHtmlToSave($comentarioQuantity , $data['comentario'], $data['nomeCliente'] );
        $data['comentario'] = $conteudoToSave;
        $comentario = $this->serviceLocator->get('SONUser\Service\Comentario')->insert($data);
        return $comentario;
    }

    private function htmlTimeLine( $autor, $conteudo ) {
        return "<li>
                  <div class='timeline-badge info'><i class='glyphicon glyphicon-floppy-disk'></i></div>
                  <div class='timeline-panel'>
                    <div class='timeline-heading'>
                      <h4 class='timeline-title'>".$autor."</h4>
                    </div>
                    <div class='timeline-body'>
                      <p>". $conteudo. "</p>
                      <hr>
                    </div>
                  </div>
                </li>";
    }

    private function htmlTimeLineInverted( $autor, $conteudo ) {
        return "<li class='timeline-inverted'>
                  <div class='timeline-badge success'><i class='glyphicon glyphicon-thumbs-up'></i></div>
                  <div class='timeline-panel'>
                    <div class='timeline-heading'>
                      <h4 class='timeline-title'>".$autor."</h4>
                    </div>
                    <div class='timeline-body'>
                      <p>". $conteudo. "</p>
                    </div>
                  </div>
                 </li>";
    }

    private function validateHtmlToSave($val, $conteudo, $autor) {
        if($val % 2 == 0) return $this->htmlTimeLine( $autor, $conteudo );
        return  $this->htmlTimeLineInverted( $autor, $conteudo );
    }
}