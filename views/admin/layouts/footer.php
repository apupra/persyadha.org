</div>
</div>

<?php if (!empty($_SESSION['flash'])): ?>
<script>
Swal.fire({
    icon: '<?= $_SESSION['flash']['type'] ?>', // success, error, warning, info
    title: '<?= $_SESSION['flash']['message'] ?>',
    timer: 2000,
    showConfirmButton: false
});
</script>
<?php unset($_SESSION['flash']); ?>
<?php endif; ?>


<!-- JS -->
<script src="/persyadha.org/assets/admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/persyadha.org/assets/admin/vendors/apexcharts/apexcharts.js"></script>
<script src="/persyadha.org/assets/admin/js/pages/dashboard.js"></script>
<script src="/persyadha.org/assets/admin/js/bootstrap.bundle.min.js"></script>
<script src="/persyadha.org/assets/admin/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
<script src="/persyadha.org/assets/admin/js/main.js"></script>
</body>

</html>