## proyecto-webservices

#INGENIERIA WEB Y DE SERVICIOS
Su misión será crear un simple sistema bancario. Piense en su experiencia personal con su cuenta bancaria. En caso de duda, opte por la solución más sencilla. Solo es necesario crear una interfaz de usuario sencilla. El ejercicio evoluciona como una secuencia de iteraciones.
Intente completar cada iteración antes de leer la siguiente.
#¿Qué debe hacer?
#Iteración 1: Crear función de depósito
Siga la siguiente historia de usuario:
Característica: depositar dinero en una cuenta
Como cliente del banco
quiero depositar dinero en mi cuenta
Para aumentar mi saldo
Escenario: un cliente existente deposita dinero en su cuenta
Dado un cliente existente con identificación "Carlos" con $500.000 pesos en su cuenta
Cuando deposita $100.000 pesos en su cuenta
Entonces el saldo de su cuenta es de $600.000 pesos.
#Iteración 2: actualizar la función de depósito
Actualmente, los usuarios pueden depositar cantidades negativas de dinero, lo cual no debe ser posible. Agregue un nuevo caso de prueba para solucionar este problema.
#Iteración 3: agregar la función de retiro
Puede seguir esta historia de usuario:
Característica: retirar dinero de una cuenta
Como cliente del banco quiero retirar dinero de mi cuenta
Para tener efectivo
Escenario: un cliente existente retira dinero de su cuenta
Dado un cliente existente con identificación "Diego" con $100.000 pesos en su cuenta
Cuando retira $10.000 de su cuenta
Entonces el nuevo saldo es de $90.000 pesos.
