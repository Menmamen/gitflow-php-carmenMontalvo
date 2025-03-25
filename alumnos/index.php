<?php
include "alumnos/carmenMontalvo.php";

header('Content-Type: text/html; charset=utf-8');

// Conexión a la base de datos
$host = "localhost";
$user = "paises";
$password = "paises";
$dbname = "paises";
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
die("Error de conexión: " . $conn->connect_error);
}

// Configuración de charset para evitar problemas con caracteres especiales
$conn->set_charset("utf8");

// Obtener la lista de países
$paises = $conn->query("SELECT id, nombre, codigo FROM paises ORDER BY nombre ASC");
if (!$paises) {
die("Error al obtener países: " . $conn->error);
}

// Variable para almacenar las provincias seleccionadas
$provincias = [];
$pais_seleccionado = "";
// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pais'])) {
$pais_id = (int)$_POST['pais'];

$pais_seleccionado_query = $conn->query("SELECT codigo FROM paises WHERE
id = $pais_id");
if ($pais_seleccionado_query) {
$pais_seleccionado = $pais_seleccionado_query->fetch_assoc()['codigo']
?? '';
}
// Obtener las provincias del país seleccionado
$stmt = $conn->prepare("SELECT nombre FROM provincias WHERE pais = ? ORDER
BY nombre ASC");
if ($stmt) {
$stmt->bind_param("i", $pais_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$provincias[] = $row['nombre'];
}

} else {
die("Error al preparar la consulta: " . $conn->error);
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Provincias por País</title>
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h1>Código por Carmen Montalvo Luque</h1>
<h1 class="mb-4">Buscar Provincias por País</h1>
<!-- Formulario -->
<form method="POST" action="">
<div class="mb-3">
<label for="pais" class="form-label">País</label>
<select class="form-select" id="pais" name="pais" required>
<option value="">Seleccione un país</option>
<?php while ($row = $paises->fetch_assoc()): ?>
<option value="<?= $row['id']; ?>" <?= $row['id'] ==
($_POST['pais'] ?? '') ? 'selected' : ''; ?>>
<?= htmlspecialchars($row['codigo']); ?>
</option>
<?php endwhile; ?>
</select>
</div>
<button type="submit" class="btn btn-primary">Buscar</button>
</form>
<!-- Resultado -->
<?php if (!empty($provincias)): ?>
<div class="mt-4">
<h3>Provincias de <?= htmlspecialchars($pais_seleccionado);
?>:</h3>
<ul class="list-group">
<?php foreach ($provincias as $provincia): ?>
<li class="list-group-item"><?=
htmlspecialchars($provincia); ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<div class="mt-4 alert alert-warning">No se encontraron provincias
para el país seleccionado.</div>

<?php endif; ?>
</div>
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min
.js"></script>
</body>
</html>