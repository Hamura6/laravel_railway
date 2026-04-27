<div>
    <section class=" section section-color-2" style="margin: 0px 0;padding:3rem 0">
        <div class="section-container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card shadow-lg" style="width: 100%; max-width: 530px; border-radius: 12px; padding: 15px;">

                <div align="center" class="row g-1">
                    <div class="text-center mb-3 col-md-12 mt-3">
                        <h3 class="login-title">{{ $institution->name ?? 'ILUSTRE COLEGIO DE ABOGADOS' }}
                        </h3>
                        <img src="{{ $institution->image ?? 'logo' }}" alt="Logo Colegio" style="height: 150px;">
                    </div>

                    <div class="section-header text-center col-md-12 mb-2">
                        <h2 class="section-title fs-4 text-secondary">Iniciar sesión</h2>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div style="display: flex; justify-content: center;">
                    <form style="min-width: 100%;" method="POST" wire:submit="resetPassword">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input wire:model="email" type="email" required autocomplete="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        id="email" value="{{ old('email') }}" required>
                                    <label for="email"><i class="fas fa-envelope"></i> Correo
                                        electrónico</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--                                 <flux:input wire:model="password" :label="__('Password')" type="password" required
                                    autocomplete="new-password" :placeholder="__('Password')" viewable />

                                <!-- Confirm Password -->
                                <flux:input wire:model="password_confirmation" :label="__('Confirm password')"
                                type="password" required autocomplete="new-password"
                                :placeholder="__('Confirm password')" viewable /> --}}


                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" required autocomplete="new-password" wire:model="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        id="password" placeholder="..." autocomplete="current-password">
                                    <label for="password"> <i class="fas fa-key"></i>
                                        {{ __('Password') }}
                                    </label>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" required autocomplete="new-password"
                                        wire:model="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" id="password_confirmation" placeholder="..."
                                        autocomplete="current-password">
                                    <label for="password_confirmation"> <i class="fas fa-key"></i>
                                        {{ __('Confirmar contraseña') }}
                                    </label>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="d-grid gap-2 col-8 mx-auto">
                                <button type="submit" class="btn btn-primary">Restablecer contraseña</button>
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
