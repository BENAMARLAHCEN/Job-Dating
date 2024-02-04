@if (session()->has('success'))
    <div id="alertMessage" class="alert alert-success position-fixed top-0 start-50 translate-middle-x px-4 py-3 rounded-md">
        <p class="mb-0">
            {{ session('success') }}
        </p>
        <button type="button" class="btn-close" aria-label="Close" onclick="closeAlert(this)"></button>
    </div>

    <script>
        setTimeout(function() {
            closeAlert();
        }, 3000);

        function closeAlert() {
            var alertMessage = document.getElementById('alertMessage');
            if (alertMessage) {
                alertMessage.style.display = 'none';
            }
        }
    </script>

@endif
