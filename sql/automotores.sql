/********************************************* CONFIGURACION ********************************************************/
CREATE TABLE ISAU_Accion (
	id_accion int primary key identity,
	descripcion varchar(50) NOT NULL,
	activo bit NOT NULL default 1
);

CREATE TABLE ISAU_Pregunta (
	id_pregunta int primary key identity,
	descripcion varchar(100) NOT NULL,
	activo bit NOT NULL default 1
);

CREATE TABLE ISAU_Rol (
	id_rol int primary key identity,
	descripcion varchar(100) NOT NULL,
	activo bit NOT NULL default 1
);

CREATE TABLE ISAU_RolAccion(
	id_rol int NOT NULL,
	id_accion int NOT NULL,
	modifica bit NOT NULL default 1,
	primary key (id_rol,id_accion)
);

CREATE TABLE ISAU_Usuario(
	id_usuario int primary key IDENTITY,
	usuario varchar(20) NOT NULL,
	correo varchar(100) NOT NULL,
	cedula varchar(15) NOT NULL,
	clave varchar(100) NOT NULL,
	nombre nvarchar(100) NOT NULL,
	apellido varchar(100) NOT NULL,
	sexo char(1) NOT NULL DEFAULT 'M',
	respuesta_seguridad varchar(1000) NULL,
	fecha_registro datetime NOT NULL DEFAULT (getdate()),
	telefono varchar(20) NULL,
	activo bit NOT NULL DEFAULT 1,
	id_rol int NOT NULL,
	id_pregunta int NULL,
	CodUbic varchar(10) not null,
);

CREATE TABLE ISAU_Registro (
	id_registro numeric(20, 0) primary key IDENTITY,
	usuario varchar(50) NOT NULL,
	comentario text NULL,
	pagina varchar(100) NOT NULL,
	fecha datetime NOT NULL default GETDATE(),
	ip varchar(20) NOT NULL,
	equipo varchar(100) NOT NULL
);

/********************************************* AUTOMOTORES **********************************************************/
create table ISAU_Alianza (
	id_alianza int primary key identity,
	CodProv varchar(15) not null,
	Descrip varchar(60) null,
	porcentaje numeric(5,2) not null default 0,
	activo bit not null default 1);

create table ISAU_Vehiculo (
	id_vehiculo	int primary key identity,
	id_modelo int not null,
	id_tipo_vehiculo int not null,
	id_marca int not null,
	nro_puestos int default 4,
	placa varchar(10) not null,
	anio varchar(4) not null,
	color varchar(50) null,
	serial_carroceria varchar(100) null,
	serial_motor varchar(100) null,
	venta varchar(100) null,
	propietario varchar(15) not null default '00000',
	activo bit not null default 1);

create table ISAU_Modelo (
	id_modelo int primary key identity,
	descripcion varchar(100) not null,
	activo bit not null default 1);

create table ISAU_Marca (
	id_marca int primary key identity,
	descripcion varchar(100) not null,
	activo bit not null default 1);

create table ISAU_TipoVehiculo (
	id_tipo_vehiculo int primary key identity,
	descripcion varchar(100) not null,
	activo bit not null default 1);

create table ISAU_Inspeccion (
	id_inspeccion int primary key identity,
	descripcion varchar(100) not null,
	activo bit not null default 1);

create table ISAU_TransaccionInspeccion (
	id_inspeccion int not null,
	id_transaccion int not null,
	observacion varchar(100) not null default '');

create table ISAU_AlianzaTransaccion (
	id_at int primary key identity, 
	id_alianza int not null,
	id_transaccion int not null,
	nro_factura varchar(25) not null,
	fecha datetime not null,
	nro_control varchar(25) not null,
	CodProv varchar(15) not null,
	almacenista int not null,
	total numeric(12,2) not null default 0,
	activo bit not null default 1);

create table ISAU_DetalleAlianzaTransaccion (
	id_dat int primary key identity,
	id_at int not null,
	CodProd varchar(15) not null,
	descripcion varchar(300) not null,
	CodTaxs varchar(5) not null,
	cantidad numeric(12,2) not null default 0,
	costo numeric(12,2) not null default 0,
	tax numeric(12,2) not null default 0,
	total numeric(12,2) not null default 0,
	activo bit not null default 1);

create table ISAU_Transaccion (
	id_transaccion int primary key identity,
	id_vehiculo int not null,
	fecha_transaccion datetime not null default GETDATE(),
	fecha datetime not null default GETDATE(),
	hora varchar(4) not null default '0000',
	asesor int not null,
	km numeric(10,2) not null default 0,
	representante varchar(15) not null,
	pagador varchar(15) not null,
	numero_atencion smallint default 1,
	gravable numeric(12,2) not null default 0,
	exento numeric(12,2) not null default 0,
	tax numeric(12,2) not null default 0,
	total numeric(12,2) not null default 0,
	observacion varchar(2000) null,
	observacion3 varchar(2000) null,
	activo bit not null default 1);
	
