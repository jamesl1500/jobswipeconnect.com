<!-- Alerts -->
<div class="alert-hold">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h2 style="text-align: left;">Errors</h2>
            <ul>
                @foreach($errors->all() as $error)
                    <li style="text-align: left;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif
</div>