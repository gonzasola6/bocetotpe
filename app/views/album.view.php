<?php

class AlbumView{

    private $user = null;

    public function __construct($user){
        $this->user = $user;
    }


    public function showAlbums($albums){
        require './templates/header.phtml';
        
        
        ?>

        <h1>Discos disponibles a la venta:</h1>
        <ul class="list-group">
        <?php foreach($albums as $album) { ?>
            <li class="list-group-item item-album">
                <div class="label">
                    <b>Titulo:</b> <?= htmlspecialchars($album->nombre)?>
                    <b>Genero:</b> <?= htmlspecialchars($album->genero) ?>
                    <b>Cantidad de canciones:</b> <?= htmlspecialchars($album->cantCanciones) ?>
                    <b>Fecha de lanzamiento:</b> <?= htmlspecialchars($album->lanzamiento) ?>
                    <?php if($this->user): ?>
                        <a href="eliminar/<?= $album->ID_Album ?>" type="button" class='btn btn-danger btn-sm ml-auto'>Borrar</a>
                    <?php endif; ?>
            </li>
        <?php }
        require './templates/form.phtml';
        require './templates/footer.phtml';
    }

    public function showError($error){
        require './templates/error.phtml';
    }

}