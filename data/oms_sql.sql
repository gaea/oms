--
-- PostgreSQL database dump
--

-- Started on 2010-12-12 23:51:38 COT

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1525 (class 1259 OID 16546)
-- Dependencies: 3
-- Name: cancion; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE cancion (
    codigo integer NOT NULL,
    nombre character varying(200),
    autor character varying(200),
    album character varying(200),
    fecha_de_publicacion date,
    duracion time without time zone,
    url character varying(200),
    habilitada boolean,
    precio numeric,
    ranking integer
);


ALTER TABLE public.cancion OWNER TO oms;

--
-- TOC entry 1524 (class 1259 OID 16544)
-- Dependencies: 3 1525
-- Name: cancion_codigo_seq; Type: SEQUENCE; Schema: public; Owner: oms
--

CREATE SEQUENCE cancion_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.cancion_codigo_seq OWNER TO oms;

--
-- TOC entry 1870 (class 0 OID 0)
-- Dependencies: 1524
-- Name: cancion_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: oms
--

ALTER SEQUENCE cancion_codigo_seq OWNED BY cancion.codigo;


--
-- TOC entry 1527 (class 1259 OID 16557)
-- Dependencies: 3
-- Name: cunia_comercial; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE cunia_comercial (
    codigo integer NOT NULL,
    nombre character varying(200),
    duracion time without time zone,
    url character varying(200),
    habilitada boolean,
    fecha_creacion date,
    usuario integer,
    precio integer
);


ALTER TABLE public.cunia_comercial OWNER TO oms;

--
-- TOC entry 1526 (class 1259 OID 16555)
-- Dependencies: 1527 3
-- Name: cunia_comercial_codigo_seq; Type: SEQUENCE; Schema: public; Owner: oms
--

CREATE SEQUENCE cunia_comercial_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.cunia_comercial_codigo_seq OWNER TO oms;

--
-- TOC entry 1871 (class 0 OID 0)
-- Dependencies: 1526
-- Name: cunia_comercial_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: oms
--

ALTER SEQUENCE cunia_comercial_codigo_seq OWNED BY cunia_comercial.codigo;


--
-- TOC entry 1529 (class 1259 OID 16565)
-- Dependencies: 3
-- Name: mensaje; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE mensaje (
    codigo integer NOT NULL,
    usuario integer NOT NULL,
    asunto character varying(200),
    mensaje text
);


ALTER TABLE public.mensaje OWNER TO oms;

--
-- TOC entry 1528 (class 1259 OID 16563)
-- Dependencies: 1529 3
-- Name: mensaje_codigo_seq; Type: SEQUENCE; Schema: public; Owner: oms
--

CREATE SEQUENCE mensaje_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.mensaje_codigo_seq OWNER TO oms;

--
-- TOC entry 1872 (class 0 OID 0)
-- Dependencies: 1528
-- Name: mensaje_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: oms
--

ALTER SEQUENCE mensaje_codigo_seq OWNED BY mensaje.codigo;


--
-- TOC entry 1531 (class 1259 OID 16576)
-- Dependencies: 3
-- Name: perfil; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE perfil (
    codigo integer NOT NULL,
    nombre character varying(200) NOT NULL,
    descripcion character varying(200)
);


ALTER TABLE public.perfil OWNER TO oms;

--
-- TOC entry 1530 (class 1259 OID 16574)
-- Dependencies: 1531 3
-- Name: perfil_codigo_seq; Type: SEQUENCE; Schema: public; Owner: oms
--

CREATE SEQUENCE perfil_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.perfil_codigo_seq OWNER TO oms;

--
-- TOC entry 1873 (class 0 OID 0)
-- Dependencies: 1530
-- Name: perfil_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: oms
--

ALTER SEQUENCE perfil_codigo_seq OWNED BY perfil.codigo;


--
-- TOC entry 1533 (class 1259 OID 16584)
-- Dependencies: 3
-- Name: persona; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE persona (
    codigo integer NOT NULL,
    nombre character varying(200) NOT NULL,
    apellido character varying(200),
    identificacion character varying(200),
    tipo_identificacion integer,
    direccion character varying(200),
    telefono character varying(200),
    e_mail character varying(200),
    habilitado boolean NOT NULL
);


ALTER TABLE public.persona OWNER TO oms;

--
-- TOC entry 1532 (class 1259 OID 16582)
-- Dependencies: 1533 3
-- Name: persona_codigo_seq; Type: SEQUENCE; Schema: public; Owner: oms
--

