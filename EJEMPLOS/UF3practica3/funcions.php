<?php

//variables
$basededades = "peliculas";
$usuari="fidel";
$contrasenya="1234";

//Funció per fer la connexió a la base de dades
function conectarBD($basededades, $usuari ,$contrasenya){
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=' . $basededades,$usuari, $contrasenya);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
        ?>
    <?php }
    catch (PDOException $e) {
        ?>
      <h4>Error de connexió<?php echo $e->getMessage();?></h4>
    <?php }
    return $pdo;
}

//Funció per validar el login d'un usuari
function validarUsuari($pdo, $usuari, $contrasenya){
    $sql = 'SELECT * FROM usuario';
    $usuarios = $pdo->query($sql);
    $usuariValid = false;
    while($usuario = $usuarios->fetch()){
        if ($usuari == $usuario['nombre']) {
            $verificacio = password_verify($contrasenya, $usuario['pass']);
            if($verificacio){
                $usuariValid = true;
            }
        }
    }
    return $usuariValid;
}

//Funció per crear la taula d'actors
function mostrarActors($pdo){
    $sql="SELECT * FROM actor";
    $actors=$pdo->query($sql);?>
    <table>
        <thead>
            <th>Imatge</th>
            <th>Nom</th>
            <th>Nacionalitat</th>
            <th>Accions</th>
        </thead>
        <tbody>
            <?php 
                if($actors->rowCount() <= 0):?>
                <tr>
                    <td colspan="4">No s'ha trobat cap registre</td>
                </tr>
                <?php else:?>
                    <?php while ($actor = $actors->fetch()) :?>
                        <tr>
                            <td><img class="imatgeActor" src="<?=$actor['imagen']?>"></td>
                            <td><?= $actor['nombreActor']?></td>
                            <?php $pais = consultarNacionalitat($pdo, $actor['nacionalidadActor']);?>
                            <td><?= $pais ?></td>
                            <td><button onclick="window.location.href='editarActor.php?idActor=<?php echo $actor['idActor']; ?>'">Editar</button><button onclick="window.location.href='eliminarActor.php?idActor=<?php echo $actor['idActor'];?>'">Eliminar</button></td>
                        </tr>
                    <?php endwhile?>
                <?php endif?>
        </tbody>
    </table>
    <?php
}

//Funció per crear la taula d'actors que coincideixin amb la busqueda introduida.
function buscarActors($pdo, $busqueda){
    $sql="SELECT * FROM actor WHERE nombreActor LIKE '%$busqueda%'";
    $actors=$pdo->query($sql);?>
    <table>
        <thead>
            <th>Imatge</th>
            <th>Nom</th>
            <th>Nacionalitat</th>
            <th>Accions</th>
        </thead>
        <tbody>
            <?php 
                if($actors->rowCount() <= 0):?>
                <tr>
                    <td colspan="4">No s'ha trobat cap registre</td>
                </tr>
                <?php else:?>
                    <?php while ($actor = $actors->fetch()) :?>
                        <tr>
                            <td><img class="imatgeActor" src="<?=$actor['imagen']?>"></td>
                            <td><?= $actor['nombreActor']?></td>
                            <?php $pais = consultarNacionalitat($pdo, $actor['nacionalidadActor']);?>
                            <td><?= $pais ?></td>
                            <td><button onclick="window.location.href='editarActor.php?idActor=<?php echo $actor['idActor']; ?>'">Editar</button><button onclick="window.location.href='eliminarActor.php?idActor=<?php echo $actor['idActor'];?>'">Eliminar</button></td>
                        </tr>
                    <?php endwhile?>
                <?php endif?>
        </tbody>
    </table>
    <?php
}

//Funcio per crear la taula de països
function mostrarPaisos($pdo){
    $sql="SELECT * FROM pais";
    $paisos=$pdo->query($sql);?>
    <table>
        <thead>
            <th>Pais</th>
            <th>Accions</th>
        </thead>
        <tbody>
            <?php
                if($paisos->rowCount() <= 0):?>
                    <tr>
                        <td colspan="1">No s'ha trobat cap registre</td>
                    </tr>
                    <?php else:?>
                        <?php while ($pais = $paisos->fetch()) :?>
                            <tr>
                                <td><?= $pais['nombrePais']?></td>
                                <td><button onclick="window.location.href='editarPais.php?idPais=<?php echo $pais['idPais']?>'">Editar</button><button onclick="window.location.href='eliminarPais.php?idPais=<?php echo $pais['idPais']?>'">Eliminar</button></td>
                            </tr>
                        <?php endwhile?>
                <?php endif?>
        </tbody>
    </table>
    <?php
}

//Funció per obtenir la informació d'un actor/actriu a través de la seva id.
function consultarActor($pdo, $idActor){
    $sql= "SELECT * FROM actor WHERE idActor = $idActor";
        $actors = $pdo->query($sql);
        $actor = $actors->fetch();
    
    return $actor;
}

//Funció per obtenir la informació d'un país a través de la seva id.
function consultarPais($pdo, $idPais){
    $sql= "SELECT * FROM pais WHERE idPais = '$idPais'";
        $paisos = $pdo->query($sql);
        $pais = $paisos->fetch();
    
    return $pais;
}

