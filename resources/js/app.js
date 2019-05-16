
/**
 * Requerimos la JavaScript necesario de Bootstrap 4.
 */
require('./bootstrap');



/**
 * A partir de aquí se escribirá el JavaScript de la aplicación
 */

// Agrega el Nombre del primer archivo de al Input de tipo File 
// utilizando jQuery
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
