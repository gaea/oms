drop table CANCION;

drop table CUNIA_COMERCIAL;

drop table MENSAJE;

drop table PERFIL;

drop table PERSONA;

drop table PROGRAMACION_CANCION;

drop table PROGRAMACION_CUNA;

drop table TIPO_IDENTIFICACION;

drop table USUARIO;

drop table VENTA;

drop table VENTA_CANCION;

drop table VENTA_CUNIA_COMERCIAL;

/*==============================================================*/
/* Table: CANCION                                               */
/*==============================================================*/
create table CANCION (
   CODIGO               SERIAL               not null,
   NOMBRE               VARCHAR(200)         null,
   AUTOR                VARCHAR(200)         null,
   ALBUM                VARCHAR(200)         null,
   FECHA_DE_PUBLICACION DATE                 null,
   DURACION             TIME                 null,
   URL                  VARCHAR(200)         null,
   HABILITADA           BOOL                 null,
   PRECIO               DECIMAL              null,
   RANKING              INTEGER              null,
   constraint PK_CANCION primary key (CODIGO)
);

/*==============================================================*/
/* Table: CUNIA_COMERCIAL                                       */
/*==============================================================*/
create table CUNIA_COMERCIAL (
   CODIGO               SERIAL               not null,
   NOMBRE               VARCHAR(200)         null,
   DURACION             TIME                 null,
   URL                  VARCHAR(200)         null,
   HABILITADA           BOOL                 null,
   FECHA_CREACION       DATE                 null,
   USUARIO              INTEGER              null,
   constraint PK_CUNIA_COMERCIAL primary key (CODIGO)
);

/*==============================================================*/
/* Table: MENSAJE                                               */
/*==============================================================*/
create table MENSAJE (
   CODIGO               SERIAL               not null,
   USUARIO              INTEGER              not null,
   ASUNTO               VARCHAR(200)         null,
   MENSAJE              TEXT                 null,
   constraint PK_MENSAJE primary key (CODIGO)
);

/*==============================================================*/
/* Table: PERFIL                                                */
/*==============================================================*/
create table PERFIL (
   CODIGO               SERIAL               not null,
   NOMBRE               VARCHAR(200)         not null,
   DESCRIPCION          VARCHAR(200)         null,
   constraint PK_PERFIL primary key (CODIGO)
);

/*==============================================================*/
/* Table: PERSONA                                               */
/*==============================================================*/
create table PERSONA (
   CODIGO               SERIAL               not null,
   NOMBRE               VARCHAR(200)         not null,
   APELLIDO             VARCHAR(200)         null,
   IDENTIFICACION       VARCHAR(200)         null,
   TIPO_IDENTIFICACION  INTEGER              null,
   DIRECCION            VARCHAR(200)         null,
   TELEFONO             VARCHAR(200)         null,
   E_MAIL               VARCHAR(200)         null,
   HABILITADO           BOOL                 not null,
   USUARIO              INTEGER              null,
   constraint PK_PERSONA primary key (CODIGO)
);

/*==============================================================*/
/* Table: PROGRAMACION_CANCION                                  */
/*==============================================================*/
create table PROGRAMACION_CANCION (
   CANCION              INTEGER              not null,
   VENTA                INTEGER              not null,
   FECHA                DATE                 not null,
   INICIO               TIME                 not null,
   FIN                  TIME                 not null,
   constraint PK_PROGRAMACION_CANCION primary key (CANCION, VENTA, FECHA, INICIO, FIN)
);

/*==============================================================*/
/* Table: PROGRAMACION_CUNA                                     */
/*==============================================================*/
create table PROGRAMACION_CUNA (
   VENTA                INTEGER              not null,
   CUNIA_COMERCIAL      INTEGER              not null,
   FECHA                DATE                 not null,
   INICIO               TIME                 not null,
   FIN                  TIME                 not null,
   constraint PK_PROGRAMACION_CUNA primary key (VENTA, CUNIA_COMERCIAL, FECHA, INICIO, FIN)
);

