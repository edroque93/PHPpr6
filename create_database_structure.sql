create table usuarios 
(
  id int autoincrement,
  identificador text not null,
  clave text not null,
  nombre text not null,
  email text not null,
  tipo int not null,
  constraint usuarios_pk primary key(id)
)

create table actividades
(
  id int autoincrement,
  fecha text not null,
  nombre text not null,
  descripcion text not null,
  url text not null,
  constraint actividades_pk primary key(id)
)

create table inscripciones
(
  actividad int,
  usuario int,
  constraint actividad_fk foreign key ( actividad )  references actividades(id),
  constraint usuario_fk foreign key ( usuario )  references usuarios(id),
  constraint inscripciones_pk primary key ( actividad, usuario )
)