CREATE SEQUENCE persona_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.persona_codigo_seq OWNER TO oms;

--
-- TOC entry 1874 (class 0 OID 0)
-- Dependencies: 1532
-- Name: persona_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: oms
--

ALTER SEQUENCE persona_codigo_seq OWNED BY persona.codigo;


--
-- TOC entry 1534 (class 1259 OID 16593)
-- Dependencies: 3
-- Name: programacion_cancion; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE programacion_cancion (
    cancion integer NOT NULL,
    venta integer NOT NULL,
    fecha date NOT NULL,
    inicio time without time zone NOT NULL,
    fin time without time zone NOT NULL
);


ALTER TABLE public.programacion_cancion OWNER TO oms;

--
-- TOC entry 1535 (class 1259 OID 16598)
-- Dependencies: 3
-- Name: programacion_cuna; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE programacion_cuna (
    venta integer NOT NULL,
    cunia_comercial integer NOT NULL,
    fecha date NOT NULL,
    inicio time without time zone NOT NULL,
    fin time without time zone NOT NULL
);


ALTER TABLE public.programacion_cuna OWNER TO oms;

--
-- TOC entry 1537 (class 1259 OID 16605)
-- Dependencies: 3
-- Name: tipo_identificacion; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE tipo_identificacion (
    codigo integer NOT NULL,
    nombre character varying(200),
    descripcion character varying(200)
);


ALTER TABLE public.tipo_identificacion OWNER TO oms;

--
-- TOC entry 1536 (class 1259 OID 16603)
-- Dependencies: 1537 3
-- Name: tipo_identificacion_codigo_seq; Type: SEQUENCE; Schema: public; Owner: oms
--

CREATE SEQUENCE tipo_identificacion_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipo_identificacion_codigo_seq OWNER TO oms;

--
-- TOC entry 1875 (class 0 OID 0)
-- Dependencies: 1536
-- Name: tipo_identificacion_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: oms
--

ALTER SEQUENCE tipo_identificacion_codigo_seq OWNED BY tipo_identificacion.codigo;


--
-- TOC entry 1539 (class 1259 OID 16613)
-- Dependencies: 3
-- Name: usuario; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE usuario (
    codigo integer NOT NULL,
    usuario character varying(200) NOT NULL,
    contrasena character varying(200) NOT NULL,
    perfil integer,
    persona integer
);


ALTER TABLE public.usuario OWNER TO oms;

--
-- TOC entry 1538 (class 1259 OID 16611)
-- Dependencies: 3 1539
-- Name: usuario_codigo_seq; Type: SEQUENCE; Schema: public; Owner: oms
--

CREATE SEQUENCE usuario_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.usuario_codigo_seq OWNER TO oms;

--
-- TOC entry 1876 (class 0 OID 0)
-- Dependencies: 1538
-- Name: usuario_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: oms
--

ALTER SEQUENCE usuario_codigo_seq OWNED BY usuario.codigo;


--
-- TOC entry 1541 (class 1259 OID 16621)
-- Dependencies: 3
-- Name: venta; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE venta (
    codigo integer NOT NULL,
    usuario integer NOT NULL,
    precio numeric,
    fecha_venta timestamp without time zone
);


ALTER TABLE public.venta OWNER TO oms;

--
-- TOC entry 1542 (class 1259 OID 16630)
-- Dependencies: 3
-- Name: venta_cancion; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE venta_cancion (
    cancion integer NOT NULL,
    venta integer NOT NULL
);


ALTER TABLE public.venta_cancion OWNER TO oms;

--
-- TOC entry 1540 (class 1259 OID 16619)
-- Dependencies: 3 1541
-- Name: venta_codigo_seq; Type: SEQUENCE; Schema: public; Owner: oms
--

CREATE SEQUENCE venta_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.venta_codigo_seq OWNER TO oms;

--
-- TOC entry 1877 (class 0 OID 0)
-- Dependencies: 1540
-- Name: venta_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: oms
--

ALTER SEQUENCE venta_codigo_seq OWNED BY venta.codigo;


--
-- TOC entry 1543 (class 1259 OID 16635)
-- Dependencies: 3
-- Name: venta_cunia_comercial; Type: TABLE; Schema: public; Owner: oms; Tablespace: 
--

CREATE TABLE venta_cunia_comercial (
    venta integer NOT NULL,
    cunia_comercial integer NOT NULL
);


ALTER TABLE public.venta_cunia_comercial OWNER TO oms;

--
-- TOC entry 1821 (class 2604 OID 16549)
-- Dependencies: 1525 1524 1525
-- Name: codigo; Type: DEFAULT; Schema: public; Owner: oms
--

