drop table if exists inscripciones;
drop table if exists usuarios;
drop table if exists actividades;

create table usuarios 
(
  id integer primary key,
  identificador text not null,
  clave text not null,
  nombre text not null,
  email text not null,
  tipo int not null,
  constraint login unique (identificador) 
);

create table actividades
(
  id integer primary key,
  fecha text not null,
  nombre text not null,
  descripcion text not null,
  url text not null
);

create table inscripciones
(
  actividad int,
  usuario int,
  constraint actividad_fk foreign key ( actividad )  references actividades(id),
  constraint usuario_fk foreign key ( usuario )  references usuarios(id),
  constraint inscripciones_pk primary key ( actividad, usuario )
);