create table ISAU_DetalleTransaccion (
	id_detalle_transaccion int primary key identity,
	id_transaccion int not null,
	EsServ bit not null default 1,
	CodItem varchar(15) not null,
	descripcion varchar(300) not null,
	cantidad numeric(12,2) not null default 0,
	costo numeric(12,2) not null default 0,
	total numeric(12,2) not null default 0,
	activo bit not null default 1);

create table ISAU_TaxDetalleTransaccion (
	id_tdt int primary key identity,
	id_detalle_transaccion int not null,
	CodItem varchar(15) not null,
	CodTaxs varchar(5) not null,
	monto numeric(12,2) not null default 0,
	gravable numeric(12,2) not null default 0,
	mtotax numeric(12,2) not null default 0);

create table ISAU_TaxTransaccion (
	id_tdt int primary key identity,
	id_transaccion int not null,
	CodTaxs varchar(5) not null,
	monto numeric(12,2) not null default 0,
	gravable numeric(12,2) not null default 0,
	mtotax numeric(12,2) not null default 0);

create table ISAU_TallerTransaccion (
	id_taller int primary key identity,
	id_transaccion int not null,
	fecha_transaccion datetime not null default GETDATE(),
	CodMeca varchar(10) not null,
	asignador int not null,
	observacion varchar(2000) null,
	activo bit not null default 1);
	
create table ISAU_SolicitudTransaccion (
	id_solicitud int primary key identity,
	id_transaccion int not null,
	almacenista int not null,
	CodProd varchar(15) not null,
	cantidad smallint not null default 1,
	activo bit not null default 1);

/*---------------------------------------------------------- ALTER TABLES ------------------------------------------------------*/
ALTER TABLE ISAU_RolAccion ADD CONSTRAINT fk_rol_accion01 FOREIGN KEY (id_rol) REFERENCES ISAU_Rol (id_rol) ON DELETE CASCADE;
ALTER TABLE ISAU_RolAccion ADD CONSTRAINT fk_rol_accion02 FOREIGN KEY (id_accion) REFERENCES ISAU_Accion (id_accion) ON DELETE CASCADE;

ALTER TABLE ISAU_Usuario ADD CONSTRAINT fk_usuario_rol FOREIGN KEY (id_rol) REFERENCES ISAU_Rol (id_rol);
ALTER TABLE ISAU_Usuario ADD CONSTRAINT fk_usuario_pregunta FOREIGN KEY (id_pregunta) REFERENCES ISAU_Pregunta(id_pregunta);
ALTER TABLE ISAU_Usuario add unique (usuario);

alter table ISAU_Alianza add constraint fk_AlianzaSaprov foreign key (CodProv) references SAPROV(CodProv) on update cascade;

alter table ISAU_AlianzaTransaccion add constraint fk_AlianzaTransaccion1 foreign key (id_alianza) references ISAU_Alianza(id_alianza) on update cascade;
alter table ISAU_AlianzaTransaccion add constraint fk_AlianzaTransaccion2 foreign key (id_transaccion) references ISAU_Transaccion(id_transaccion) on update cascade;

alter table ISAU_DetalleAlianzaTransaccion add constraint fk_dat1 foreign key (id_at) references ISAU_AlianzaTransaccion(id_at) on update cascade;

alter table ISAU_Transaccion add constraint fk_TransaccionVehiculo1 foreign key (id_vehiculo) references ISAU_Vehiculo(id_vehiculo) on update cascade;

alter table ISAU_Vehiculo add constraint fk_VehiculoModelo foreign key (id_modelo) references ISAU_Modelo(id_modelo) on update cascade;
alter table ISAU_Vehiculo add constraint fk_VehiculoTipo foreign key (id_tipo_vehiculo) references ISAU_TipoVehiculo(id_tipo_vehiculo) on update cascade;
alter table ISAU_Vehiculo add constraint fk_VehiculoMarca foreign key (id_marca) references ISAU_Marca(id_marca) on update cascade;

alter table ISAU_TransaccionInspeccion add constraint fk_TransaccionInspeccion1 foreign key (id_inspeccion) references ISAU_Inspeccion(id_inspeccion) on update cascade;
alter table ISAU_TransaccionInspeccion add constraint fk_TransaccionInspeccion2 foreign key (id_transaccion) references ISAU_Transaccion(id_transaccion) on update cascade;

