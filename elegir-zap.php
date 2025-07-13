<?php
$zap = $_GET['zap'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Elegir Zap</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 80px;
            background-color: #f4f4f4;
        }

        form {
            display: inline-block;
            text-align: left;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        input[type="text"], input[type="hidden"] {
            padding: 8px;
            font-size: 16px;
            margin-top: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            margin-top: 12px;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #0056b3;
        }

        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h2>Estás a punto de activar el ZAP <strong><?php echo htmlspecialchars($zap); ?></strong></h2>

    <form action="crear-sitio.php" method="POST">
        <input type="hidden" name="zap" value="<?php echo htmlspecialchars($zap); ?>">
        
        <label>Elige tu subdominio:</label><br>
        <input type="text" name="subdominio" placeholder="ej: mipagina" required><br><br>

        <button type="submit">Crear mi sitio ahora</button>
    </form>

</body>
</html>
