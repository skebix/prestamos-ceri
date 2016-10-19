            </div>
        </div>
        <div class="footer-stripe"></div>
        <footer class="page-footer">
            <br>
            <div class="container text-center">
                <div>
                    Ciudad Universitaria, Centro de Experimentaci&oacute;n de Recursos Instruccionales. <br>
                    Edificio Trasbordo, Escuela de Educaci&oacute;n, piso 3.
                    Parroquia San Pedro, Caracas, Venezuela. <br>
                    +58(212)-6052877 y +58(212)-6052979
                    ucv.ee.ceri@gmail.com 2016
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container text-center">
                    © 2016 CERI-PRES
                </div>
            </div>
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?= assets_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Moment.js for bootstrap datetime picker -->
        <script src="<?= js_url(); ?>moment-with-locales.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?= bootstrap_js_url(); ?>bootstrap.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?= js_url(); ?>bootstrap-datetimepicker.js"></script>
        <!-- Homemade JavaScript -->
        <script src="<?= js_url(); ?>scripts.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?= assets_url(); ?>bower_components/metisMenu/dist/metisMenu.min.js"></script>
        <!-- DataTables JavaScript -->
        <script src="<?= assets_url(); ?>bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="<?= assets_url(); ?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
        <!-- Morris Charts JavaScript -->
        <script src="<?= assets_url(); ?>bower_components/raphael/raphael-min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?= assets_url(); ?>dist/js/sb-admin-2.js"></script>
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable({
                    responsive: true
                });
                $('#datatable2').DataTable({
                    responsive: true
                });
                $('#datatable3').DataTable({
                    responsive: true
                });
                $('#datatable4').DataTable({
                    responsive: true
                });
            });
        </script>
    </body>
</html>