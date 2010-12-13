
-----------------------------------------------------------------------------
-- cancion
-----------------------------------------------------------------------------

DROP TABLE "cancion" CASCADE;


CREATE TABLE "cancion"
(
	"codigo" serial  NOT NULL,
	"nombre" VARCHAR(200),
	"autor" VARCHAR(200),
	"album" VARCHAR(200),
	"fecha_de_publicacion" DATE,
	"duracion" TIME,
	"url" VARCHAR(200),
	"habilitada" BOOLEAN,
	"precio" NUMERIC,
	"ranking" INTEGER,
	PRIMARY KEY ("codigo")
);

COMMENT ON TABLE "cancion" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- cunia_comercial
-----------------------------------------------------------------------------

DROP TABLE "cunia_comercial" CASCADE;


CREATE TABLE "cunia_comercial"
(
	"codigo" serial  NOT NULL,
	"nombre" VARCHAR(200),
	"duracion" TIME,
	"url" VARCHAR(200),
	"habilitada" BOOLEAN,
	"fecha_creacion" DATE,
	"usuario" INTEGER,
	"precio" INTEGER,
	PRIMARY KEY ("codigo")
);

COMMENT ON TABLE "cunia_comercial" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- mensaje
-----------------------------------------------------------------------------

DROP TABLE "mensaje" CASCADE;


CREATE TABLE "mensaje"
(
	"codigo" serial  NOT NULL,
	"usuario" INTEGER  NOT NULL,
	"asunto" VARCHAR(200),
	"mensaje" TEXT,
	PRIMARY KEY ("codigo")
);

COMMENT ON TABLE "mensaje" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- perfil
-----------------------------------------------------------------------------

DROP TABLE "perfil" CASCADE;


CREATE TABLE "perfil"
(
	"codigo" serial  NOT NULL,
	"nombre" VARCHAR(200)  NOT NULL,
	"descripcion" VARCHAR(200),
	PRIMARY KEY ("codigo")
);

COMMENT ON TABLE "perfil" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- persona
-----------------------------------------------------------------------------

DROP TABLE "persona" CASCADE;


CREATE TABLE "persona"
(
	"codigo" serial  NOT NULL,
	"nombre" VARCHAR(200)  NOT NULL,
	"apellido" VARCHAR(200),
	"identificacion" VARCHAR(200),
	"tipo_identificacion" INTEGER,
	"direccion" VARCHAR(200),
	"telefono" VARCHAR(200),
	"e_mail" VARCHAR(200),
	PRIMARY KEY ("codigo")
);

COMMENT ON TABLE "persona" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- programacion_cancion
-----------------------------------------------------------------------------

DROP TABLE "programacion_cancion" CASCADE;


CREATE TABLE "programacion_cancion"
(
	"cancion" INTEGER  NOT NULL,
	"venta" INTEGER  NOT NULL,
	"fecha" DATE  NOT NULL,
	"inicio" TIME  NOT NULL,
	"fin" TIME,
	PRIMARY KEY ("cancion","venta","fecha","inicio")
);

COMMENT ON TABLE "programacion_cancion" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- programacion_cuna
-----------------------------------------------------------------------------

DROP TABLE "programacion_cuna" CASCADE;


CREATE TABLE "programacion_cuna"
(
	"venta" INTEGER  NOT NULL,
	"cunia_comercial" INTEGER  NOT NULL,
	"fecha" DATE  NOT NULL,
	"inicio" TIME  NOT NULL,
	"fin" TIME  NOT NULL,
	PRIMARY KEY ("venta","cunia_comercial","fecha","inicio","fin")
);

COMMENT ON TABLE "programacion_cuna" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tipo_identificacion
-----------------------------------------------------------------------------

DROP TABLE "tipo_identificacion" CASCADE;


CREATE TABLE "tipo_identificacion"
(
	"codigo" serial  NOT NULL,
	"nombre" VARCHAR(200),
	"descripcion" VARCHAR(200),
	PRIMARY KEY ("codigo")
);

