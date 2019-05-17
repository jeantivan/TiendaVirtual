
/**
 * Requerimos la JavaScript necesario de Bootstrap 4.
 */
require('./bootstrap');



/**
 * A partir de aquí se escribirá el JavaScript de la aplicación
 */

// Convertir el 1er caracter de una cadena en Mayuscula
function firstCharToUpperCase(string){
	let str = string.toLowerCase();
	str = str.charAt(0).toUpperCase() + str.slice(1);
	return str;
}

// Petición AJAX para agregar productos al carrito de compras
function addToCart(id){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'users/carts',
        type: 'POST',
        data: {
            product_id: id,
        },
    })
    .done(function() {
        alert('Producto agregado al Carrito con éxito.');
    })
    .fail(function() {
        alert('El producto no pudo ser agregado al Carrito.');
    })
    .always(function() {
        console.log("complete");
    });
}

// Petición AJAX para eliminar Un producto del carrito
function deleteFromCart(id){
   
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: window.location.pathname+"/"+ id,
        type: 'DELETE',
        error: function (data){
            console.log(data);
        },
    })
    .done(function() {
        
        // Si se elimina el producto se elimina la columna del DOM
        $('tr').remove(`#${id}`);
        alert('Producto eliminado con éxito.');
    })
    .fail(function() {
        alert('No se pudo eliminar el producto del Carrito.');
        $('button').remove('span');
        console.log("error");
    });
        
}

// Peticion AJAX para Crear Una nueva Categoría
function addCategory(category){
	$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: window.location.pathname,
        type: 'POST',
        data: {
            category: category,
        }
    })
    .done(function(response) {
        alert('Categoría creada con éxito.');
        let category = `<button href="#" class="btn btn-outline-danger mx-2" data-id=${response.id}>
                        ${response.name}</button>`;
        $('#categories').append(category).fadeIn("slow");
    })
    .fail(function(response) {
        alert(response);
    })
    .always(function() {
        console.log("complete");
    });
}

// Agrega el Nombre del primer archivo de al Input de tipo File 
// utilizando jQuery
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


// Agregar Producto al Carrito de compras
$('.add').on('click', function(event){
	let id = $(this).data('id');
	addToCart(id);
});

// Eliminar un Producto del carrito
$('.delete').on('click', function(event){
    $(event.target).append(' <span class="spinner-border spinner-border-sm"></span>')
    let id = $(this).data('id');
    deleteFromCart(id);
});


// Agregar categorias con AJAX y jQuery
$('#addCategory').on('click', function(event) {
    event.preventDefault(); 
    let category = firstCharToUpperCase($('#name').val());
    addCategory(category);
});


