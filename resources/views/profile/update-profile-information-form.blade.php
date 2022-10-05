<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información Personal') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualice la información del perfil y la dirección de correo electrónico de su cuenta.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Foto de perfil') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->us_nombre }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Seleccionar una nueva foto') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Eliminar foto') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Nombre -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="us_nombre" value="{{ __('Nombre') }}" />
            <x-jet-input id="us_nombre" type="text" class="mt-1 block w-full" wire:model.defer="state.us_nombre" autocomplete="us_nombre" />
            <x-jet-input-error for="us_nombre" class="mt-2" />
        </div>

        <!-- Apellido -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="us_apellido" value="{{ __('Apellido') }}" />
            <x-jet-input id="us_apellido" type="text" class="mt-1 block w-full" wire:model.defer="state.us_apellido" autocomplete="us_apellido" />
            <x-jet-input-error for="us_apellido" class="mt-2" />
        </div>

        <!-- Rut -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="us_rut" value="{{ __('RUT') }}" />
            <x-jet-input id="us_rut" type="text" class="mt-1 block w-full" wire:model.defer="state.us_rut" autocomplete="us_rut" disabled />
            <x-jet-input-error for="us_nombre" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="us_telefono" value="{{ __('Teléfono') }}" />
            <x-jet-input id="us_telefono" type="text" class="mt-1 block w-full" wire:model.defer="state.us_telefono" autocomplete="us_telefono" />
            <x-jet-input-error for="us_nombre" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="us_email" value="{{ __('Email') }}" />
            <x-jet-input id="us_email" type="email" class="mt-1 block w-full" wire:model.defer="state.us_email" />
            <x-jet-input-error for="us_email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Su email no está verificado.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900" wire:click.prevent="sendEmailVerification">
                        {{ __('Haga clic aquí para volver a enviar el correo de verificación.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de email.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Guardado.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