alter table ISAU_SolicitudTransaccion add constraint fk_SolicitudTransaccion1 foreign key (id_transaccion) references ISAU_Transaccion(id_transaccion) on update cascade;
alter table ISAU_SolicitudTransaccion add constraint fk_SolicitudTransaccion2 foreign key (almacenista) references ISAU_Usuario(id_usuario) on update cascade;

alter table ISAU_TallerTransaccion add constraint fk_TallerTransaccion foreign key (id_transaccion) references ISAU_Transaccion(id_transaccion) on update cascade;

alter table ISAU_DetalleTransaccion add constraint fk_DetalleTransaccion foreign key (id_transaccion) references ISAU_Transaccion(id_transaccion) on update cascade;

alter table ISAU_TaxTransaccion add constraint fk_TaxTransaccion foreign key (id_transaccion) references ISAU_Transaccion(id_transaccion) on update cascade;

alter table ISAU_TaxDetalleTransaccion add constraint fk_TaxDetalleTransaccion foreign key (id_detalle_transaccion) references ISAU_DetalleTransaccion(id_detalle_transaccion) on update cascade on delete cascade;

/*---------------------------------------------------------- INSERTS -------------------------------------------------------------*/
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Frente'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Izquierda'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Derecha'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Atras'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Antena'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Alfombra'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Caucho de Repuesto'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Gato'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Extintor'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Radio Reproductor'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Llave de Rueda'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Encendedor'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Triángulo'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Tapa de Gas'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Tapa de Rueda'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('A / C'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Luces'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Rectrovisores'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Tapa de Motor'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Limpia parabrisas'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Logos'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Cerraduras'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Lavavidrios'); 
INSERT INTO ISAU_Inspeccion(descripcion) VALUES ('Otros'); 

INSERT INTO ISAU_Pregunta(descripcion) VALUES ('Lugar de Nacimiento');
INSERT INTO ISAU_Pregunta(descripcion) VALUES ('Segundo nombre de su Padre');
INSERT INTO ISAU_Pregunta(descripcion) VALUES ('Segundo nombre de su Madre');
INSERT INTO ISAU_Pregunta(descripcion) VALUES ('Héroe de infancia');
INSERT INTO ISAU_Pregunta(descripcion) VALUES ('Lugar de Luna de miel');

INSERT INTO ISAU_Rol(descripcion) VALUES ('En Espera');
INSERT INTO ISAU_Rol(descripcion) VALUES ('Usuario');
INSERT INTO ISAU_Rol(descripcion) VALUES ('Administrador');

INSERT INTO ISAU_Usuario(usuario,correo,cedula,clave,nombre,apellido,sexo,respuesta_seguridad,id_pregunta,id_rol, CodUbic) 
VALUES ('001','nada@nada.com','123456','9df3bb42df815f39041a621f7282a475','Innova','Administrador','M','CCS',1,3,'01');

