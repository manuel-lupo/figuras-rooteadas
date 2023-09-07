<?php

function addFigure($type, $param1, $param2 = null){
    $figures = getFigures();
    switch ($type) {
        case 'triangle':
            if(!empty($param2))
            $figures->insert(new Triangulo($param1, $param2));
            break;
        
        case 'circle':
            $figures->insert(new Circulo($param1));
            break;
        
        case 'square':
            $figures->insert(new Cuadrado($param1));
            break;
    }
    echo"<a href='home'>Volver</a>";
}

function showAddForm(){
    ?>
    <form id="addForm">
        <select name="type" id="type">
            <option disabled selected>Selecciona una opción</option>    
            <option value="triangle">Triangulo</option>
            <option value="circle">Circulo</option>
            <option value="square">Cuadrado</option>
        </select>
        <div id="figureSpecs">

        </div>
    </form>
<?php
}

function showList($area_max = null)
{
    $figuras = getFigures();
    $figuras = (!empty($area_max)) ? $figuras->getBy(new AreaFilter($area_max)) : $figuras->getAll() ;
    echo
        "<h1>Listado de figuras";
    echo (!empty($area_max)) ? " con area menor a $area_max": '';
    echo"</h1>
        <ul>";

    foreach ($figuras as $figura) {
        echo "<li>" .
            $figura->ToString() .
            " | <a href='lista/" . $figura->getId() . "'>VER </a>" .
            "</li>";
    }

    echo "
    </ul>
    <a href='home'>Volver</a>";
}


function show404()
{
    ?>
    <h1>PAGINA NO ENCONTRADA</h1>
    <a href="home">VOLVER</a>
<?php }

function showFigure($id)
{
    $figura = getFigures()->get($id);

    // imprime el detalle de la figura
    echo
        "<ul>
        <li><strong>ID: </strong>" . $figura->getId() . "</li>
        <li><strong>Tipo: </strong>" . $figura->getName() . "</li>
        <li><strong>Perímetro: </strong>" . $figura->getPerimetro() . "</li>
        <li><strong>Área: </strong>" . $figura->getArea() . "</li>
    </ul>
    <a href='lista'>Volver</a>";

}

function showHome()
{?>
   <a href='lista'>Ver todas las figuras geométricas</a>
   <a href='add'>Añadir una figura al sistema</a>

   <h4> <h4>
   <form id='areaForm'>
       <label for='area'>Buscar figuras con área menor a: </label>
       <input id='area' type='number' name='area' placeholder='Introduzca área...'>
       <button type='submit'>Buscar</button>
   </form>
<?php }