<div class="body-header">
    <div class="body-header-content">
        @if (auth()->user() ?? false)
            @php
                $user_role = auth()->user()->role_id;

                if ($user_role == 0) {
                    $role = 'Admin';
                } else if ($user_role == 1) {
                    $role = 'Teknisi';
                } else {
                    $role = 'Client';
                }
            @endphp
        App CV Asia Mandiri - Login Sebagai {{ $role }}
        @else
        App CV Asia Mandiri
        @endif
    </div>
</div>