COMMENT ON TABLE "tipo_identificacion" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- usuario
-----------------------------------------------------------------------------

DROP TABLE "usuario" CASCADE;


CREATE TABLE "usuario"
(
	"codigo" serial  NOT NULL,
	"usuario" VARCHAR(200)  NOT NULL,
	"contrasena" VARCHAR(200)  NOT NULL,
	"perfil" INTEGER,
	"persona" INTEGER,
	"habilitado" BOOLEAN  NOT NULL,
	PRIMARY KEY ("codigo")
);

COMMENT ON TABLE "usuario" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- venta
-----------------------------------------------------------------------------

DROP TABLE "venta" CASCADE;


CREATE TABLE "venta"
(
	"codigo" serial  NOT NULL,
	"usuario" INTEGER  NOT NULL,
	"precio" NUMERIC,
	"fecha_venta" TIMESTAMP,
	PRIMARY KEY ("codigo")
);

COMMENT ON TABLE "venta" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- venta_cancion
-----------------------------------------------------------------------------

DROP TABLE "venta_cancion" CASCADE;


CREATE TABLE "venta_cancion"
(
	"cancion" INTEGER  NOT NULL,
	"venta" INTEGER  NOT NULL,
	PRIMARY KEY ("cancion","venta")
);

COMMENT ON TABLE "venta_cancion" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- venta_cunia_comercial
-----------------------------------------------------------------------------

DROP TABLE "venta_cunia_comercial" CASCADE;


CREATE TABLE "venta_cunia_comercial"
(
	"venta" INTEGER  NOT NULL,
	"cunia_comercial" INTEGER  NOT NULL,
	PRIMARY KEY ("venta","cunia_comercial")
);

COMMENT ON TABLE "venta_cunia_comercial" IS '';


SET search_path TO public;
ALTER TABLE "cunia_comercial" ADD CONSTRAINT "cunia_comercial_FK_1" FOREIGN KEY ("usuario") REFERENCES "usuario" ("codigo") ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE "mensaje" ADD CONSTRAINT "mensaje_FK_1" FOREIGN KEY ("usuario") REFERENCES "usuario" ("codigo") ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE "persona" ADD CONSTRAINT "persona_FK_1" FOREIGN KEY ("tipo_identificacion") REFERENCES "tipo_identificacion" ("codigo") ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE "programacion_cancion" ADD CONSTRAINT "programacion_cancion_FK_1" FOREIGN KEY ("cancion") REFERENCES "cancion" ("codigo");

ALTER TABLE "programacion_cancion" ADD CONSTRAINT "programacion_cancion_FK_2" FOREIGN KEY ("venta") REFERENCES "venta" ("codigo");

ALTER TABLE "usuario" ADD CONSTRAINT "usuario_FK_1" FOREIGN KEY ("perfil") REFERENCES "perfil" ("codigo") ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE "usuario" ADD CONSTRAINT "usuario_FK_2" FOREIGN KEY ("persona") REFERENCES "persona" ("codigo") ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE "venta" ADD CONSTRAINT "venta_FK_1" FOREIGN KEY ("usuario") REFERENCES "usuario" ("codigo") ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE "venta_cancion" ADD CONSTRAINT "venta_cancion_FK_1" FOREIGN KEY ("cancion") REFERENCES "cancion" ("codigo") ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE "venta_cancion" ADD CONSTRAINT "venta_cancion_FK_2" FOREIGN KEY ("venta") REFERENCES "venta" ("codigo") ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE "venta_cunia_comercial" ADD CONSTRAINT "venta_cunia_comercial_FK_1" FOREIGN KEY ("venta") REFERENCES "venta" ("codigo") ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE "venta_cunia_comercial" ADD CONSTRAINT "venta_cunia_comercial_FK_2" FOREIGN KEY ("cunia_comercial") REFERENCES "cunia_comercial" ("codigo") ON UPDATE RESTRICT ON DELETE RESTRICT;
