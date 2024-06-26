<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
</head>
<body>
    <h1>Cadastro</h1>
    <form action="adicionar.php">
        <label for="nome">Nome</label><br>
        <input type="string" required placeholder="Ex: João">
        <br>
        <label for="sexo">Sexo</label><br>
        <input type="radio" id="masculino" name="sexo" value="Masculino">
        <label for="masculino">Masculino</label>
        <input type="radio" id="feminino" name="sexo" value="Feminino">
        <label for="feminino">Feminino</label>
        <input type="radio" id="outro" name="sexo" value="Outro">
        <label for="outro">Outro</label>
        <br>
        <label for="telefone">Telefone</label><br>
        <input type="number" required placeholder="Ex: 99999-9999">
        <br>
        <label for="email">Email</label><br>
        <input type="email" required placeholder="Ex: joaozinho@gmail.com">
        <br>
        <label for="senha">Senha</label><br>
        <input type="password" placeholder="Insira uma senha forte">
        <br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>