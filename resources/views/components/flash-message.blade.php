@if (session()->has('message'))
<div id="alertMessage" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
    <p class="inline-block mr-4">
        {{ session('message') }}
    </p>
    <button onclick="closeAlert(this)"
        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300">
        &times;
    </button>
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