ALTER TABLE cancion ALTER COLUMN codigo SET DEFAULT nextval('cancion_codigo_seq'::regclass);


--
-- TOC entry 1822 (class 2604 OID 16560)
-- Dependencies: 1527 1526 1527
-- Name: codigo; Type: DEFAULT; Schema: public; Owner: oms
--

ALTER TABLE cunia_comercial ALTER COLUMN codigo SET DEFAULT nextval('cunia_comercial_codigo_seq'::regclass);


--
-- TOC entry 1823 (class 2604 OID 16568)
-- Dependencies: 1528 1529 1529
-- Name: codigo; Type: DEFAULT; Schema: public; Owner: oms
--

ALTER TABLE mensaje ALTER COLUMN codigo SET DEFAULT nextval('mensaje_codigo_seq'::regclass);


--
-- TOC entry 1824 (class 2604 OID 16579)
-- Dependencies: 1530 1531 1531
-- Name: codigo; Type: DEFAULT; Schema: public; Owner: oms
--

ALTER TABLE perfil ALTER COLUMN codigo SET DEFAULT nextval('perfil_codigo_seq'::regclass);


--
-- TOC entry 1825 (class 2604 OID 16587)
-- Dependencies: 1533 1532 1533
-- Name: codigo; Type: DEFAULT; Schema: public; Owner: oms
--

ALTER TABLE persona ALTER COLUMN codigo SET DEFAULT nextval('persona_codigo_seq'::regclass);


--
-- TOC entry 1826 (class 2604 OID 16608)
-- Dependencies: 1536 1537 1537
-- Name: codigo; Type: DEFAULT; Schema: public; Owner: oms
--

ALTER TABLE tipo_identificacion ALTER COLUMN codigo SET DEFAULT nextval('tipo_identificacion_codigo_seq'::regclass);


--
-- TOC entry 1827 (class 2604 OID 16616)
-- Dependencies: 1539 1538 1539
-- Name: codigo; Type: DEFAULT; Schema: public; Owner: oms
--

ALTER TABLE usuario ALTER COLUMN codigo SET DEFAULT nextval('usuario_codigo_seq'::regclass);


--
-- TOC entry 1828 (class 2604 OID 16624)
-- Dependencies: 1540 1541 1541
-- Name: codigo; Type: DEFAULT; Schema: public; Owner: oms
--

ALTER TABLE venta ALTER COLUMN codigo SET DEFAULT nextval('venta_codigo_seq'::regclass);


--
-- TOC entry 1830 (class 2606 OID 16554)
-- Dependencies: 1525 1525
-- Name: cancion_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY cancion
    ADD CONSTRAINT cancion_pkey PRIMARY KEY (codigo);


--
-- TOC entry 1832 (class 2606 OID 16562)
-- Dependencies: 1527 1527
-- Name: cunia_comercial_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY cunia_comercial
    ADD CONSTRAINT cunia_comercial_pkey PRIMARY KEY (codigo);


--
-- TOC entry 1834 (class 2606 OID 16573)
-- Dependencies: 1529 1529
-- Name: mensaje_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY mensaje
    ADD CONSTRAINT mensaje_pkey PRIMARY KEY (codigo);


--
-- TOC entry 1836 (class 2606 OID 16581)
-- Dependencies: 1531 1531
-- Name: perfil_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY perfil
    ADD CONSTRAINT perfil_pkey PRIMARY KEY (codigo);


--
-- TOC entry 1838 (class 2606 OID 16592)
-- Dependencies: 1533 1533
-- Name: persona_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT persona_pkey PRIMARY KEY (codigo);


--
-- TOC entry 1840 (class 2606 OID 16597)
-- Dependencies: 1534 1534 1534 1534 1534 1534
-- Name: programacion_cancion_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY programacion_cancion
    ADD CONSTRAINT programacion_cancion_pkey PRIMARY KEY (cancion, venta, fecha, inicio, fin);


--
-- TOC entry 1842 (class 2606 OID 16602)
-- Dependencies: 1535 1535 1535 1535 1535 1535
-- Name: programacion_cuna_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY programacion_cuna
    ADD CONSTRAINT programacion_cuna_pkey PRIMARY KEY (venta, cunia_comercial, fecha, inicio, fin);


--
-- TOC entry 1844 (class 2606 OID 16610)
-- Dependencies: 1537 1537
-- Name: tipo_identificacion_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY tipo_identificacion
    ADD CONSTRAINT tipo_identificacion_pkey PRIMARY KEY (codigo);


