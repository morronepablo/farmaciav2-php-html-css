  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">Morrone Sistemas</a>.</strong> Todos los derechos reservados.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/demo.js"></script>
<!-- sweetalert2 -->
<script src="../js/sweetalert2.js"></script>
<!-- select2 -->
<script src="../js/select2.js"></script>
<script src="../js/datatables.js"></script>
</body>
<script>
	let funcion = 'devolver_avatar';
	$.post('../controlador/UsuarioController.php',{funcion},(response)=>{
		const avatar = JSON.parse(response);
		$('#avatar4').attr('src','../img/'+avatar.avatar);
    $('#avatar3').attr('src','../img/'+avatar.avatar);
	})
  funcion='tipo_usuario';
  $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
    if(response==1){
      $('#gestion_ventas').hide();
      $('#gestion_listar_ventas').hide();
    }
    else if(response==2){
      $('#gestion_lote').hide();
      $('#gestion_usuario').hide();
      $('#gestion_cliente').hide();
      $('#gestion_almacen').hide();
      $('#gestion_ventas').hide();
      $('#gestion_listar_ventas').hide();
      $('#gestion_producto').hide();
      $('#gestion_atributo').hide();
      $('#gestion_compras').hide();
      $('#gestion_proveedor').hide();
      $('#gestion_compra').hide();
    }
  })

</script>
</html>