
            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                  <div class="mb-2 mb-md-0">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by
                    <a href="https://naythunaing.netlify.app/" target="_blank" class="footer-link fw-bolder">Nay Thu Naing</a>
                  </div>
                  <div>
                    <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                    <a href="https://github.com/NayThuNaingg" target="_blank" class="footer-link me-4">More About</a>
  
                    <a
                      href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                      target="_blank"
                      class="footer-link me-4"
                      >Documentation</a
                    >
  
                    <a
                      href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                      target="_blank"
                      class="footer-link me-4"
                      >Support</a
                    >
                  </div>
                </div>
              </footer>
              <!-- / Footer -->
  
              <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
          </div>
          <!-- / Layout page -->
        </div>
  
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
      </div>
      <!-- / Layout wrapper -->
  
      <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script src="{{ URL::asset('admin-backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
      <script src="{{ URL::asset('admin-backend/assets/vendor/libs/popper/popper.js') }}"></script>
      <script src="{{ URL::asset('admin-backend/assets/vendor/js/bootstrap.js') }}"></script>
      <script src="{{ URL::asset('admin-backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  
      <script src="{{ URL::asset('admin-backend/assets/vendor/js/menu.js') }}"></script>
      <!-- endbuild -->
  
      <!-- Vendors JS -->
      <script src="{{ URL::asset('admin-backend/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
  
      <!-- Main JS -->
      <script src="{{ URL::asset('admin-backend/assets/js/main.js') }}"></script>
  
      <!-- Page JS -->
      <script src="{{ URL::asset('admin-backend/assets/js/dashboards-analytics.js') }}"></script>
      <!-- Place this tag in your head or just before your close body tag. -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
      @if (session('success_msg'))
      <script>
          Swal.fire({
              position: "mid",
              icon: "success",
              title: "Successful.",
              showConfirmButton: false,
              timer: 1500
          });
      </script>
      @endif

      @if (session('error_msg'))
      <script>
          Swal.fire({
              position: "mid",
              icon: "error",
              title: "Something Wrong!",
              showConfirmButton: false,
              timer: 1500
          });
      </script>
      @endif

      <script>
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });
        })();

    </script>
    <script>
      $(document).ready(function () {
          $('.profile').on('change', function () {
              var file_length = document.getElementById('profile').files.length;
              $('.preview-img').html('');
              for (var i = 0; i < file_length; i++) {
                  $('.preview-img').append(`<img
                            src="${URL.createObjectURL(event.target.files[i])}"
                            alt="user-avatar"
                            class="d-block rounded"
                            height="130"
                            width="130"
                            id="uploadedAvatar"
                            name="file" required 
                            />`);
              }
          });
      });
    </script>
    </body>
  </html>