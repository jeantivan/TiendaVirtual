
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

// Cambiar las pestañas de ordenes en el 
// Dashboard del Administrador
function tabOrder(event, type, color){
    let i, tabcontent, tablinks;

    tabcontent = $('.tabcontent');
    for(i = 0; i < tabcontent.length; i++){
        let tab = tabcontent.eq(i);
        tab.css('display', 'none');
    }

    tablinks = $('.tablink');
    for (i = 0; i < tablinks.length; i++){
        let tab = tablinks.eq(i);
        tab.removeClass('active');
    }

    $(`#${type}`).css('display', 'block');
    $(event.target).addClass('active');
}

// Petición AJAX para agregar productos al carrito de compras
function addToCart(id){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/users/carts',
        type: 'POST',
        data: {
            product_id: id,
        },
    })
    .done(function(response) {
        alert(response.message);
    })
    .fail(function(response) {
        alert('El producto no pudo ser agregado al Carrito.');
        console.log(response);
    });
}

// Petición AJAX para eliminar Un producto del carrito
function deleteFromCart(id){

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `${location.pathname}/${id}`,
        type: 'DELETE',
    })
    .done(function() {
        
        // Si se elimina el producto se elimina la columna del DOM
        $('tr').remove(`#${id}`);
        alert('Producto eliminado con éxito.');
    })
    .fail(function(response) {
        alert('No se pudo eliminar el producto del Carrito.');
        $('button').remove('span');
        console.log(response);
    });
        
}

// Peticion AJAX para Crear Una nueva Categoría
function addCategory(category){
	$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: location.pathname,
        type: 'POST',
        data: {
            category: category,
        },
        success: (response) => {

            let category = 
            `<button
                class="btn btn-danger mx-2 mb-2" 
                data-id=${response.category.id}>
                ${response.category.name}</button>`;
            $('#categories').append(category).fadeIn("slow");
            console.log(response);
        }
    })
    .done(function(response) {
        alert(response.message);
        console.log(response);
    })
    .fail(function(response) {
        if (response.status == 400) {
            alert(response.message);
        } else {
            alert('La categoría no pudo ser creada');
        }
        console.log(response);
        
    });
}

// Verificar el pago de una orden mediante AJAX y jQuery
function verifyPayment(order_id){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin/payments/verified',
        type: 'POST',
        data: {
            order_id: order_id,
        }
    })
    .done(function() {
        alert('El pago ha sido verificado con éxito.');
        
    })
    .fail(function(response) {
        alert('No se logró verificar el pago.')
        console.log(response);
    });    
}

// Verificar el pago de una orden mediante AJAX y jQuery
function orderShipped(order_id){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `${location.pathname}`,
        type: 'PUT',
    })
    .done(function() {
        alert('La orden ha sido marcada como enviada.');
        location.reload();     
    })
    .fail(function(response) {
        alert('La order no se marcó como enviada.')
        console.log(response);
    });    
}

// Agregar el nombre del primer archivo de al input tipo file 
// utilizando jQuery
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


// Agregar Producto al Carrito de compras
$('.add').on('click', function(event){
    event.preventDefault();
	let id = $(this).data('id');
	addToCart(id);
    //alert('Protocol: ' + location.protocol + '\n' + 'Pathname: ' + location.pathname + '\n' + 'Hostname: ' + location.hostname);
    //alert(`${location.protocol + location.hostname}/users/carts`);
});

// Eliminar un Producto del carrito
$('.delete').on('click', function(event){
    event.preventDefault();
    let container = '<span class="spinner-border spinner-border-sm"></span>';
    $(event.target).append(container)
    let id = $(this).data('id');
    deleteFromCart(id);
});


// Agregar categorias con AJAX y jQuery
$('#addCategory').on('submit', function(event) {
    event.preventDefault(); 
    let category = firstCharToUpperCase($('#name').val());
    addCategory(category);
});

// Eliminar categorias con AJAX y jQuery
$('.delete-category').on('click', function(event){
    event.preventDefault();

    let eliminar = confirm('¿Seguro que desea eliminar la categoría?');

    if (eliminar){

        let id = $(this).data('id');
        alert(`${location.pathname}/${id}`)
        deleteCategory(id);

    } else {

        return;

    }

});


// Confirmar el pago de una orden
$('.confirm-payment').on('click', function(event) {
    event.preventDefault();
    
    let payment = confirm('¿Seguro que desea confirmar este pago?');
    if (payment){
        
        let order_id = $(event.target).data('order');
        // Se llama a la función que cambia el estado de la orden
        verifyPayment(order_id);

    } else {
        return;
    }

});

$('#ship').on('click', function (event){
    event.preventDefault();

    let ship = confirm('¿Seguro que desea marcar esta orden como enviada?');

    if (ship){

        let order_id = $(event.target).data('order');
        orderShipped(order_id);

    } else {

        return;
    }
});

// Pestaña de orden que se muestra 
// por defecto en el Dashboard del Administrador
$('#defaultTab').click();

$('.tablink').on('click', function(event){
    event.preventDefault();

    let type = $(event.target).data('type');
    let color = $(event.target).data('color')
    tabOrder(event, type, color);
    
});

// Activar los tooltip de Bootstrap4
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $('body').css('display', 'block').fadeIn('slow');
    $('#loader_container').fadeOut().css('display', 'none');
});

// Preloader
() => {
    $('body').css('display', 'block').fadeIn('slow');
    $('#loader_container').fadeOut().css('display', 'none');
}


