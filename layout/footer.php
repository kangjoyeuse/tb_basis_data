    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- DataTables JavaScript-->
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script> 

<div class="container">
  <footer class="py-3 my-4">
    <p class="text-center text-body-secondary">© 2024 Company, Inc</p>
  </footer>
</div>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "columnDefs": [
                    { "type": "num-fmt", "targets": [2, 3] } // Assuming the columns for Anggaran and Realisasi Anggaran are 2 and 3
                ],
                "order": [[2, "asc"]] // Default sorting on the Anggaran column in ascending order
            });
        });
    </script>
    </body>
</html>