//Funcio per obtenir el nom del país a través del seu codi/id.
function consultarNacionalitat($pdo, $id){
    $sql= "SELECT * FROM pais WHERE idPais = $id";
        $nomPais = $pdo->query($sql);
        $pais = $nomPais->fetch();
    

    return $pais['nombrePais'];
}

//Funció per omplir el selector de països
function omplirSelector($pdo){
    $sql = "SELECT * from pais";
    $paisos = $pdo->query($sql);
    if($paisos->rowcount() >= 0):?>
        <?php while ($pais = $paisos->fetch()) :?>

            <option value="<?php echo $pais['idPais']?>"><?php echo $pais['nombrePais'] ?></option>
        <?php endwhile ?>
    <?php else:?>
    <?php endif;
}

//Funció per omplir el selector de països amb un d'ells seleccionat
function omplirSelectorSeleccionat($pdo, $idNacionalitat){
    $sql = "SELECT * from pais";
    $paisos = $pdo->query($sql);
    if($paisos->rowcount() >= 0):?>
        <?php while ($pais = $paisos->fetch()) :
                if($pais['idPais'] == $idNacionalitat):?>
                    <option selected value="<?php echo $pais['idPais']?>"><?php echo $pais['nombrePais'] ?></option>        
                <?php else:?>
                    <option value="<?php echo $pais['idPais']?>"><?php echo $pais['nombrePais'] ?></option>
                    <?php endif?>            
        <?php endwhile ?>
    <?php else:?>
    <?php endif;
}

//Funció per afegir un actor de la taula
function insertActor($pdo, $nom, $idPais, $imatge){
    try {
        $sql="INSERT INTO actor (nombreActor, nacionalidadActor, imagen) VALUES('$nom', '$idPais', '$imatge')";
        $pdo->exec($sql);?>
        <h1>S'ha afegit a "<?php echo $nom?>" a la taula <br/></h1>
        <?php
    }
    catch(PDOException $excepcion) {
        ?><h1>Error a la inserción de tipus: "<?php echo $excepcion->getMessage() ?>"</h1><?php
    }
}

//Funció per modificar un actor de la taula
function updateActor($pdo, $idActor, $nom, $idPais, $imatge){
    try {
        $sql="UPDATE actor SET nombreActor = '$nom', nacionalidadActor = '$idPais', imagen = '$imatge' WHERE idActor = '$idActor';";
        $pdo->exec($sql);?>
        <h1>S'han modificat les dades de "<?php echo $nom?>" a la taula <br/></h1>
        <?php
    }
    catch(PDOException $excepcion) {
        ?><h1>Error a la modificació de tipus: "<?php echo $excepcion->getMessage() ?>"</h1><?php
    }
}

//Funció per afegir un pais a la taula
function insertPais($pdo, $nom){
    try {
        $sql="INSERT INTO pais (nombrePais) VALUES('$nom')";
        $filasInsertadas=$pdo->exec($sql);?>
        <h1>S'ha afegit "<?php echo $nom?>" a la taula<br/></h1>
        <?php
    }
    catch(PDOException $excepcion) {
        ?><h1>Error a la inserció de tipus: "<?php echo $excepcion->getMessage() ?>"</h1><?php
    }
}

//Funció per modificar un pais de la taula
function updatePais($pdo, $idPais, $nomPais){
    try {
        $sql="UPDATE pais SET nombrePais = '$nomPais' WHERE idPais = '$idPais'";
        $pdo->exec($sql);?>
        <h1>S'han modificat les dades de "<?php echo $nomPais?>" a la taula <br/></h1>
        <?php
    }
    catch(PDOException $excepcion) {
        ?><h1>Error a la modificació de tipus: "<?php echo $excepcion->getMessage() ?>"</h1><?php
    }
}

//Funció per eliminar un actor de la taula
function deleteActor($pdo, $idActor){
    try {
        $sql="DELETE FROM actor WHERE idActor = '$idActor'";
        $pdo->exec($sql);?>
        <h1>S'han eliminat les dades de la taula <br/></h1>
        <?php
    }
    catch(PDOException $excepcion) {
        ?><h1>Error a la eliminació de tipus: "<?php echo $excepcion->getMessage() ?>"</h1><?php
    }
}

//Funció per eliminar un pais de la taula
function deletePais($pdo, $idPais){
    if (comprovarPais($pdo, $idPais)) {
        try{
            $sql="DELETE FROM pais WHERE idPais = '$idPais'";
            $pdo->exec($sql);?>
            <h1>S'han eliminat les dades de la taula</h1><?php
        }
        catch(PDOException $excepcion) {
            ?><h1>Error a la eliminació de tipus: "<?php echo $excepcion->getMessage() ?>"</h1><?php
        }
    }else {
        ?><h2>El país no es pot eliminar. Hi ha actors amb aquesta nacionalitat assignada.</h2><?php
    }
    
}

//Comprova si hi ha algun actor amb el país passat per paràmetre d'entrada assignat. Per evitar esborrar un pais que és utilitzat.
function comprovarPais($pdo, $idPais){
    $sql = "SELECT * from actor WHERE nacionalidadActor = '$idPais'";
    $paisos = $pdo->query($sql);
    if($paisos->rowcount() > 0){
        return false;
    }else{
        return true;
    }
}