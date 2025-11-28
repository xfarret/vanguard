@section('title', 'Update Script')
<x-account-wrapper pageTitle="{{ __('Update Script') }}">
    @livewire('scripts.forms.update-form', ['script' => $script])
</x-account-wrapper>
