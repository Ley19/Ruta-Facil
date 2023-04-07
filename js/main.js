$(function() {
    // Mostrar la tabla de destinos al cargar la página
    $.ajax({
      url: '../Vista/destinos.php',
      type: 'GET',
      success: function(data) {
        $('#tabla-destinos').html(data);
      }
    });
  
    // Manejar el envío del formulario de agregar
    $('#formulario-destino').submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: '../Vista/destinos.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data) {
          $('#tabla-destinos').html(data);
          $('#formulario-destino')[0].reset();
        }
      });
    });
  
    // Manejar el clic en el botón de eliminar
    $(document).on('click', '.btn-eliminar', function() {
      var id = $(this).data('id');
      if (confirm('¿Está seguro de eliminar este destino?')) {
        $.ajax({
          url: 'eliminar_destino.php',
          type: 'POST',
          data: { id: id },
          success: function(data) {
            $('#tabla-destinos').html(data);
          }
        });
      }
    });
  });
  