INSERT INTO ISAU_Accion(Descripcion) VALUES ('accion-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('accion-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('accion-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('accion-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('accion-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('rol-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('rol-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('rol-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('rol-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('rol-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('rol-accion-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('rol-accion-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('rol-accion-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('rol-accion-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('rol-accion-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('site-recuperar');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('site-activar');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('marca-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('marca-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('marca-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('marca-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('marca-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('modelo-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('modelo-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('modelo-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('modelo-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('modelo-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('tipo-vehiculo-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('tipo-vehiculo-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('tipo-vehiculo-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('tipo-vehiculo-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('tipo-vehiculo-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('cliente-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('cliente-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('cliente-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('cliente-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('cliente-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('proveedor-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('proveedor-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('proveedor-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('proveedor-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('proveedor-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('alianza-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('alianza-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('alianza-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('alianza-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('alianza-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('producto-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('producto-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('producto-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('producto-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('producto-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('servicio-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('servicio-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('servicio-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('servicio-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('servicio-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('vehiculo-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('vehiculo-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('vehiculo-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('vehiculo-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('vehiculo-update');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-imprime-orden');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-solicitud');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-solicitud-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-taller');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-taller-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-cerrar');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-cerrar-orden');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-abrir');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-abrir-orden');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('alianza-transaccion-create');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('alianza-transaccion-view');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('alianza-transaccion-index');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('alianza-transaccion-delete');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('alianza-transaccion-update');
INSERT INTO ISAU_Accion(descripcion) VALUES ('alianza-transaccion-buscar-detalle-orden');
INSERT INTO ISAU_Accion(descripcion) VALUES ('alianza-transaccion-buscar-at');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-buscar-inspeccion');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-buscar-cliente');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-buscar-vehiculo');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-buscar-vehiculo-activo');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-buscar-items');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-buscar-impuestos');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-buscar-detalle-solicitud');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-buscar-detalle-taller');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-buscar-orden');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-buscar-numero');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-imprime-orden');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-consulta-estatus');
INSERT INTO ISAU_Accion(descripcion) VALUES ('transaccion-flujo_transaccion');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('transaccion-index');
INSERT INTO ISAU_Accion(descripcion) VALUES ('rol-accion-buscar-accion');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('vw-resumen-orden-reporte-ordenes');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('vw-resumen-orden-buscar-orden');
INSERT INTO ISAU_Accion(Descripcion) VALUES ('vw-resumen-orden-imprime-resumen');

INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,1,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,2,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,3,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,4,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,5,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,6,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,7,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,8,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,9,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,10,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,11,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,12,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,13,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,14,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,15,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,16,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,17,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,18,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,19,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,20,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,21,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,22,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,23,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,24,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,25,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,26,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,27,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,28,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,29,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,30,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,31,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,32,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,33,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,34,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,35,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,36,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,37,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,38,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,39,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,40,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,41,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,42,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,43,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,44,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,45,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,46,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,47,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,48,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,49,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,50,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,51,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,52,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,53,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,54,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,55,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,56,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,57,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,58,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,59,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,60,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,61,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,62,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,63,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,64,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,65,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,66,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,67,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,68,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,69,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,70,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,71,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,72,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,73,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,74,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,75,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,76,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,77,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,78,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,79,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,80,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,81,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,82,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,83,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,84,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,85,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,86,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,87,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,88,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,89,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,91,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,92,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,93,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,94,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,95,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,96,1);
INSERT INTO ISAU_RolAccion(id_rol,id_accion,modifica) VALUES (3,97,1);


/*---------------------------------------------------------- VIEWS -------------------------------------------------------------*/
create view vw_resumen_transaccion as
SELECT        t.id_transaccion, t.numero_atencion, FORMAT(t.fecha, 'dd-MM-yyyy') AS fecha, FORMAT(t.fecha, 'yyyyMMdd') AS fechae,
t.hora, t.km, t.gravable, t.exento, t.tax, t.total, t.pagador,t.representante, u.nombre, u.CodUbic, v.placa, v.anio,
v.color, m.descripcion AS marca, mo.descripcion AS modelo, ti.descripcion AS tipo,sa1.Descrip AS nombre_representante,
sa1.Movil, sa1.Email,sa2.Descrip AS nombre_pagador
FROM dbo.ISAU_Transaccion AS t 
INNER JOIN dbo.ISAU_Usuario AS u ON t.asesor = u.id_usuario 
INNER JOIN dbo.ISAU_Vehiculo AS v ON t.id_vehiculo = v.id_vehiculo 
INNER JOIN dbo.ISAU_Marca AS m ON v.id_marca = m.id_marca 
INNER JOIN dbo.ISAU_Modelo AS mo ON v.id_modelo = mo.id_modelo 
INNER JOIN dbo.ISAU_TipoVehiculo AS ti ON v.id_tipo_vehiculo = ti.id_tipo_vehiculo 
INNER JOIN dbo.SACLIE AS sa1 ON t.representante = sa1.CodClie 
INNER JOIN dbo.SACLIE AS sa2 ON t.pagador = sa2.CodClie;

create view vw_resumen_orden as
SELECT        t.id_transaccion, t.numero_atencion, FORMAT(t.fecha, 'dd-MM-yyyy') AS fecha, FORMAT(t.fecha, 'yyyyMMdd') AS fechae, t.fecha_transaccion,
    t.hora, t.km, t.gravable, t.exento, t.tax, t.total, t.pagador, t.representante, u.nombre as nombre_asesor, u.CodUbic, v.placa, v.anio,
    v.color, m.descripcion AS marca, mo.descripcion AS modelo, ti.descripcion AS tipo, sa1.Descrip AS nombre_representante, sa1.Movil, sa1.Email, sa2.Descrip AS nombre_pagador,
    t.observacion,t.observacion3,t.activo,v.nro_puestos,v.serial_carroceria,v.serial_motor,v.id_marca,v.id_modelo,t.asesor,v.id_tipo_vehiculo
FROM dbo.ISAU_Transaccion AS t
    INNER JOIN dbo.ISAU_Usuario AS u ON t.asesor = u.id_usuario
    INNER JOIN dbo.ISAU_Vehiculo AS v ON t.id_vehiculo = v.id_vehiculo
    INNER JOIN dbo.ISAU_Marca AS m ON v.id_marca = m.id_marca
    INNER JOIN dbo.ISAU_Modelo AS mo ON v.id_modelo = mo.id_modelo
    INNER JOIN dbo.ISAU_TipoVehiculo AS ti ON v.id_tipo_vehiculo = ti.id_tipo_vehiculo
    INNER JOIN dbo.SACLIE AS sa1 ON t.representante = sa1.CodClie
    INNER JOIN dbo.SACLIE AS sa2 ON t.pagador = sa2.CodClie