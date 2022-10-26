<section class="logon">
    <h2>Novo administrador</h2>
    
    <form action="../../controller/logon.php" method="POST">
        <input type="hidden" name="admin" value="1" >
        <div>
            <p>Nome</p>
            <input type="text" name="nome" class="input branco" required>
        </div>
        <div>
            <p>Email</p>
            <input type="text" name="email"  class="input branco" required>
        </div>
        <div>
            <p>Senha</p>
            <input type="password" name="senha" class="input branco" required>
        </div>
        <h5>
            <input type="submit" value="Cadastrar-se" class="botao azul">
        </h5>
    </form>
    
</section>