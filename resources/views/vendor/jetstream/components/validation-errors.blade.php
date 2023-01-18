@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">{{ __('Oops! Algo ha salido mal.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                @if ($error = 'auth.failed')
                    <li>Las credenciales son incorrectas.</li>
                @else
                    <li>{{ $error }}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
