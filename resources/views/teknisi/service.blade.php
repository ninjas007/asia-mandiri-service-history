{{-- @php
    $forms = json_decode($template_service->template->value_form);
@endphp --}}

@if ($template_service->slug == 'service-ac')
    @include('services.ac.index')
@endif