/*==============================================================*/
/* Table: TIPO_IDENTIFICACION                                   */
/*==============================================================*/
create table TIPO_IDENTIFICACION (
   CODIGO               SERIAL               not null,
   NOMBRE               VARCHAR(200)         null,
   DESCRIPCION          VARCHAR(200)         null,
   constraint PK_TIPO_IDENTIFICACION primary key (CODIGO)
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO (
   CODIGO               SERIAL               not null,
   USUARIO              VARCHAR(200)         not null,
   CONTRASENA           VARCHAR(200)         not null,
   PERFIL               INTEGER              null,
   constraint PK_USUARIO primary key (CODIGO)
);

/*==============================================================*/
/* Table: VENTA                                                 */
/*==============================================================*/
create table VENTA (
   CODIGO               SERIAL               not null,
   USUARIO              INTEGER              not null,
   PRECIO               DECIMAL              null,
   FECHA_VENTA          TIMESTAMP            null,
   constraint PK_VENTA primary key (CODIGO)
);

/*==============================================================*/
/* Table: VENTA_CANCION                                         */
/*==============================================================*/
create table VENTA_CANCION (
   CANCION              INTEGER              not null,
   VENTA                INTEGER              not null,
   constraint PK_VENTA_CANCION primary key (CANCION, VENTA)
);

/*==============================================================*/
/* Table: VENTA_CUNIA_COMERCIAL                                 */
/*==============================================================*/
create table VENTA_CUNIA_COMERCIAL (
   VENTA                INTEGER              not null,
   CUNIA_COMERCIAL      INTEGER              not null,
   constraint PK_VENTA_CUNIA_COMERCIAL primary key (VENTA, CUNIA_COMERCIAL)
);

alter table CUNIA_COMERCIAL
   add constraint FK_CUNIA_CO_REFERENCE_USUARIO foreign key (USUARIO)
      references USUARIO (CODIGO)
      on delete restrict on update restrict;

alter table MENSAJE
   add constraint FK_MENSAJE_REFERENCE_USUARIO foreign key (USUARIO)
      references USUARIO (CODIGO)
      on delete restrict on update restrict;

alter table PERSONA
   add constraint FK_PERSONA_REFERENCE_TIPO_IDE foreign key (TIPO_IDENTIFICACION)
      references TIPO_IDENTIFICACION (CODIGO)
      on delete restrict on update restrict;

alter table PERSONA
   add constraint FK_PERSONA_REFERENCE_USUARIO foreign key (USUARIO)
      references USUARIO (CODIGO)
      on delete restrict on update restrict;

alter table PROGRAMACION_CANCION
   add constraint FK_PROGRAMA_REFERENCE_VENTA_CA foreign key (CANCION, VENTA)
      references VENTA_CANCION (CANCION, VENTA)
      on delete restrict on update restrict;

alter table PROGRAMACION_CUNA
   add constraint FK_PROGRAMA_REFERENCE_VENTA_CU foreign key (VENTA, CUNIA_COMERCIAL)
      references VENTA_CUNIA_COMERCIAL (VENTA, CUNIA_COMERCIAL)
      on delete restrict on update restrict;

alter table USUARIO
   add constraint FK_USUARIO_REFERENCE_PERFIL foreign key (PERFIL)
      references PERFIL (CODIGO)
      on delete restrict on update restrict;

alter table VENTA
   add constraint FK_VENTA_REFERENCE_USUARIO foreign key (USUARIO)
      references USUARIO (CODIGO)
      on delete restrict on update restrict;

alter table VENTA_CANCION
   add constraint FK_VENTA_CA_REFERENCE_CANCION foreign key (CANCION)
      references CANCION (CODIGO)
      on delete restrict on update restrict;

alter table VENTA_CANCION
   add constraint FK_VENTA_CA_REFERENCE_VENTA foreign key (VENTA)
      references VENTA (CODIGO)
      on delete restrict on update restrict;

alter table VENTA_CUNIA_COMERCIAL
   add constraint FK_VENTA_CU_REFERENCE_CUNIA_CO foreign key (CUNIA_COMERCIAL)
      references CUNIA_COMERCIAL (CODIGO)
      on delete restrict on update restrict;

alter table VENTA_CUNIA_COMERCIAL
   add constraint FK_VENTA_CU_REFERENCE_VENTA foreign key (VENTA)
      references VENTA (CODIGO)
      on delete restrict on update restrict;