--
-- TOC entry 1846 (class 2606 OID 16618)
-- Dependencies: 1539 1539
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (codigo);


--
-- TOC entry 1850 (class 2606 OID 16634)
-- Dependencies: 1542 1542 1542
-- Name: venta_cancion_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY venta_cancion
    ADD CONSTRAINT venta_cancion_pkey PRIMARY KEY (cancion, venta);


--
-- TOC entry 1852 (class 2606 OID 16639)
-- Dependencies: 1543 1543 1543
-- Name: venta_cunia_comercial_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY venta_cunia_comercial
    ADD CONSTRAINT venta_cunia_comercial_pkey PRIMARY KEY (venta, cunia_comercial);


--
-- TOC entry 1848 (class 2606 OID 16629)
-- Dependencies: 1541 1541
-- Name: venta_pkey; Type: CONSTRAINT; Schema: public; Owner: oms; Tablespace: 
--

ALTER TABLE ONLY venta
    ADD CONSTRAINT venta_pkey PRIMARY KEY (codigo);


--
-- TOC entry 1856 (class 2606 OID 16691)
-- Dependencies: 1534 1829 1525
-- Name: cacion_fk; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY programacion_cancion
    ADD CONSTRAINT cacion_fk FOREIGN KEY (cancion) REFERENCES cancion(codigo);


--
-- TOC entry 1853 (class 2606 OID 16640)
-- Dependencies: 1539 1527 1845
-- Name: cunia_comercial_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY cunia_comercial
    ADD CONSTRAINT "cunia_comercial_FK_1" FOREIGN KEY (usuario) REFERENCES usuario(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1854 (class 2606 OID 16645)
-- Dependencies: 1845 1529 1539
-- Name: mensaje_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY mensaje
    ADD CONSTRAINT "mensaje_FK_1" FOREIGN KEY (usuario) REFERENCES usuario(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1855 (class 2606 OID 16650)
-- Dependencies: 1843 1537 1533
-- Name: persona_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT "persona_FK_1" FOREIGN KEY (tipo_identificacion) REFERENCES tipo_identificacion(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1858 (class 2606 OID 16655)
-- Dependencies: 1835 1539 1531
-- Name: usuario_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT "usuario_FK_1" FOREIGN KEY (perfil) REFERENCES perfil(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1859 (class 2606 OID 16660)
-- Dependencies: 1539 1837 1533
-- Name: usuario_FK_2; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT "usuario_FK_2" FOREIGN KEY (persona) REFERENCES persona(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1860 (class 2606 OID 16665)
-- Dependencies: 1539 1845 1541
-- Name: venta_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY venta
    ADD CONSTRAINT "venta_FK_1" FOREIGN KEY (usuario) REFERENCES usuario(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1861 (class 2606 OID 16670)
-- Dependencies: 1542 1525 1829
-- Name: venta_cancion_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY venta_cancion
    ADD CONSTRAINT "venta_cancion_FK_1" FOREIGN KEY (cancion) REFERENCES cancion(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1862 (class 2606 OID 16675)
-- Dependencies: 1847 1541 1542
-- Name: venta_cancion_FK_2; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY venta_cancion
    ADD CONSTRAINT "venta_cancion_FK_2" FOREIGN KEY (venta) REFERENCES venta(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1863 (class 2606 OID 16680)
-- Dependencies: 1543 1847 1541
-- Name: venta_cunia_comercial_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY venta_cunia_comercial
    ADD CONSTRAINT "venta_cunia_comercial_FK_1" FOREIGN KEY (venta) REFERENCES venta(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1864 (class 2606 OID 16685)
-- Dependencies: 1543 1527 1831
-- Name: venta_cunia_comercial_FK_2; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY venta_cunia_comercial
    ADD CONSTRAINT "venta_cunia_comercial_FK_2" FOREIGN KEY (cunia_comercial) REFERENCES cunia_comercial(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1857 (class 2606 OID 16701)
-- Dependencies: 1534 1541 1847
-- Name: venta_fk; Type: FK CONSTRAINT; Schema: public; Owner: oms
--

ALTER TABLE ONLY programacion_cancion
    ADD CONSTRAINT venta_fk FOREIGN KEY (venta) REFERENCES venta(codigo);


--
-- TOC entry 1869 (class 0 OID 0)
-- Dependencies: 3
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2010-12-12 23:51:38 COT

--
-- PostgreSQL database dump complete
--

