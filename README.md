# api_ubicaciones
metodos
-provincias -> getProvincias() : lista todas las provincias de la tabla
-provincias/{id} -> getPciaxid($id) : lista los datos del idprovincia ingresado
-provincia?nombre ->getPciaxnom($nombre) : lista los datos del nombre ingresado

-partidos -> getPartidos() : lista todos los partidos de la tabla
-partidoss/{idpcia}-> getPartidosxid($idpcia) : lista los partidos para el idprovincia ingresado
-partido/{idpcia,idpartido}-> getPartido($idpcia,$idpartido) : lista los datos del partido para el idpcia e idpartido ingresado

-localidades -> getLocalidades() : lista todas las localidades de la tabla
-localidadess/{idpartido} -> getLocxpartido : lista las localidades para el idpartido ingresado
-localidad/{idpar,idloc} -> getLocalidad($idpar,$idloc) : lista los datos de la localidad y partido ingresado





