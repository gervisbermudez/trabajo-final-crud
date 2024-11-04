

$(document).ready(function () {
  for (let i = 0; i < productos.length; i++) {
    $("#productos").append(
      '<div class= "col">' +
      '<div class="card sc-product-item">' +
      '<img data-name="product_image" src="img/' + productos[i].foto + '"class="card-img-top" alt="' + productos[i].nombre + '">' +
      '<div class="card-body">' +
      '<h2 data-name="product_name" class="card-title">' + productos[i].nombre + '</h2>' +
      '<p data-name=product_desc class="card-text">' + productos[i].descripcion + '</p>' +
      '<p class="card-text">$' + productos[i].precio + '</p>' +
      '<input name="product_price" value="' + productos[i].precio + '" type="hidden" />' +
      '<input name="product_id" value="' + productos[i] + '" type="hidden" />' +
      '<button class="sc-add-to-cart btn btn-dark text-light">Agregar</button>' +
      '</div>' +
      '</div>' +
      '</div>'
    );
  } 
  $('#smartcart').smartCart({
    cartItemTemplate: '<h3 class="h6 list-group-item-heading">{product_name}</h3>',
    lang: {
      cartTitle: "Tu pedido",
      checkout: 'Pedir',
      clear: 'Borrar',
      subtotal: 'Subtotal:',
      cartRemove: 'x',
      cartEmpty: 'Nada en tu carrito!<br />Elige tus productos',
    }
  
  })
})

//Plugin Smart



//Plugin Carrusel
$(document).ready(function () {

  $(".owl-carousel").owlCarousel();

});

//plugin Whatsapp

$(function () {
  $('.floating-wpp').floatingWhatsApp({
    phone: '1123894930',
    popupMessage: 'Mandanos un WhatsApp',
    showPopup: true,
    message: 'Hola, me gustaria comunicarme con ustedes',
    headerTitle: 'Wonderland'
  });
});

//Plug in acordeon



(function () {
  'use strict'

  // validacion del formulario 
  var forms = document.querySelectorAll('.needs-validation')


  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

//Plug in flipster // ESTO VA EN JS PARA INICIALIZARLO
$(function(){
  var coverflow = $("#coverflow").flipster();
});


