<div class="body-header">
    <div class="body-header-content">
        @if (auth()->user() ?? false)
        App CV Asia Mandiri - Login Sebagai {{ auth()->user()->role_id == 0 ? 'Admin' : 'User' }}
        @else
        App CV Asia Mandiri
        @endif
    </div>
</div>
