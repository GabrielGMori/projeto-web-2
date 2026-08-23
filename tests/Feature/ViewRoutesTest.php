<?php

it('renders the login page', function () {
    $response = $this->get(route('login'));

    $response->assertOk();
    $response->assertSee('Entrar');
});

it('renders the register page', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
    $response->assertSee('Criar conta');
});

it('renders the livros page for logged in users', function () {
    session(['user' => (object) ['id' => 1, 'username' => 'admin', 'email' => 'admin@ifpr.edu.br']]);

    $response = $this->get(route('livros.index'));

    $response->assertOk();
    $response->assertSee('Livros');
});

it('renders the emprestimos page for logged in users', function () {
    session(['user' => (object) ['id' => 1, 'username' => 'admin', 'email' => 'admin@ifpr.edu.br']]);

    $response = $this->get(route('emprestimos.index'));

    $response->assertOk();
    $response->assertSee('Empréstimos');
});
