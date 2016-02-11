<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ERPDB";

$conn = mysqli_connect($servername,$username,$password);
$sql = "CREATE DATABASE ".$dbname;
$result = mysqli_query($conn, $sql);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//sql to create table login
$sql = "CREATE TABLE Login(
User VARCHAR(10) PRIMARY KEY,
Password VARCHAR(50) NOT NULL,
Email VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Login created successfully<br />";
} else {
    echo "Error creating table: " . $conn->error."<br />";
}

//sql to create table client
$sql = "CREATE TABLE Clientes(
Id_cliente INT NOT NULL AUTO_INCREMENT,
Nombre_cliente CHAR(50),
Apellido_cliente CHAR(50),
Logo_empresa LONGBLOB NOT NULL,
Nombre_empresa CHAR(50),
Direccion CHAR(70),
Telefono INT(12),
Email CHAR(50),
CONSTRAINT PK PRIMARY KEY (Id_cliente)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Clientes created successfully<br />";
} else {
    echo "Error creating table: " . $conn->error."<br />";
}

// sql to create table Productos
$sql = "CREATE TABLE Productos(
Id_Producto INTEGER(6) NOT NULL,
Denominacion VARCHAR(20) NOT NULL,
Pvp INTEGER(7) NOT NULL,
Precio_Coste INTEGER(6) NOT NULL,
Ubicacion VARCHAR(10) NOT NULL,
Nombre_Proveedor VARCHAR(20) NOT NULL,
Stock INTEGER(7) NOT NULL,
Imagen_Producto VARCHAR(30),
CONSTRAINT PK PRIMARY KEY (Id_Producto)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Productos created successfully<br />";
} else {
    echo "Error creating table: " . $conn->error."<br />";
}

// sql to create table Puestos
$sql = "CREATE TABLE Puestos (
Id_puesto INT AUTO_INCREMENT,
Nombre_puesto VARCHAR (20) NOT NULL,
Salario INT NOT NULL,
Descripcion VARCHAR (100),
Estudios_req VARCHAR (30) NOT NULL,
CONSTRAINT PK PRIMARY KEY (Id_puesto)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Puestos created successfully<br />";
} else {
    echo "Error creating table: " . $conn->error."<br />";
}

// sql to create table Departamentos
$sql = "CREATE TABLE Departamentos (
Id_departamento INT AUTO_INCREMENT,
Nombre_dpto VARCHAR (20) NOT NULL,
CONSTRAINT PK PRIMARY KEY (Id_departamento)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Departamentos created successfully<br />";
} else {
    echo "Error creating table: " . $conn->error."<br />";
}

// sql to create table Contratos
$sql = "CREATE TABLE Contratos (
Id_contrato INT AUTO_INCREMENT,
Nombre_cont VARCHAR (20) NOT NULL,
CONSTRAINT PK PRIMARY KEY (Id_contrato)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Contratos created successfully<br />";
} else {
    echo "Error creating table: " . $conn->error."<br />";
}

// sql to create table Empleados
$sql = "CREATE TABLE Empleados (
Id_empleado INT AUTO_INCREMENT UNIQUE,
Dni VARCHAR (10) NOT NULL,
Nombre VARCHAR (20) NOT NULL,
Apellido1 VARCHAR (20) NOT NULL,
Apellido2 VARCHAR (20) NOT NULL,
Direccion VARCHAR (30) NOT NULL,
Fecha_nacimiento DATE NOT NULL,
Fecha_entrada DATE NOT NULL,
Id_departamento INT NOT NULL,
Id_contrato INT NOT NULL,
Id_puesto_trab INT NOT NULL,

CONSTRAINT PK PRIMARY KEY (Id_empleado),
CONSTRAINT FK FOREIGN KEY (Id_departamento) REFERENCES Departamentos (Id_departamento),
CONSTRAINT FK2 FOREIGN KEY (Id_contrato) REFERENCES Contratos (Id_contrato),
CONSTRAINT FK3 FOREIGN KEY (Id_puesto_trab) REFERENCES Puestos (Id_puesto)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Empleados created successfully<br />";
} else {
    echo "Error creating table: " . $conn->error."<br />";
}

// sql to create table Pedidos
$sql = "CREATE TABLE Pedidos(
Id_pedido INT(10) NOT NULL ,
Fk_Cliente INT(10) NOT NULL ,
Fk_Empleado INT(10) NOT NULL ,
Fk_Producto INT(10) NOT NULL ,
Fecha DATE,
Cantidad INT(10) ,
Subtotal INT(10) ,
CONSTRAINT PK PRIMARY KEY (Id_pedido,
  Fk_Cliente , Fk_Empleado , Fk_Producto , Fecha),
CONSTRAINT FK4 FOREIGN KEY (Fk_Cliente) REFERENCES Clientes (Id_cliente),
CONSTRAINT FK5 FOREIGN KEY (Fk_Empleado) REFERENCES Empleados (Id_empleado),
CONSTRAINT FK6 FOREIGN KEY (Fk_Producto) REFERENCES Productos (Id_Producto)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Pedidos created successfully<br />";
} else {
    echo "Error creating table: " . $conn->error."<br />";
}

// sql to create table Venta
$sql = "CREATE TABLE Ventas(
Id_venta INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Id_pedido INT(6) NOT NULL,
Date_Complete DATE NOT NULL,
CONSTRAINT FK7 FOREIGN KEY (Id_pedido) REFERENCES Pedidos (Id_pedido)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Ventas created successfully<br />";
} else {
    echo "Error creating table: " . $conn->error."<br />";
}

$conn->close();
?>
