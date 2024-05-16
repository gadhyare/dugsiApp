<div>
    <div class="container d-flex justify-content-center align-items-center vh-100 ">
        <div class="card    border-0 shadow-lg col-xs-12 col-sm-12 col-md-4 rounded">
            <div class="card-header  bg-white border-0">
                <p class="text-white h1 text-center"><i class="fa-solid fa-lock rounded-circle bg-success p-5 border"></i>
                </p>
                <h3 class="text-center ">
                    <p> صفحة الإدارة </p>
                </h3>
            </div>
            <div class="card-body ">
                <form  >
                    @csrf
                    <div class="form-group py-1">
                        <label for="email" class="text-md-end"> البريد الإلكتروني </label>

                        <input id="email" type="email"
                            class="form-control rounded-0 border border-end-0 border-start-0 border-top-0 bg-white  py-1 @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  wire:model.live.debounce.300="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group py-1">
                        <label for="password" class="text-md-end"> كلمة المرور </label>
                        <input id="password" type="password"
                            class="form-control rounded-0  border border-end-0 border-start-0 border-top-0 bg-white  py-1 @error('password') is-invalid @enderror"
                              required autocomplete="password" wire:model.live.debounce.300="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group py-1">
                        <input class="form-check-input p-2" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label " for="remember">
                            تذكرني
                        </label>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn bg-green-500 text-green-100 fw-bold col-12 m-auto" wire:click.prevent="login"  >
                             <div class="spinner-border border-red-100  spinner-border-sm" role="status" wire:loading wire:target="login"  >
  <span class="visually-hidden ">Loading...</span>
                             </div>
                            <span class="h3"> دخول </span>
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                نسيتُ كلمة المرور
                            </a>
                        @endif
                    </div>
                </form>
                @if ($message)
                    <div class="bg-red-300 py-2 fw-bold rounded-0 mt-2 px-3  text-center">{{$message}}</div>
                @endif
            </div>
        </div>
    </div>
</div>
