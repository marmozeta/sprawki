        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
            <div class="auth-box px-5">
                <div class="col-12 bg-white">
                    <div class="p-0">
                         <form method="POST" action="{{ route('login.perform') }}" class="mt-4">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark" for="email">Adres email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email"
                                            placeholder="wpisz swój email" value="{{ old('email') }}" required />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark" for="password">Hasło</label>
                                        <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password"
                                            placeholder="wpisz swoje hasło" required autocomplete="current-password" />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            <div class="col-md-12">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-dark" for="remember">
                                        Zapamiętaj mnie
                                    </label>
                                </div>
                            </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn w-100 btn-dark">Zaloguj się</button>
                                    <input type="hidden" name="return_url" value="{{ url()->current() }}" />
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    <br/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       