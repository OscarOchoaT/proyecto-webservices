# Simple Sistema Bancario - Requisitos

Este proyecto consiste en la creación de un sistema bancario simple, que evolucionará a través de iteraciones para agregar funcionalidades específicas. El objetivo es proporcionar una interfaz de usuario sencilla para realizar operaciones bancarias básicas como depositar y retirar dinero.

## Iteración 1: Crear función de depósito

**Historia de usuario:**
Como cliente del banco, quiero depositar dinero en mi cuenta para aumentar mi saldo.

**Escenario:**
Un cliente existente deposita dinero en su cuenta.
- Dado un cliente existente con identificación "Carlos" con $500.000 pesos en su cuenta.
- Cuando deposita $100.000 pesos en su cuenta.
- Entonces el saldo de su cuenta es de $600.000 pesos.

## Iteración 2: Actualizar la función de depósito

**Objetivo:**
Corregir la posibilidad de depositar cantidades negativas de dinero.

## Iteración 3: Agregar la función de retiro

**Historia de usuario:**
Como cliente del banco, quiero retirar dinero de mi cuenta para tener efectivo.

**Escenario:**
Un cliente existente retira dinero de su cuenta.
- Dado un cliente existente con identificación "Diego" con $100.000 pesos en su cuenta.
- Cuando retira $10.000 de su cuenta.
- Entonces el nuevo saldo es de $90.000 pesos.

Este proyecto seguirá evolucionando con más iteraciones para agregar funcionalidades adicionales según sea necesario.

---

# Plataforma Bancaria De Bajos Recursos - Documentacion

Este proyecto consiste en una aplicación web para gestionar cuentas bancarias de bajos recursos. Permite a los usuarios registrarse, acceder a sus cuentas, realizar transferencias de fondos, agregar y retirar fondos, entre otras funciones.

## Características

### Base de Datos

#### Tabla `usuarios`:

- **id**: Identificador único para cada usuario.
- **usuario**: Nombre del usuario.
- **email**: Correo electrónico del usuario.
- **pass**: Contraseña del usuario (almacenada de manera segura con funciones de hash).
- **numerodecuenta**: Número de cuenta asociado al usuario. Se define como NOT NULL y UNIQUE.

#### Tabla `saldos_cuenta`:

- **id**: Identificador único para cada registro de saldo.
- **numerodecuenta**: Número de cuenta asociado al saldo. Se define como NOT NULL, UNIQUE y como una clave externa (FOREIGN KEY) que referencia al campo `numerodecuenta` en la tabla `usuarios` (ON DELETE CASCADE).
- **saldo**: Saldo asociado a la cuenta. Se define como DECIMAL(10,2) para almacenar valores monetarios con dos decimales de precisión.

### Controladores

- **login.php**: Controla el inicio de sesión de los usuarios.
- **registro.php**: Controla el registro de nuevos usuarios.
- **enviar.php**: Controla el envío de fondos entre cuentas.
- **agregar.php**: Controla la adición de fondos a una cuenta.
- **retirar.php**: Controla el retiro de fondos de una cuenta.
- **logout.php**: Controla la salida de sesión de los usuarios.

### Vistas

Las vistas HTML son utilizadas para mostrar la interfaz de usuario y enviar datos a los controladores. Las principales vistas son:

- **index.php**: Formulario de inicio de sesión.
- **register.php**: Formulario de registro de nuevos usuarios.
- **view/dashboard.php**: Panel de control con opciones para enviar, agregar y retirar fondos.
- **view/enviar.php**: Formulario para enviar fondos a otra cuenta.
- **view/agregar.php**: Formulario para agregar fondos a la cuenta del usuario.
- **view/retirar.php**: Formulario para retirar fondos de la cuenta del usuario.

### UIKit

Este proyecto utiliza UIKit, un framework front-end ligero y modular para la creación de interfaces de usuario. UIKit proporciona una amplia gama de componentes y estilos predefinidos que facilitan el diseño y la creación de sitios web responsivos y atractivos.

- **Documentación de UIKit**: [UIKit Docs](https://getuikit.com/docs/introduction)
- **Repositorio de UIKit en GitHub**: [GitHub - UIKit](https://github.com/uikit/uikit)

## Instalación

1. Clona este repositorio en tu máquina local.
2. Configura un servidor web (por ejemplo, Apache o Nginx) con PHP y MariaDB/MySQL.
3. Importa la estructura de la base de datos desde el archivo `webservices.sql`.
4. Configura las credenciales de la base de datos en el archivo `database/DB.php`.
5. Abre la aplicación en tu navegador y comienza a utilizarla.
