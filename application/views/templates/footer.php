            </div>
        </div>
        <footer class="page-footer">
            <div class="container text-center">
                <p><br></p>
                <p class="text-muted">
                    Ciudad Universitaria, Centro de Experimentaci&oacuten de Recursos Instruccionales, Edificio Trasbordo, Escuela de Educaci&oacuten, piso 3 Parroquia San Pedro, Caracas, Venezuela.
                    +58(212)-6052877 y +58(212)-6052979
                    ucv.ee.ceri@gmail.com 2016</p>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2016 Andrés Hevia & Nestor Naranjo
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
        <script src="<?= assets_url(); ?>bower_components/morrisjs/morris.min.js"></script>
        <script src="<?= js_url(); ?>morris-data.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?= assets_url(); ?>dist/js/sb-admin-2.js"></script>
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable({
                    responsive: true
                });
            });
        </script>
    </body>
</html>