<header class="p-3 mb-4 bg-primary shadow-sm d-flex align-items-center justify-content-around flex-wrap gap-3">
    <a href="{{ route('dashboard') }}"
        class="d-flex align-items-center text-white text-decoration-none me-5 transition-all">
        <img src="{{ asset('images/ifpr-icon.png') }}" alt="Logo Biblioteca" width="45" height="45"
            class="me-3 rounded bg-white p-1 shadow-sm">
        <span class="fs-5 fw-bold mb-0">Biblioteca IFPR</span>
    </a>

    <ul class="nav justify-content-around gap-2 m-0 p-0">
        <li class="nav-item">
            <a href="{{ route('livros.index') }}" class="nav-link px-3 py-2 rounded-pill">Livros</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('emprestimos.index') }}" class="nav-link px-3 py-2 rounded-pill">Empréstimos</a>
        </li>
    </ul>

    <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
        @if (session()->has('user'))
            <div class="d-flex align-items-center text-white">
                <p class="fw-medium text-white text-opacity-75 mb-0">Olá,
                    <span class="fw-bold text-white">{{ session('user')['username'] }}</span>!
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-dark px-3 rounded-pill fw-semibold">Sair</button>
            </form>
        @else
            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-dark px-4 rounded-pill fw-bold border-0 shadow-sm">Entrar</a>
                <a href="{{ route('register') }}"
                    class="btn btn-dark px-4 rounded-pill fw-bold border-0 shadow-sm">Registrar</a>
            </div>
        @endif
    </div>
</header>
