<!-- resources/views/some/view.blade.php -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
