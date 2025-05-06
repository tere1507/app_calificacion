<?php
// Simulamos una base de datos de productos en un array asociativo
$productos = [
    ['nombre' => 'Camiseta', 'estrellas' => 5],
    ['nombre' => 'Jeans', 'estrellas' => 4 ],
    ['nombre' => 'Zapatos', 'estrellas' => 3],
    ['nombre' => 'Gorra', 'estrellas' => 2],
    ['nombre' => 'Bufanda', 'estrellas' => 1],
    ['nombre' => 'Falda', 'estrellas' => 5],
    ['nombre' => 'Heardecoration', 'estrellas' => 4 ],
];

$filtro = isset($_GET['estrellas']) ? $_GET['estrellas'] : [];//Revisa si se ha enviado el formulario (vía GET) y si existe el campo estrellas.
//Si sí, se guarda el array con las estrellas seleccionadas en $filtro , si no devuelve un array vacio

// Función para filtrar productos por estrellas seleccionadas
function filtrarProductos($productos, $filtro) {//
    if(empty($filtro)) {
        return $productos;
    }
    // Devolvemos solo los productos cuya estrella esté en el filtro
return array_filter($productos, function($producto) use ($filtro) {//array_filter() itera internamente sobre cada elemento del 
    //primer array que recibe ($productos). Por cada elemento, llama a la función callback (el segundo argumento)
    //Si la función callback devuelve true para un elemento, array_filter() incluye ese elemento en el nuevo array que está construyendo. Si devuelve false, lo descarta.

    return in_array($producto['estrellas'], $filtro);
});

}

// Llamamos a la función para tener los productos que se mostrarán
$productosFiltrados = filtrarProductos($productos, $filtro);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<h1><i>Catalogo de productos!</i></h1>
    <!-- Formulario para filtrar por estrellas -->
    <form method="get">
        <fieldset>
            <legend><i>Filtrar por estrellas</i></legend>
            <?php for ($i = 1; $i <= 5; $i++): ?>
           <label>
           <input type="checkbox" name="estrellas[]" value="<?= $i ?>"
            <?= in_array($i, $filtro) ? 'checked' : ''?>>
            <?= str_repeat("⭐", $i) ?><!--Genera y muestra el número correcto de emojis de estrella ("⭐", "⭐⭐", etc.) según el valor actual de $i-->
           </label>
        <br>
        <?php endfor; ?>
        </fieldset>
        <button type="submit">Filtrar</button>
    </form>
    
    <hr>

    <!--seccion de productos filtrados-->
    <section>
        <?php if(empty($productosFiltrados)): ?>
            <p>No hay productos que coincidan con el filtro seleccionado.</p>
        <?php else: ?>
            <?php foreach($productosFiltrados as $producto) : ?>
                <div class="producto">
                    <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
                    <div class="estrella"><?= str_repeat("⭐", $producto['estrellas']) ?></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</body>
</html>