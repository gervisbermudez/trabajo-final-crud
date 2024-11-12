$(document).ready(function() {
  $('.add-to-cart').on('click', function() {
      // Obtener los datos del producto
      var productName = $(this).data('name');
      var productPrice = $(this).data('price');

      // Verificar si el producto ya está en el carrito
      var existingProduct = $('#cart-form').find('.product-name').filter(function() {
          return $(this).text().includes(productName);
      });

      // Si el producto ya existe, incrementar la cantidad
      if (existingProduct.length > 0) {
          var quantityInput = existingProduct.closest('.product-item').find('.product-quantity');
          var newQuantity = parseInt(quantityInput.val()) + 1;
          quantityInput.val(newQuantity);
      } else {
          // Si el producto no está en el carrito, agregarlo
          var productHtml = `
              <div class="product-item">
                  <div class="form-group product-name">
                      <label for="product-name" class="font-weight-bold">Producto: ${productName}</label>
                      <input type="hidden" name="product_names[]" value="${productName}">
                  </div>
                  <div class="form-group row">
                      <label for="quantity" class="col-sm-6 col-form-label">Cantidad:</label>
                      <div class="col-sm-6">
                          <input type="number" hidden name="precios[]" value="${productPrice}">
                          <input type="number" class="form-control form-control-sm product-quantity" value="1" min="1" name="quantities[]" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <button type="button" class="btn btn-danger btn-sm remove-product">&times;</button>
                  </div>
              </div>
          `;
          $('#cart-products-list').append(productHtml);
      }

      // Mostrar el formulario del carrito si no está visible
      $('#cart-form-container').show();
  });

  // Evento para eliminar el producto del carrito
  $('#cart-form').on('click', '.remove-product', function() {
      $(this).closest('.product-item').remove();
  });

  // Cuando el usuario haga clic en 'Pedir', agregar productos al formulario para enviarlos
  $('#cart-form').on('submit', function(e) {
      e.preventDefault();  // Evita el envío del formulario

      var products = [];
      $('.product-item').each(function() {
          var productName = $(this).find('.product-name').text().replace('Producto: ', '');
          var quantity = $(this).find('.product-quantity').val();
          products.push({ name: productName, quantity: quantity });
      });

      // Primero, limpiar los campos ocultos del formulario
      $('#cart-form').find('input[type="hidden"]').remove();

      // Añadir los productos como inputs hidden para enviar al servidor
      products.forEach(function(product) {
          var hiddenNameInput = `<input type="hidden" name="product_names[]" value="${product.name}">`;
          var hiddenQuantityInput = `<input type="hidden" name="quantities[]" value="${product.quantity}">`;
          $('#cart-form').append(hiddenNameInput + hiddenQuantityInput);
      });

      // Ahora puedes enviar el formulario
      $('#cart-form')[0].submit(); 
  });


});

//Plugin Carrusel
$(document).ready(function () {
  $(".owl-carousel").owlCarousel();
});

//Plug in acordeon

(function () {
  "use strict";

  // validacion del formulario
  var forms = document.querySelectorAll(".needs-validation");

  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();

//Plug in flipster // ESTO VA EN JS PARA INICIALIZARLO
$(function () {
  var coverflow = $("#coverflow").flipster();
});
