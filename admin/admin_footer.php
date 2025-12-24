</main> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Small script to highlight the active nav link
  const currentPage = window.location.pathname.split('/').pop();
  if (currentPage === 'admin_dashboard.php') {
    document.getElementById('nav-dashboard').classList.add('active');
  }
</script>
</body>
</html>